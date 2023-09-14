<?php

$shares = codeless_share_buttons();

?>

<div class="cl-single-share-buttons">

    <div class="cl-single-share-buttons__wrapper">
        <span><?php esc_attr_e('Share', 'thype'); ?></span>
        <?php
            if( !empty( $shares ) ){
                foreach( $shares as $social_id => $data ){ ?>
                    <a href="<?php echo esc_url( $data['link'] ) ?>" title="<?php esc_attr_e('Social Share', 'thype') ?> <?php echo esc_attr( $social_id ) ?>" target="_blank"><i class="<?php echo esc_attr( $data['icon'] ) ?>"></i></a>
                <?php }
            }
        ?>
    </div>
</div>