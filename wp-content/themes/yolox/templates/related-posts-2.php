<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

$yolox_link        = get_permalink();
$yolox_post_format = get_post_format();
$yolox_post_format = empty( $yolox_post_format ) ? 'standard' : str_replace( 'post-format-', '', $yolox_post_format );

$yolox_expanded    = ! yolox_sidebar_present() && yolox_is_on( yolox_get_theme_option( 'expand_content' ) );
$yolox_post_format = get_post_format();
$yolox_post_format = empty( $yolox_post_format ) ? 'standard' : str_replace( 'post-format-', '', $yolox_post_format );
$yolox_animation   = yolox_get_theme_option( 'blog_animation' );
?><div id="post-<?php the_ID(); ?>"
    <?php
    post_class( 'related_item related_item_style_2 post_format_' . esc_attr( $yolox_post_format ) ); ?>>



        <?php
        // Post title



        if(has_post_thumbnail() || in_array( $yolox_post_format, array( 'audio',  'video', 'gallery' ))){
            yolox_show_post_featured(
                array(
                    'thumb_size'    => apply_filters( 'yolox_filter_related_thumb_size', yolox_get_thumb_size( (int) yolox_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'related' ) ),
                    'show_no_image' => yolox_get_theme_setting( 'allow_no_image' ),
                    'singular'      => true,
                )
            );

        }?>
        <?php if( in_array( $yolox_post_format, array( 'audio',   'gallery' ))){?>

<?php }?>

    <?php

    ?>
    <div class="related_content_wrap">

        <div class="post_header post_header_single entry-header">
            <?php
            do_action( 'yolox_action_before_post_title' );

            // Post meta
            $yolox_components = yolox_array_get_keys_by_value( yolox_get_theme_option( 'meta_parts' ) );
            $yolox_counters   = yolox_array_get_keys_by_value( yolox_get_theme_option( 'counters' ) );
            if ( !empty($yolox_counters) && stristr($yolox_components,'categories') && ! empty( $yolox_components ) ) {
                yolox_show_post_meta(
                    apply_filters(
                        'yolox_filter_post_meta_args', array(
                        'components' => 'categories',
                        'counters'   => '',
                        'categories' => '',

                        'seo'        => false,
                    ), 'excerpt', 1
                    )
                );
            }
            // Title and post meta
            if ( get_the_title() != '' ) {
                // Post title

                    if (empty($yolox_template_args['no_links'])) {
                        the_title(sprintf('<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                    } else {
                        the_title('<h2 class="post_title entry-title">', '</h2>');
                    }

            }?>
            <div class="secondary_meta_wrap">
                <?php
                if ( ! empty( $yolox_components ) ) {
                    yolox_show_post_meta(
                        apply_filters(
                            'yolox_filter_post_meta_args', array(
                            'components' => $yolox_components,
                            'counters'   => $yolox_counters,
                            'seo'        => false,
                        ), 'excerpt', 1
                        )
                    );
                }?>
            </div>

            <?php

            do_action( 'yolox_action_before_post_meta' );

            ?>
        </div><!-- .post_header -->

        <?php
        // More button
        if ( empty( $yolox_template_args['no_links'] ) ) {
            ?>

            <a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'yolox' ); ?></a>
            <?php
        }?>

    </div>
</div>
