<?php

$args = array(
    "text"             => esc_attr__("Click Me", 'thype'),
    "description"      => esc_attr__('Description', 'thype'),
    'link'             => '#',
    'style'            => 'style-1',
    'image'            => '',
    'image_size'       => ''
);

extract(shortcode_atts($args, $atts));

?>

<div class="cl-element cl-featured-box cl-featured-box--<?php echo esc_attr( $style ) ?>">
    <?php echo wp_get_attachment_image( $image, $image_size ); ?>
    <div class="cl-featured-box__content">
        <div class="cl-featured-box__content-inner">
            <h4><?php echo esc_html( $text ); ?></h4>
            <p class="cl-featured-box__description"><?php echo esc_html( $description ); ?>
        </div>
    </div>
    <a href="<?php echo esc_url( $link ) ?>"></a>
</div>

