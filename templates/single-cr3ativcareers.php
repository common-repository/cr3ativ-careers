<?php get_header(); ?>

<!-- Start of content wrapper -->
<div id="cr3ativcareer_contentwrapper">

    <!-- Start of content wrapper -->
    <div class="cr3ativcareer_content_wrapper">

        <!-- Start of left content -->
        <div class="cr3ativcareer_left_content">
        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

        <?php
        $printicontext = get_post_meta($post->ID, 'cr3ativ_printicontext', $single = true); 
        $downloadicontext = get_post_meta($post->ID, 'cr3ativ_downloadicontext', $single = true); 
        $pdf = get_post_meta($post->ID, 'cr3ativ_wp_custom_attachment', true); 
        ?>

            <!-- Start of blog wrapper -->
            <div class="cr3ativcareer_blog_wrapper">
            <?php 
            if ( has_post_thumbnail() ) {  ?>

            <?php the_post_thumbnail('slide'); ?>

            <?php } ?>

            <h1><?php the_title (); ?></h1>

            <!-- Start of post details -->
            <div class="cr3ativcareer_post_details">

                <!-- Start of post date -->
                <div class="cr3ativcareer_post_date2">
                    <?php the_time(get_option('date_format')); ?>

                </div><!-- End of post date -->

                <?php if ($printicontext != ('')){ ?>

                <!-- Start of career print -->
                <div class="cr3ativcareer_career_print">
                    <a href="javascript:window.print()"><?php echo stripslashes($printicontext); ?></a>

                </div><!-- End of career print -->

                <div class="cr3ativcareer_career_split"></div>

                <?php } else { } ?>

                <?php if ($pdf != ('')){ ?>

                <!-- Start of PDF download -->
                <div class="cr3ativcareer_pdf_download">
                    <a href="<?php echo wp_get_attachment_url( $pdf ); ?> "><?php echo stripslashes($downloadicontext); ?></a>

                </div><!-- End of PDF download -->

                <?php } else { } ?>

                <!-- Clear Fix --><div class="cr3ativcareer_clear"></div>

            </div><!-- End of post details -->

            <!-- Clear Fix --><div class="cr3ativcareer_clearbig"></div>

            <?php the_content('        '); ?> 

            <?php endwhile; ?> 

            <?php else: ?> 
            <p><?php _e( 'There are no posts to display. Try using the search.', 'cr3at_career' ); ?></p> 

            <?php endif; ?>

            </div><!-- End of blog wrapper -->

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