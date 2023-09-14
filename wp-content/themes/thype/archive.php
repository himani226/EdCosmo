<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Thype
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

    <section id="site_content" class="<?php echo esc_attr( codeless_extra_classes( 'site_content' ) ) ?>" <?php echo codeless_extra_attr( 'site_content' ) ?>>

        <?php codeless_hook_content_before(); ?>

        <div id="content" class="<?php echo esc_attr( codeless_extra_classes( 'content' ) ) ?>" <?php echo codeless_extra_attr( 'content' ) ?> >

            <?php
        
            /**
             * Functions hooked into codeless_hook_content_begin action
             *
             * @hooked codeless_add_page_header                     - 0
             * @hooked codeless_add_post_header                     - 10
             * @hooked codeless_layout_modern                       - 20
             */
            codeless_hook_content_begin(); ?>
            
            <div class="inner-content <?php echo esc_attr( codeless_extra_classes( 'inner_content' ) ) ?>">
                
                <div class="inner-content-row <?php echo esc_attr( codeless_extra_classes( 'inner_content_row' ) ) ?>">
                    
                    <?php codeless_hook_content_column_before() ?>
                    
                    <div class="content-col <?php echo esc_attr( codeless_extra_classes( 'content_col' ) ) ?>">
                        
                        <?php codeless_hook_content_column_begin() ?>

                        <?php
                                                
                        // Display posts
                        if ( have_posts() ) :

                            the_archive_description( '<div class="taxonomy-description">', '</div>' );

                        ?>
                            <div id="blog-entries" class="<?php echo esc_attr( codeless_extra_classes( 'blog_entries' ) ) ?>" <?php echo codeless_extra_attr( 'blog_entries' ) ?>>


                                <div class="cl-blog__list cl-items-container <?php echo esc_attr( codeless_extra_classes( 'blog_entries_list' ) ) ?>" <?php echo codeless_extra_attr( 'blog_entries_list' ) ?>>
                                    <?php
                                    
                                    // Loop counter
                                    $i = 0;
                                    codeless_loop_counter($i);
                                    
                                    // Start loop
                                    while ( have_posts() ) : the_post();
                                        codeless_loop_counter(++$i);
                                        
                                        /*
                                        * Get Blog Template Style
                                        * Codeless_blog_style returns the style selected
                                        * from Theme Options or a custom filter
                                        */
                                        get_template_part( 'template-parts/blog/style', codeless_blog_style() );

                                    // End loop
                                    endwhile; ?>

                                    

                                </div>

                                <?php
                                    // Display post pagination (next/prev - 1,2,3,4..)
                                    codeless_blog_pagination(false, 'blog-entries') ; ?>

                            </div><!-- #blog-entries -->
            
                        <?php
            
                        else : ?>
            
                            <article class="content-none"><?php esc_html_e( 'No Posts found.', 'thype' ); ?></article>
            
                        <?php endif; ?>
                        
                    </div><!-- .content-col -->
                    
                    <?php
        
                    /**
                     * Functions hooked into codeless_hook_content_column_after action
                     *
                     * @hooked codeless_get_sidebar                     - 0
                     */
                    codeless_hook_content_column_after() ?>
                    
                </div><!-- .row -->
                
            </div><!-- .inner-content -->
            
            <?php codeless_hook_content_end(); ?>
            
        </div><!-- #content -->

        <?php codeless_hook_content_after(); ?>

    </section><!-- #site-content -->
    
<?php get_footer(); ?>