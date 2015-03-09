<?php
/**
 * Helper functions and setup for the theme.
 */

/**
 * Add JS required on every page.
 */
if (!is_admin()) {

    // header
    wp_enqueue_script(
        'modernizr', 
        get_template_directory_uri() . '/js/modernizr.min.js',
        array(),
        '2.0.6'
    );

    // footer
    wp_deregister_script('jquery');
    wp_enqueue_script(
        'jquery', 
        site_url('/wp-includes/js/jquery/jquery.js'),
        array(),
        null,
        true
    );
    wp_enqueue_script(
        'fake-jquery', 
        get_template_directory_uri() . '/js/fake-jquery.js',
        array('jquery'),
        '1.0.0',
        true
    );
    wp_enqueue_script(
        'general', 
        get_template_directory_uri() . '/js/general.js',
        array('jquery'),
        '1.0.0',
        true
    );
    wp_enqueue_script(
        'picturefill', 
        get_template_directory_uri() . '/js/picturefill.min.js',
        array(),
        '2.1.0',
        true
    );
}

/**
 * Add CSS required on every page
 */
if (!is_admin()) {
    wp_enqueue_style('style-name', get_template_directory_uri() . '/css/theme.css');
}

/**
 * Image sizes.
 * 
 * Images are resized as they are uploaded. If you add or change a size
 * you must run the regenerate thumbnails tool in the admin.
 */
if (function_exists('add_image_size')) {
    add_image_size('two-col-square', 488, 488, true);
    add_image_size('one-col-square', 240, 240, true);
    add_image_size('half-col-square', 108, 108, true);
    add_image_size('one-col-rect', 240, 116, true);
    add_image_size('one-col', 240);
    add_image_size('icon-1x', 31, 31, true);
    add_image_size('icon-2x', 62, 62, true);
    add_image_size('sidebar-small', 85, 85, true);

    /**
     * Define the image sizes that can be chosen in the WYSIWYG editor.
     * @param array $sizes
     * @return array
     */
    add_filter('image_size_names_choose', 'ex_image_sizes');
    function ex_image_sizes($sizes)
    {
        return array(
            'two-col-square' => __('Two columns, square'),
            'one-col-square' => __('One column, square'),
            'one-col' => __('One column, fluid height'),
            'thumbnail' => __('Thumbnail'),
            'icon-1x' => __('Icon'),
        );
    }

}

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {  
    // Define the style_formats array
    $style_formats = array(  
        // Each array child is a format with it's own settings
        array(
            'title' => 'Font size: 32px',
            'inline' => 'span',
            'classes' => 'cms h1',
            'wrapper' => false,
            ),
        array(
            'title' => 'Font size: 20px',
            'inline' => 'span',
            'classes' => 'cms h2',
            'wrapper' => false,
            ),
        array(  
            'title' => 'Button',  
            'inline' => 'span',  
            'classes' => 'cms btn',
            'wrapper' => false,        
        ),
        array(  
            'title' => 'Button - red',  
            'inline' => 'span',  
            'classes' => 'cms btn red',
            'wrapper' => false,        
        ),
        array(  
            'title' => 'Button - blue',  
            'inline' => 'span',  
            'classes' => 'cms btn blue',
            'wrapper' => false,        
        ),
        array(  
            'title' => 'Button - green',  
            'inline' => 'span',  
            'classes' => 'cms btn green',
            'wrapper' => false,        
        ),

    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
    
    return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

/**
 * Custom rewrites for forum archives
 */
add_action('init', 'filter_forum_rewrite');
function filter_forum_rewrite() 
{
    add_rewrite_rule('^forum/year/([^/]*)/?$', 'index.php?forum_year=$matches[1]&post_type=forum_post', 'top');
    add_rewrite_rule('^forum/category/([^/]*)/?$', 'index.php?forum_categories=$matches[1]&post_type=forum_post', 'top');
}

add_filter('term_link', 'filter_forum_tax_link', 10, 3);
function filter_forum_tax_link($url, $term, $taxonomy)
{   
    if($taxonomy == 'forum_year'){
        $url = str_replace('forum_year', 'forum/year', $url);
    }
    if($taxonomy == 'forum_categories'){
        $url = str_replace('forum_categories', 'forum/category', $url);
    }
    return $url;
}

/**
 * Change the registration URL on the login form to our custom page.
 */
add_filter( 'register_url', 'gform_register_page' );
function gform_register_page( $register_url ) {
    return home_url() . '/register/';
}

/**
 * Custom formatting of comment HTML.
 */
// Include the comment walker
include(dirname(__FILE__) . '/lib/comment_walker.php');
// Change the date format for comments
add_filter('get_comment_date', 'ex_comment_date_format', 0, 3);
function ex_comment_date_format($date, $d, $comment )
{
    return date('d.m.y', strtotime($date));
}

/**
 * Filter to wrap WYSIWYG images with a span to allow us to fit them in the 
 * column sizes.
 * @param string $content
 * @return string
 */
add_filter('the_content', 'filter_wrap_images');
function filter_wrap_images($content)
{
    return preg_replace(
        '/(<a.*?>)?(\s*)(<img class="([^"]*?)" .* \/>)(\s*)(<\/a>)?/iU', 
        '<span class="image-wrap $4">$1$3$6</span>', 
        $content
    );
}

/**
 * Set up ACF options pages.
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
    acf_add_options_sub_page('Contact details');
    acf_add_options_sub_page('Community forum');
    acf_add_options_sub_page('Search results');
    acf_add_options_sub_page('Sharing');
    acf_add_options_sub_page('Twitter');
}

/**
 * Helper function to add the breadcrumb.
 */
function breadcrumb()
{
    yoast_breadcrumb('<div class="breadcrumbs">', '</div>', true);
}

/**
 * 
 * @param type $image_size
 * @param type $max_images
 */
function the_post_image($image_size = 'thumbnail', $max_images = -1, $field_name = 'images')
{
    include locate_template('partials/post-images.php');
}

/**
 * Set up the theme's navigation areas
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus
 */
register_nav_menus(array(
    'primary' => 'Primary Navigation', // Tabs at the top
    'footer' => 'Footer Navigation', // 3rd col in the footer
    'header' => 'Header Navigation', // Next to search
));

/**
 * Add automatic theme links
 * @link http://codex.wordpress.org/Automatic_Feed_Links
 */
add_theme_support('automatic-feed-links');

/**
 * Turn on HTML 5 support
 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
 */
add_theme_support('html5', array('comment-list', 'comment-form', 'search-form'));

/**
 * Enqueue jQuery from the CDN instead of the pre-installed version.
 */
if (!is_admin()) {
    add_action("wp_enqueue_scripts", "tb_jquery_enqueue", 11);
    function tb_jquery_enqueue()
    {
        wp_deregister_script('jquery');
        wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js", false, null);
        wp_enqueue_script('jquery');
    }
}

/**
 * Add a custom stylesheet for the login page.
 */
add_action('login_enqueue_scripts', 'tb_login_stylesheet');
function tb_login_stylesheet()
{
    ?>
    <link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_bloginfo('stylesheet_directory') . '/css/login.css'; ?>" type="text/css" media="all" />
    <?php
}

function woocommerce_template_loop_product_thumbnail()

	{
		the_post_thumbnail();	
		
	}
	
function woocommercebreadcrumb()

	{
		echo "<div class='breadcrumbs wcbc'>";
		echo "<a href='".get_bloginfo('home')."/go-shopping'>Go Shopping</a> / ";	
		global $post;
$terms = get_the_terms( $post->ID, 'product_cat' );
print_r($terms);
foreach ($terms as $term) {
    $name = $term->name;
	$slug = $term->slug;
    break;
}
	
	echo "<a href='".get_bloginfo('home')."/product-category/".$slug."'>".$name."</a> ";
	if(is_single()):
	echo "/ ". get_the_title();
	endif;
	
	
		echo "</div>";
	}