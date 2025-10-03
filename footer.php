<?php
/**
* The template for displaying the footer
*/
?>
<?php $back_to_top = get_theme_mod('featuredlite_backtotop_disable');?>
<input type="hidden" id="back-to-top" value="<?php echo $back_to_top?>"/> 
<?php do_action( 'featuredlite_before_footer' ); ?>
<?php do_action( 'featuredlite_footer' ); ?>
<?php do_action( 'featuredlite_after_footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>