<div class="category-bar">
	<?php
    $souje_categories = get_the_category();
	$souje_separator = ', ';
    $souje_output = '';

    if ( $souje_categories ) {
        foreach( $souje_categories as $souje_category ) {
            $souje_output .= '<a href="' . get_category_link( $souje_category->term_id ) . '">' . esc_attr( $souje_category->cat_name ) . '</a>' . esc_html( $souje_separator );            
        }
		echo wp_kses_post( trim( $souje_output, $souje_separator ) );
    }
    ?>
</div>
