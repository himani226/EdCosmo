<?php if (!defined('ABSPATH')) {
    die;
} // Cannot access directly. ?>

<div class="wrap to-wrap">

    <div class="to-admin-page-header">

        <div class="to-admin-page-header-text">
            <h1>
                <?php esc_html_e('Welcome to Noxiy!', 'noxiy'); ?>
            </h1>
            <p>
                <?php esc_html_e('Noxiy is a Insurance Company WordPress Theme', 'noxiy'); ?>
            </p>
        </div>

        <div class="to-admin-page-header-logo">
            <img src="<?php echo get_theme_file_uri('inc/admin/assets/img/icon.svg'); ?>" />
        </div>
    </div>

    <div class="to-admin-boxes">

        <div class="to-admin-box">

            <div class="to-admin-box-header">
                <h2>
                    <?php esc_html_e('Documentation', 'noxiy'); ?>
                </h2>
            </div>

            <div class="to-admin-box-inside">
                <p>
                    <?php esc_html_e('You can find everything about theme functionality.', 'noxiy'); ?>
                </p>
                <a href="https://docs.themeori.com/docs/noxiy/" target="_blank" class="button">
                    <?php esc_html_e('Go to Documentation', 'noxiy'); ?>
                </a>
            </div>

        </div>

        <div class="to-admin-box">

            <div class="to-admin-box-header">
                <h2>
                    <?php esc_html_e('Noxiy Support', 'noxiy'); ?>
                </h2>
            </div>

            <div class="to-admin-box-inside">
                <p>
                    <?php esc_html_e('Do you need help? Feel to free ask any question.', 'noxiy'); ?>
                </p>
                <a href="https://docs.themeori.com/envato/noxiy/help-and-support-24/" target="_blank"
                    class="button"><?php esc_html_e('Go to Support Page', 'noxiy'); ?></a>
            </div>

        </div>

    </div>

</div>