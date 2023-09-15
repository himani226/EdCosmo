<div class="category-bar clearfix">
	<?php
    $baxel_categories = get_the_category();
	$baxel_separator = ', ';
    $baxel_output = '<span class="categories-label">' . esc_attr( baxel_translation( '_Category' ) ) . ':</span>';

    if ( $baxel_categories ) {
        foreach( $baxel_categories as $baxel_category ) {
            $baxel_output .= '<a href="' . get_category_link( $baxel_category->term_id ) . '">' . esc_attr( $baxel_category->cat_name ) . '</a>' . esc_html( $baxel_separator );            
        }
		echo wp_kses_post( trim( $baxel_output, $baxel_separator ) );
    }
    ?>
</div>
