<?php get_header(); ?>

<!-- Start of content wrapper -->
<div id="cr3ativcareer_contentwrapper">

    <!-- Start of content wrapper -->
    <div class="cr3ativcareer_content_wrapper">

        <!-- Start of left content -->
        <div class="cr3ativcareer_left_content">
        <?php
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        $args = array( 'post_type'=>'cr3ativcareers', 'cr3ativdepartment'=>$term->slug, 'posts_per_page' => 999999 );
        $loop = new WP_Query( $args );
        ?>

            <!-- Start of blog wrapper -->
            <div class="cr3ativcareer_blog_wrapper">
                <?php while ($loop->have_posts()) : $loop->the_post(); ?>

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

                <div class="space"></div>

                <?php endwhile; ?> 

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