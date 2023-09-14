<?php
    
    $announcements =  cl_backpanel::cl_announcements();

?>
<div class="wrapper postbox with-pad">

	<h2 class="box-title">Announcements</h2>

	<div class="inner-wrapper">

		<?php 

        if(!empty($announcements) && is_array($announcements)) {
            foreach ($announcements as $announcement=>$k) { ?>
                <div class="list-item">   
                    <a href="<?php echo esc_url( $k['link'] ); ?>"><?php echo esc_html( $k['title'] ); ?></a>
                    <span class="cp-announcement-date"><?php echo esc_attr( $k['date'] ); ?></span>           
                </div>
            <?php } 
        }
        ?>

	</div>

</div>