<?php
/**
 * ThemeREX Addons Layouts: Template for the 'Layouts' in the Edit mode
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.51
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

$post_id = get_the_ID();
$uniq_id = 'trx_addons_layout-' . $post_id;
//$meta = get_post_meta( $post_id, '_elementor_page_settings', true );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php if ( ! current_theme_supports( 'title-tag' ) ) : ?>
		<title><?php echo wp_get_document_title(); ?></title>
		<?php endif; ?>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<div class="trx-addons-layout-edit-area">
		<div id="<?php echo $uniq_id; ?>" class="trx-addons-layout trx-addons-layout--edit-mode">
			<div class="trx-addons-layout__inner">
				<div class="trx-addons-layout__container">
					<div class="trx-addons-layout__container-inner"><?php
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
					wp_footer();
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>