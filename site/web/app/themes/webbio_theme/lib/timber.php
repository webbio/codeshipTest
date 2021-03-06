<?php
use Roots\Sage\Setup;
/**
 * Check if Timber is activated
 */
if ( ! class_exists( 'Timber' ) ) {
  add_action( 'admin_notices', function() {
    echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
  } );
  return;
}
/**
 * Timber
 */
class TwigSageTheme extends TimberSite {
  function __construct() {
    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    parent::__construct();
  }
  function add_to_context( $context ) {
    /* Menu */
    $context['menu']['main']             = new TimberMenu('Main menu');
    $context['menu']['footer_nav']       = new TimberMenu('Footer nav');
    $context['menu']['footer_navbar']    = new TimberMenu('Footer menu');
    /* Footer */
    $context['footer']                   = get_option( 'page_options_footer' );
    /* Breacrumbs */
    $context['breadcrumb']               = function_exists('yoast_breadcrumb') ? yoast_breadcrumb('<div class="uk-breadcrumb">','</div>', false ) : '';
    /* Site info */
    $context['site'] = $this;
    /* Site info */
    // $context['display_sidebar'] = Setup\display_sidebar();
    // $context['sidebar_primary'] = Timber::get_widgets('sidebar-primary');
    return $context;
  }
}
new TwigSageTheme();
