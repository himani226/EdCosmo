<div class="wrapper postbox with-pad">

	<h2 class="box-title">Footer Wizard</h2>

	<div class="inner-wrapper">

		<div class="list-item">
			<h4>Footer Wizard</h4>
			<p>Install any of listed footers with only one click. You can change it anytime!</p>
		</div>


		<p>
            <a id="footerSetupBtn" name="<?php esc_attr_e('Select Footer', 'thype') ?>" href="/TB_inline?width=960&height=600&inlineId=importer_footer_dialog"  class="button-primary codeless-hint-qtip thickbox"><?php esc_html_e( 'Footer Wizard', 'thype' ); ?></a>
        </p>

	</div>

</div>

<?php include_once(get_template_directory() . '/includes/codeless_theme_panel/views/footer_importer.php'); ?>