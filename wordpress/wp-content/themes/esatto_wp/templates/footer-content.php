<?php spyropress_before_footer(); ?>
<!-- footer -->
<footer id="footer">
<?php spyropress_before_footer_content(); ?>
    <?php spyropress_after_footer(); ?>
    <div class="footer">
        <?php $content = get_setting( 'copyright_text' ); echo do_shortcode( shortcode_unautop( $content ) ); ?>
    </div>
    <?php if( !get_setting( 'enable_top' ) ) { ?>
    <!-- Go to top page -->
    <div id="toTop"><i class="icon-chevron-up icon-white"></i></div>
    <?php }  ?>
<?php spyropress_after_footer_content(); ?>
</footer>
<!-- /footer -->