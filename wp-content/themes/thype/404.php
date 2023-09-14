<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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

                        <h2 class="not-found-404">404</h2>
                        
                        <h1 class="page-title"><?php esc_attr_e( 'Oops! That page can&rsquo;t be found.', 'thype' ); ?></h1>

                        <p><?php echo esc_attr( codeless_get_mod( '404_error_message', 'It looks like nothing was found at this location. Maybe try a search?' ) ) ?></p>

                        <?php get_search_form(); ?>

                        <div class="search__related">

                                <?php if( is_active_sidebar( 'search-dynamic' ) ): ?>
                                <div class="search__col">
                                    <?php dynamic_sidebar( 'search-dynamic' ); ?>
                                </div>
                                <?php endif; ?>

                                <div class="search__col">
                                    <h3><?php esc_attr_e('May We Suggest?', 'thype' ) ?></h3>
                                    <p><?php echo codeless_all_tags_html() ?></p>
                                </div>
                                
                        </div>
                        
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

    </div><!-- #site-content -->
    
<?php get_footer(); ?>