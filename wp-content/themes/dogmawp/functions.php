<?php
// Enqueue Style
require get_template_directory() . '/includes/style.php';
// Enqueue JS
require get_template_directory() . '/includes/js.php';
// redux options	
require get_template_directory() . '/includes/sample-config.php';
require get_template_directory() . '/includes/color.php';
require get_template_directory() . '/includes/AfterSetupTheme.php';
require get_template_directory() . '/includes/functions.php';
require get_template_directory() . '/pagination.php';
if ( ! isset( $content_width ) ) $content_width = 900;	

$wr_options = get_option('wr_wp');
if ($wr_options['social-menu']=="st2") {
// register nav menu
function dogma_register_menus() {
register_nav_menus( array( 
'top-menu' => esc_attr__( 'Primary menu','dogmawp' ),
'footer-menu' => esc_attr__( 'Footer menu','dogmawp' ),
	)
		);
}
add_action('init', 'dogma_register_menus');
}
else{
// register nav menu
function dogma_register_menus() {
register_nav_menus( array( 
'top-menu' => esc_attr__( 'Primary menu','dogmawp' ),
)
		);
}
add_action('init', 'dogma_register_menus');
}
add_action( 'after_setup_theme', 'dogma_setup' );
function dogma_setup() {
// Theme Support  
	function dogma_editor_styles() {
    add_editor_style( 'style.css' );
}
	add_action( 'after_setup_theme', 'dogma_add_editor_styles' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'custom-header' );
	add_theme_support( "title-tag" );
	add_theme_support( 'post-formats', array('image','video', 'gallery') );
	add_post_type_support( 'portgallery', 'post-formats' );
}
// Word Limit 
	function dogma_string_limit_words($string, $word_limit)
	{
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
	}
// Add post thumbnail functionality
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 559, 220, true ); // Normal post thumbnails
	add_image_size( 'dg_portfolio_image', 683, 441, true ); // port Thumbnail
	add_image_size( 'dg_blog_details_image', 1024, 661, true ); // port Thumbnail
require(get_template_directory().'/symple-shortcodes/symple-shortcodes.php');
// How comments are displayed
function dogma_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
if ( 'div' == $args['style'] ) {
      $tag = 'div';
      $add_below = 'comment';
    } else {
      $tag = 'li';
      $add_below = 'div-comment';
    }
?>
    <<?php echo balanceTags($tag); ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?>>
    <?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author">
    <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    </div>
	<cite class="fn"><?php printf(__('%s','dogmawp'), get_comment_author_link()) ?></cite>
	 <div class="comment-meta">
       <h6><a href="#"><?php comment_date('F j, Y \a\t g:i a'); ?></a> / <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></h6>
     </div>
     <?php comment_text() ?>   
      <?php if ($comment->comment_approved == '0') : ?>
    <em class="comment-awaiting-moderation"><?php esc_attr_e('Your comment is awaiting moderation.','dogmawp') ?></em>
    <br />
   <?php endif; ?>    
<?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
<?php
        }
// create sidebar & widget area
if(function_exists('register_sidebar')) {
function dogma_theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => esc_attr__( 'Blog Sidebar', 'dogmawp' ),
        'id' => 'sidebar-1',
        'description' => esc_attr__( 'This area for Blog widgets.', 'dogmawp' ),
        'before_widget' => '<div id="%1$s" class="widget grid-item-holder wr-widget-main %2$s"><article>',
		'after_widget'  => '</article></div>', 
		'before_title'  => '<ul class="blog-title"><li>', 
		'after_title'   => '</li></ul>'
    ) );
}
add_action( 'widgets_init', 'dogma_theme_slug_widgets_init' );
}
/* Include Meta Box Framework */
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/includes/metaboxes' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/includes/metaboxes' ) );
require_once RWMB_DIR . 'meta-box.php';
include(get_template_directory().'/includes/metaboxes.php');
if(function_exists('vc_set_as_theme')) vc_set_as_theme();
// Initialising Shortcodes
if (class_exists('WPBakeryVisualComposerAbstract')) {
  function requireVcExtend(){
    require_once get_template_directory() . '/extendvc/extend-vc.php';
  }
  add_action('init', 'requireVcExtend',2);
}
