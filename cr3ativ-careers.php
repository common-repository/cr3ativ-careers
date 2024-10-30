<?php
/**
 * Plugin Name: Cr3ativ Careers Plugin
 * Plugin URI: http://cr3ativ.com/cr3ativportfolio/careers
 * Description: Custom written plugin to add career items / job opportunites (and categorize them) to your WordPress site.
 * Author: Barbi Atkinson
 * Author URI: http://cr3ativ.com/
 * Version: 1.2.0
 */

/* Place custom code below this line. */

/* Variables */
$ja_cr3ativ_careers_main_file = dirname(__FILE__).'/cr3ativ-careers.php';
$ja_cr3ativ_careers_directory = plugin_dir_url($ja_cr3ativ_careers_main_file);
$ja_cr3ativ_careers_path = dirname(__FILE__);

/* Add css file */
function creativ_careers_add_scripts() {
	global $ja_cr3ativ_careers_directory, $ja_cr3ativ_careers_path;
		wp_enqueue_style('creativ_careers', $ja_cr3ativ_careers_directory.'css/cr3ativcareer.css');
}
		
add_action('wp_enqueue_scripts', 'creativ_careers_add_scripts');

add_action('admin_head', 'cr3ativcareers_custom_css');

function cr3ativcareers_custom_css() {
  echo '<style>

.jobcontent.column-jobcontent {
    display: inline-block;
    margin: 5px 0 25px;
    width: 90%;
}

  </style>';
}

////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////       WP Default Functionality       ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_theme_support( 'post-thumbnails' );
add_image_size( 'slide', 980, 999999, true );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////            Theme Options Metabox            /////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
include_once( 'includes/meta_box.php' );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Text Domain     /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
load_plugin_textdomain('cr3at_career', false, basename( dirname( __FILE__ ) ) . '/languages' );

////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Careers post type     ///////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

function cr3_careerssettings_admin_menu_setup(){
add_submenu_page(
 'edit.php?post_type=cr3ativcareers',
 __('Cr3ativ Careers Options', 'cr3at_career'),
 __('Careers Options', 'cr3at_career'),
 'manage_options',
 'cr3_careerssettings',
 'cr3_careerssettings_admin_page_screen'
 );
}
add_action('admin_menu', 'cr3_careerssettings_admin_menu_setup'); //menu setup

/* display page content */
function cr3_careerssettings_admin_page_screen() {
 global $submenu;
// access page settings 
 $page_data = array();
 foreach($submenu['options-general.php'] as $i => $menu_item) {
 if($submenu['options-general.php'][$i][2] == 'cr3_careerssettings')
 $page_data = $submenu['options-general.php'][$i];
 }

// output 
?>
<div class="wrap">
    <style>
#cr3_careerssettings_options .form-table th, #cr3_careerssettings_options .form-wrap label {
display: none;
}
#cr3_careerssettings_options label {
    cursor: pointer;
    display: block;
    float: left;
    width: 25%;
}
</style>
       

<?php screen_icon();?>
<h2><?php _e('Cr3ativ Careers Settings', 'cr3at_career');?></h2>
<form id="cr3_careerssettings_options" action="options.php" method="post">
<?php
settings_fields('cr3_careerssettings_options');
do_settings_sections('cr3_careerssettings'); 
submit_button('Save options', 'primary', 'cr3_careerssettings_options_submit');
?>
 </form>
</div>
<?php
}

add_action('admin_init', 'cr3_careerssettings_flush' );

function cr3_careerssettings_flush(){

		if ( isset( $_POST['cr3_careerssettings_options'] ) ) {


			flush_rewrite_rules();
		
		}

} 
function cr3_careerssettings_settings_init(){

register_setting(
 'cr3_careerssettings_options',
 'cr3_careerssettings_options',
 'cr3_careerssettings_options_validate'
 );

add_settings_section(
 'cr3_careerssettings_authorbox',
 '', 
 'cr3_careerssettings_authorbox_desc',
 'cr3_careerssettings'
 );

add_settings_field(
 'cr3_careerssettings_authorbox_template',
 '', 
 'cr3_careerssettings_authorbox_field',
 'cr3_careerssettings',
 'cr3_careerssettings_authorbox'
 );
    
add_settings_field(
 'cr3_careerssettings_authorbox_template2',
 '', 
 'cr3_careerssettings_authorbox_field2',
 'cr3_careerssettings',
 'cr3_careerssettings_authorbox2'
 );
}

add_action('admin_init', 'cr3_careerssettings_settings_init');

/* validate input */
function cr3_careerssettings_options_validate($input){
 global $allowedposttags, $allowedrichhtml;
if(isset($input['authorbox_template']))
 $input['authorbox_template'] = wp_kses_post($input['authorbox_template']);
 $input['authorbox_template2'] = wp_kses_post($input['authorbox_template2']);
return $input;
}

/* description text */
function cr3_careerssettings_authorbox_desc(){
_e('Please set the slug name below for your job listings single pages and department pages.  Default url for single pages is /cr3ativcareers/ and default url for department pages is /cr3ativdepartment/.  If you leave this blank, the default careers slug names will be used.', 'cr3at_career');
}

/* filed output */
function cr3_careerssettings_authorbox_field() {
 $options = get_option('cr3_careerssettings_options');
 $authorbox = (isset($options['authorbox_template'])) ? $options['authorbox_template'] : '';
 $authorbox = strip_tags($authorbox); //sanitise output
 $authorbox2 = (isset($options['authorbox_template2'])) ? $options['authorbox_template2'] : '';
 $authorbox2 = strip_tags($authorbox2); //sanitise output
?>
<p>
    <label><?php _e('Careers Single Page Slug Name', 'cr3at_career');?></label>
 <input type="text" id="authorbox_template" name="cr3_careerssettings_options[authorbox_template]" value="<?php echo $authorbox; ?>" /></p>

<p>
    <label><?php _e('Department Page Slug Name', 'cr3at_career');?></label>
 <input type="text" id="authorbox_template2" name="cr3_careerssettings_options[authorbox_template2]" value="<?php echo $authorbox2; ?>" /></p>

<?php
}

add_action('init', 'create_cr3ativcareers');

function create_cr3ativcareers() {
 $options = get_option('cr3_careerssettings_options');
 $authorbox = (isset($options['authorbox_template'])) ? $options['authorbox_template'] : '';
 $authorbox = strip_tags($authorbox); //sanitise output	
	$labels = array(
		'name' => __('Job Listings', 'post type general name', 'cr3at_career'),
		'singular_name' => __('Job Listing', 'post type singular name', 'cr3at_career'),
		'add_new' => __('Add New', 'job listing', 'cr3at_career'),
		'add_new_item' => __('Add New Job Listing', 'cr3at_career'),
		'edit_item' => __('Edit Job Listing', 'cr3at_career'),
		'new_item' => __('New Job Listing', 'cr3at_career'),
		'view_item' => __('View Job Listing', 'cr3at_career'),
		'search_items' => __('Search Job Listing', 'cr3at_career'),
		'not_found' =>  __('Nothing found', 'cr3at_career'),
		'not_found_in_trash' => __('Nothing found in Trash', 'cr3at_career'),
		'parent_item_colon' => ''
	);
    	$cr3ativcareers_args = array(
        	'labels' => $labels,
        	'public' => true,
            'menu_icon' => 'dashicons-feedback',
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
            'rewrite' => array('slug' => $authorbox), 
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor','thumbnail','comments')
        );
       
        //var_dump( $authorbox );
        
    	register_post_type('cr3ativcareers',$cr3ativcareers_args);
	}

$cr3ativcareers_fields = array(
	array(
            'label' => __('Print Icon Text', 'cr3at_career'),
            'desc' => __('Print This Page.  Leave blank to disable the icon.', 'cr3at_career'),
            'id' => 'cr3ativ_printicontext',
            'type' => 'text',
            'std' => ""
        ),
	array(
            'label' => __('Download Icon Text', 'cr3at_career'),
            'desc' => __('Download PDF File.  If you do not upload a file (see below) this text will not appear', 'cr3at_career'),
            'id' => 'cr3ativ_downloadicontext',
            'type' => 'text',
            'std' => ""
        ),
	array(
            'label' => __('Attach PDF', 'cr3at_career'),
            'desc' => __('PDF Media Library List.  If you choose not to upload, the text you placed above (Download Icon Text) will not appear.', 'cr3at_career'),
            'id' => 'cr3ativ_wp_custom_attachment',
            'type' => 'pdf_list',
            'std' => ""
        )
);

$cr3ativcareers_box = new cr3ativcareers_add_meta_box( 'cr3ativcareers_box', __('Career Data', 'cr3at_career'), $cr3ativcareers_fields, 'cr3ativcareers', true );

	
////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Custom taxonomies     ///////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'cr3ativdepartment', 0 );
function cr3ativdepartment()	{
 $options = get_option('cr3_careerssettings_options');
 $authorbox2 = (isset($options['authorbox_template2'])) ? $options['authorbox_template2'] : '';
 $authorbox2 = strip_tags($authorbox2); //sanitise output
	register_taxonomy( 
		'cr3ativdepartment', 
		'cr3ativcareers', 
			array( 
				'hierarchical' => true, 
				'label' => __('Department', 'cr3at_career'),
				'query_var' => true, 
				'rewrite' => array('slug' => $authorbox2), 
			) 
	);
 
}


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Register new widget     /////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
register_sidebar(array(
	'name' => __( 'Cr3ativ Careers Page', 'cr3at_career' ),
	'id' => 'cr3ativ_careers',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>'
));


// Replace the default ellipsis
function cr3ativcareerstrim_excerpt($text) {
     $text = str_replace('[&hellip;]', '', $text);
     return $text;
    }
add_filter('get_the_excerpt', 'cr3ativcareerstrim_excerpt');


function cr3careers_string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////              Career widget                  /////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

include_once( 'includes/career-widget.php' );






add_filter( 'manage_edit-cr3ativcareers_columns', 'my_edit_cr3ativcareers_columns' ) ;

function my_edit_cr3ativcareers_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Job Listing Name', 'cr3at_career' ),
        'jobcontent' => __( 'Job Description' , 'cr3at_career'),
        'jobcategory' => __( 'Department' , 'cr3at_career'),
        'date' => __( 'Date Created', 'cr3at_career' )

    );

	return $columns;
}

add_action( 'manage_cr3ativcareers_posts_custom_column', 'my_manage_cr3ativcareers_columns', 10, 2 );

function my_manage_cr3ativcareers_columns( $column, $post_id ) {
	global $post;
    $pdf = get_post_meta($post->ID, 'cr3ativ_wp_custom_attachment', true); 
	switch( $column ) {
        
		case 'jobcontent' :

			 echo wp_trim_words( get_the_content(), 10, '...' );

			break;
        
		case 'jobcategory' :

			$terms = get_the_terms( $post_id, 'cr3ativdepartment' );

			/* If terms were found. */
			if ( !empty( $terms ) ) {

				$out = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'cr3ativdepartment' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'cr3ativdepartment', 'display' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			break;
        
        case 'jobpdf' :

			 echo wp_get_attachment_url( $pdf );
			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}




?>