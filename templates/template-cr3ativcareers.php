<?php  
/* 
Template Name: Cr3ativ-Careers
*/  
?>

<?php get_header(); ?>

<!-- Start of content wrapper -->
<div id="cr3ativcareer_contentwrapper">

    <!-- Start of content wrapper -->
    <div class="cr3ativcareer_content_wrapper">
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

    <?php 
    if ( has_post_thumbnail() ) {  ?>

    <?php the_post_thumbnail('slide'); ?>

    <?php } ?>

    <?php the_content('        '); ?> 

    <?php endwhile; ?> 

    <?php else: ?> 
    <p><?php _e( 'There are no posts to display. Try using the search.', 'cr3at_career' ); ?></p> 

    <?php endif; ?>

        <!-- Start of left content -->
        <div class="cr3ativcareer_left_content">
        <?php 
        $temp = $wp_query; 
        $wp_query = null; 
        $wp_query = new WP_Query(); 
        $wp_query->query('post_type=cr3ativcareers'.'&paged='.$paged); 
        ?>

        <?php while ($wp_query->have_posts()) : $wp_query->the_post();  ?>

            <!-- Start of blog wrapper -->
            <div class="cr3ativcareer_blog_wrapper">
                <h5><a href="<?php the_permalink (); ?>"><?php the_title (); ?></a></h5>

                <!-- Start of read more -->
                <div class="cr3ativcareer_read_more">
                    <?php the_excerpt ();	?>
                    
                </div>
                <!-- End of read more -->

                <!-- Start of post details -->
                <div class="cr3ativcareer_post_details">

                    <!-- Start of post date -->
                    <div class="cr3ativcareer_post_date">
                        <?php the_time(get_option('date_format')); ?>

                    </div><!-- End of post date -->

                    <!-- Start of post read more -->
                    <div class="cr3ativcareer_post_read_more">
                        <a href="<?php the_permalink (); ?>"><?php _e( 'Continue Reading', 'cr3at_career' ); ?></a>

                    </div><!-- End of post read more -->

                </div><!-- End of post details -->

            </div><!-- End of blog wrapper -->

        <?php endwhile; ?> 
            
            <!-- Clear Fix --><div class="cr3ativcareer_clear"></div>

            <!-- Start of pagination -->
            <div id="cr3ativ_pagination">

                <!-- Start of next post -->
                <div class="cr3ativ_next_post">
                    <?php next_posts_link(__('Next Page', 'cr3atstaff')); ?>

                </div>
                <!-- End of next post -->

                <!-- Start of prev post -->
                <div class="cr3ativ_prev_post">
                    <?php previous_posts_link(__('Previous Page', 'cr3atstaff')); ?>

                </div>
                <!-- End of prev post -->

            </div><!-- End of pagination -->   

        <?php $wp_query = null; $wp_query = $temp;  // Reset ?>

        </div><!-- End of left content -->

        <!-- Start of right content -->
        <div class="cr3ativcareer_right_content">
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('cr3ativ_careers') ) : else : ?>		
        <?php endif; ?>
            
        </div><!-- End of right content -->

    </div><!-- End of content wrapper -->

    <!-- Clear Fix --><div class="cr3ativcareer_clear"></div>

</div><!-- End of content wrapper -->

<?php get_footer(); ?>