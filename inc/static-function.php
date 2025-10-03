<?php
/**************************************/
// Wrapper of header markup
/**************************************/
if ( !function_exists('featuredlite_full_header_markup') ) {
function featuredlite_full_header_markup() {
$header_fixed_cls = '';
    $cntralign_menu='';
    $split_menu='';
    $hdr_trnsprnt ='';
    $last_btn ='';
    if(get_theme_mod('featuredlite_sticky_header_disable')=='1'){
    $header_fixed_cls = 'header-fixed';
    }else{
    $header_fixed_cls ='';
    }
    if(get_theme_mod('header_layout')=='center'){
    $cntralign_menu = 'menu-center';
    }else{
    $cntralign_menu='';
    }
    if(get_theme_mod('header_layout')=='split'){
    $split_menu ='menu-center split-menu';
    }else{
    $split_menu ='';
    }
    if(get_theme_mod('header_layout')=='default'){
    $split_menu ='';
    $cntralign_menu='';
    }
    if(get_theme_mod('hdr_bg_trnsparent_active','1')=='1'){
    $hdr_trnsprnt ='hdr-transparent';
    }else{
    $hdr_trnsprnt ='';
    }
    if(get_theme_mod('last_menu_btn')=='1'){
    $last_btn ='last-btn';
    }else{
    $last_btn ='';
    }
     ?>
   <header id="header" class="<?php echo esc_attr($header_fixed_cls); ?> <?php echo esc_attr($cntralign_menu); ?> <?php echo esc_attr($split_menu); ?> <?php echo esc_attr($hdr_trnsprnt); ?> <?php echo esc_attr($last_btn); ?>">
      <a class="skip-link screen-reader-text" href="#page"><?php _e( 'Skip to content', 'featuredlite' ); ?></a>
      <div class="header-img">
      <div class="overlay-demo"></div>
        </div>
        <div class="header-wrapper" >
          <!-- Start Of Top Container -->
          <div class="container">
            <div class="header">
              <!-- Start Of Logo -->
              <div class="logo">
                <div class="logo-img">
                  <?php featuredlite_the_custom_logo();?>
                  <?php
                if(get_theme_mod('title_disable','enable')!=''){
                  if ( is_front_page() && is_home() ) : ?>
                  <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                  <?php else : ?>
                  <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                  <?php endif;
                  $description = get_bloginfo( 'description', 'display' );
                  if ( $description || is_customize_preview() ) : ?>
                  <p><?php echo $description; ?></p>
                  <?php endif;  
                } ?>
                </div>
              </div>
              <!-- End Of Logo -->
              <div id="main-menu-wrapper">
                <a href="#" id="pull" class="toggle-mobile-menu"></a>
                <nav class="navigation clearfix mobile-menu-wrapper">
                  <?php if ( is_front_page()) :
                  featuredlite_nav_menu();
                  else:
                  featuredlite_secnd_menu();
                  endif;
                  ?>
                </nav>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
    </header>
<?php }
add_action('featuredlite_header', 'featuredlite_full_header_markup');
}

if ( !function_exists('featuredlite_full_footer_markup') ) {
function featuredlite_full_footer_markup() { 
    get_sidebar('footer'); ?>
</div>
<div class="footer-copyright">
<div class="container">
    <ul>
        <li class="copyright">
            <?php 
            $allowed_html = array(
                                  'a' => array(
                                  'href' => array(),
                                  'title' => array(),
                                  'target' => array()
                              ),
                              'br' => array(),
                              'em' => array(),
                              'strong' => array(),
                          );
                $url = "https://themehunk.com";
              echo  sprintf( 
                wp_kses( __( 'Featuredlite developed by <a href="%s" target="_blank">ThemeHunk</a>', 'featuredlite' ), $allowed_html), esc_url( $url ) );
            ?>
        </li>
        <li class="social-icon">
            <?php featuredlite_social_links(); ?>
        </li>
    </ul>
</div>
</div>
    <?php }

// Hook the custom footer function into 'zita_footer'
add_action('featuredlite_footer', 'featuredlite_full_footer_markup');
}

 if ( ! function_exists( 'featuredlite_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 * Does nothing if the custom logo is not available.
 */
function featuredlite_the_custom_logo() {
    if ( function_exists( 'the_custom_logo' ) ) {
        the_custom_logo();
    }
}
endif;
/*
 * Custom header menu
*/
function featuredlite_add_menuclass($ulclass) {
   return preg_replace('/<a /', '<a class="page-scroll"', $ulclass);
}
add_filter('wp_nav_menu','featuredlite_add_menuclass');

add_action( 'after_setup_theme', 'featuredlite_register_theme_menu' );
function featuredlite_register_theme_menu() {
  register_nav_menu( 'primary', __( 'Front Menu', 'featuredlite' ) );
}
function featuredlite_nav_menu(){
    	wp_nav_menu( array('theme_location' => 'primary', 
    	'container' => false, 
    	'menu_class' => 'menu', 
    	'menu_id'         => 'menu',
    	'fallback_cb'     => 'featuredlite_wp_page_menu'));
    }

function featuredlite_wp_page_menu()
{
    echo '<ul class="menu" id="menu">';
    wp_list_pages(array('title_li' => ''));
    echo '</ul>';
}
// pagemenu
add_action( 'after_setup_theme', 'featured_register_secondary_menu' );
function featured_register_secondary_menu() {
register_nav_menu( 'page', __( 'Main Menu', 'featuredlite' ) );
}
function featuredlite_secnd_menu(){
        wp_nav_menu( array('theme_location' => 'page', 
        'container' => false, 
        'menu_class' => 'menu', 
        'menu_id'         => 'menu',
        'fallback_cb'     => 'featuredlite_wp_secnd_menu'));
    }

function featuredlite_wp_secnd_menu()
{
    echo '<ul class="menu" id="menu">';
    wp_list_pages(array('title_li' => ''));
    echo '</ul>';
}

/**
 * Display navigation to next/previous post when applicable.
 *
 * @since ThemeHunk 1.0
 */
if ( ! function_exists( 'featuredlite_post_nav' ) ) :
function featuredlite_post_nav() {
    // Don't print empty markup if there's nowhere to navigate.
    ?>
    <nav class="navigation post-navigation" role="navigation">
        <div class="nav-links">
           <?php
              the_posts_navigation( array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( '%title', 'featuredlite' ) . '</span> ' ,
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( '%title', 'featuredlite' )));
                //%title
            ?>
        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}
endif;
/**
 * custom post excerpt
 */
function featuredlite_get_th_custom_excerpt(){
$excerpt = get_the_content();
$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
$excerpt = strip_shortcodes($excerpt);
$excerpt = strip_tags($excerpt);
$excerpt = substr($excerpt, 0, 100);
$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
//$return =  '<p>'.$excerpt.'</p><span class="read-more"><a href="'.get_permalink().'" >Read More</a></span>';
return '<p>'.$excerpt.'</p>';
}
// related post
function featuredlite_get_related_sigle_post() {
    global $post;
     $args = array(
               'category__in' => wp_get_post_categories($post->ID),
               'post__not_in' => array($post->ID),
                'post_status' => array('publish'),                         
                'meta_key' => '_thumbnail_id',
                'posts_per_page' => 3,
            );
        $my_query = new WP_Query($args);
        if ($my_query->have_posts()) {?>
        <h3 class="related-heading">
            <?php _e('You may also like this','featuredlite'); ?></h3>
        <?php 
            while ($my_query->have_posts()) : $my_query->the_post();
                ?>
               <li class="sl-related-thumbnail">
                    <div class="sl-related-thumbnail-size">
                        <?php
                       if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
                            ?>
                            <a href="<?php esc_url(the_permalink()); ?>">
                            <?php the_post_thumbnail('custom-releted-post-thumb',array('class' => "postimg listing-thumbnail")); ?></a>
                            <?php }  ?>
                        </div>
                    <h3><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>
                </li>
                <?php
            endwhile;
        }
     wp_reset_postdata(); // to use the original query again
}

/*Number of comment*/
function featuredlite_comment_number(){
 comments_popup_link(__('No Comment','featuredlite'), __('1 Comment','featuredlite'), __('% Comments','featuredlite')); 
 }
/**
  * dynamic social link
  */
function featuredlite_social_links(){
?>
<ul>
<?php if($f_link = get_theme_mod('f_link')) : ?><li><a target='_blank' href="<?php echo esc_url($f_link); ?>" ><i class='fab fa-facebook-f'></i></a></li><?php endif; ?>
<?php if($t_link = get_theme_mod('t_link')) : ?><li><a target='_blank' href="<?php echo esc_url($t_link); ?>" ><i class='fab fa-twitter'></i></a></li><?php endif; ?>
<?php if($l_link = get_theme_mod('l_link')) : ?><li><a target='_blank' href="<?php echo esc_url($l_link); ?>" ><i class='fab fa-linkedin-in'></i></a></li><?php endif; ?>
<?php if($p_link = get_theme_mod('p_link')) : ?><li><a target='_blank' href="<?php echo esc_url($p_link); ?>" ><i class='fab fa-pinterest-p'></i></a></li><?php endif; ?>

<?php if($y_link = get_theme_mod('y_link')) : ?><li><a target='_blank' href="<?php echo esc_url($y_link); ?>" ><i class="fab fa-youtube"></i></a></li><?php endif; ?>
<?php if($i_link = get_theme_mod('i_link')) : ?><li><a target='_blank' href="<?php echo esc_url($i_link); ?>" ><i class="fab fa-instagram"></i></a></li><?php endif; ?>
<?php if($s_link = get_theme_mod('s_link')) : ?><li><a target='_blank' href="<?php echo esc_url($s_link); ?>" ><i class="fab fa-skype"></i></a></li><?php endif; ?>
    </ul>
<?php
  }
  
//pagination
function featuredlite_pagination() {
     the_posts_pagination( array(
    'mid_size' => 2,
) ); 
}

/*
 *   Mobile device detection
 */
if( !function_exists('featuredlite_mobile_user_agent_switch') ){
    function featuredlite_mobile_user_agent_switch(){
        $device = '';
        
        if( stristr($_SERVER['HTTP_USER_AGENT'],'ipad') ) {
            $device = "ipad";
        } else if( stristr($_SERVER['HTTP_USER_AGENT'],'iphone') || strstr($_SERVER['HTTP_USER_AGENT'],'iphone') ) {
            $device = "iphone";
        } else if( stristr($_SERVER['HTTP_USER_AGENT'],'blackberry') ) {
            $device = "blackberry";
        } else if( stristr($_SERVER['HTTP_USER_AGENT'],'android') ) {
            $device = "android";
        }

        if( $device ) {
            return $device; 
        }else{
            return false;
        }
    }
}

function featuredlite_custom_header(){
    $bg  ='';
    if(get_header_image()!=''){
   $bg ="background-image:url(".esc_url(get_header_image()).");";
    }else{
    $bg ="background-color:#".esc_attr(get_header_textcolor()).";";
    }
      $custom_css = "#header .header-img{ {$bg} }";

                return $custom_css;
}

// ----------------------------//
// layout choose function
//-----------------------------//
if (!function_exists( 'featuredlite_layout' ) ) {
    function featuredlite_get_layout( $default = 'right' ) {
    $layout = get_theme_mod( 'featuredlite_layout', $default );
    return apply_filters( 'featuredlite_get_layout', $layout, $default );
    }
}

add_filter( 'woocommerce_output_related_products_args', 'featuredlite_related_products_args' );
function featuredlite_related_products_args( $args ) {
$args['posts_per_page']     = 3; // 4 related products
$args['columns']            = 3; // arranged in columns

return $args;
}

function active_plugin(){
   $plugin_slug = 'themehunk-customizer';
        $active_file_name =  $plugin_slug.'/'.$plugin_slug.'.php';
        $button_class = 'install-now button button-primary button-large';
  $install_url = add_query_arg(array(
                        'action' => 'activate',
                        'plugin' => rawurlencode( $active_file_name ),
                        'plugin_status' => 'all',
                        'paged' => '1',
                        '_wpnonce' => wp_create_nonce('activate-plugin_' . $active_file_name ),
                    ), network_admin_url('plugins.php'));
                    $button_class = 'activate-now button-primary button-large';
                    $button_txt = esc_html__( 'Setup Homepage', 'featuredlite' );
if ( is_plugin_active( $active_file_name ) ) {
  echo false;
}else{
  echo $install_url;

} 
        

}



function featuredlite_home_page_check(){
  $pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'home-template.php'
));
  $post_id = isset($pages[0]->ID)?$pages[0]->ID:false;
  return $post_id;
}

add_action( 'wp_ajax_featuredlite_default_home', 'featuredlite_default_home' );
function featuredlite_default_home() {

  $post_id = featuredlite_home_page_check();
if(empty($pages)){
      $post_id = wp_insert_post(array (
       'post_type' => 'page',
       'post_title' => 'Home Page',
       'post_content' => '',
       'post_status' => 'publish',
       'comment_status' => 'closed',   // if you prefer
       'ping_status' => 'closed',      // if you prefer
       'page_template' =>'home-template.php', //Sets the template for the page.
    ));
  }
      if($post_id){
        update_option( 'page_on_front', $post_id );
        update_option( 'show_on_front', 'page' );
    }
 active_plugin();

    wp_die(); // this is required to terminate immediately and return a proper response
}