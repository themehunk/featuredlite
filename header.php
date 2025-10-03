<!DOCTYPE html>
<html <?php language_attributes(); ?> >
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
  </head>
  <body id="page-top" <?php body_class(); ?> >
    <?php wp_body_open();?> 
    <div class="overlayloader">
      <div class="loader">&nbsp;</div>
    </div>
    <!-- Start Of Header Wrapper -->
    <!-- script to split menu -->
 <?php 
if (get_theme_mod('header_layout')=='split') { ?>    
  <script>
    jQuery(document).ready(function() {
    // hides home from navigation
     var position = jQuery("ul.menu > li").length;
     var middle = Math.round(position/2);
     var i = 0;
     jQuery('ul.menu > li').each(function() {
         if(i == middle){
                <?php
        if (get_theme_mod('title_disable')!==''){?>
          jQuery(this).before("<li class='logo-cent'><h1><a href='<?php echo esc_url( home_url( '/' ) ); ?>'><?php bloginfo('name'); ?></a></h1><p><?php bloginfo('description'); ?></p></li>");
            <?php } else { ?>
      jQuery(this).before('<li class="logo-cent"><?php the_custom_logo();?></li>');
            <?php } ?>
        }
         i++;
     });
 });
  </script>
  <?php } ?>  
   <!-- script to split menu --> 
  <?php do_action( 'featuredlite_before_header' ); ?>
  <?php do_action( 'featuredlite_header' ); ?>
  <?php do_action( 'featuredlite_after_header' ); ?>
    <div class="clearfix"></div>