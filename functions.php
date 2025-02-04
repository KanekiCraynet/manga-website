<?php

define('DEV_MODE', 0);

require_once 'inc/lib/plugins/wp-remote-thumbnail.php';
require_once 'inc/lib/plugins/Mobile_Detect.php';
require_once 'inc/auth.php';

$updates = glob(get_template_directory() . '/update/*.php');
foreach ($updates as $update) {
    require_once $update;
}

function posts_hide()
{
    remove_menu_page('edit.php');
}

add_action('admin_menu', 'posts_hide'); //adding action for triggering function call

$manga_order_id_key = 'smoke_series';

if (!function_exists('rwmb_meta')) {
    function rwmb_meta($key, $args = '', $post_id = null)
    {
        return false;
    }
}
function manga_order_save_post($id)
{
    global $manga_order_id_key;
    switch (get_post_type($id)) {
        case 'chapter':
            $get   = get_post_meta($id, $manga_order_id_key, true);
            $manga = get_post_meta($get, 'manga_order_id', true);
            if ($manga) {
                if ($id > (int) $manga) {
                    update_post_meta($get, 'manga_order_id', $id);
                }
            } else {
                add_post_meta($get, 'manga_order_id', $id);
            }
            break;
        case 'komik':
            $manga = get_post_meta($id, 'manga_order_id', true);
            if (!$manga) {
                add_post_meta($id, 'manga_order_id', $id);
            }
            break;
    }
}
add_action('save_post', 'manga_order_save_post');

function komik_list_enqueue()
{
    $detect = new Mobile_Detect;

    wp_enqueue_script('komik-redesign', get_template_directory_uri() . '/js/komik.redesign.js', array(), '1.71', true);
    $tooltip = get_option('tooltip');

    if ("on" === $tooltip && !$detect->isMobile()) {
        wp_enqueue_script('tooltip-init', get_template_directory_uri() . '/js/jquery.qtip.js', [], '3.0.1', true);
        wp_enqueue_script('tooltip-instance', get_template_directory_uri() . '/js/tooltip.js', [], '1.0.1', true);
    }

    if (is_page()) {
        wp_enqueue_style('bootstrap-5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', [], '5.2.3', 'all');
        wp_enqueue_script('bootstrap-5-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js', [], '5.2.3', true);
    }

    wp_enqueue_style('tukutema-pc-custom', get_template_directory_uri() . '/build/157f62ef.css', [], '5c5810807e', 'all');
    wp_enqueue_script('tukutema-pj-deps', get_template_directory_uri() . '/build/76fbc858.js', [], '5c5810807e', true);
    wp_enqueue_script('tukutema-pj-delete-bookmark', get_template_directory_uri() . '/build/24f41c4f.js', ['tukutema-pj-deps'], '5c5810807e', true);
    wp_enqueue_script('tukutema-pj-custom-js', get_template_directory_uri() . '/build/9fbf2bdc.js', ['tukutema-pj-deps'], '5c5810807e', true);

    $rest_nonce    = wp_create_nonce('wp_rest');
    $tukutema_rest = home_url('/wp-json/tukutema/v1/');
    $is_logged_in  = is_user_logged_in() ? 1 : 0;
    $redirect_url  = get_page_url('loginpages') . '?from=' . get_the_permalink(get_the_ID());
    wp_add_inline_script('komik-redesign', "var is_user_logged_in= $is_logged_in;var redirect_url='$redirect_url';var wp_rest_nonce ='$rest_nonce';var tukutema_rest = '$tukutema_rest';", 'before');
}
add_action('wp_enqueue_scripts', 'komik_list_enqueue');

add_filter('script_loader_tag', 'add_type_attribute', 10, 3);
function add_type_attribute($t, $h, $s)
{
    if (stripos($h, 'tukutema-') !== false) {
        $t = '<script type="module" id="' . $h . '" src="' . esc_url($s) . '" defer></script>';
    }

    return $t;
}

function meta_mal_enqueue()
{
    wp_enqueue_script('meta-mal', get_template_directory_uri() . '/js/mal.js', array(), '1.4', true);
}
add_action('admin_enqueue_scripts', 'meta_mal_enqueue');

/*** get post thumbnail ***/
function the_thumbnail()
{
    if (has_post_thumbnail()) {
        the_post_thumbnail('thumb');
    } else {
        $meta  = get_post_meta(get_the_ID(), 'dev_image', true);
        $image = !empty($meta) ? $meta : get_option('default_manga_cover', '');
        ?>
<img src="<?php echo $image; ?>" />
<?php }
}

function nextprev()
{
    $server_select = isset($_GET) && isset($_GET['srv']) ? '?srv=' . $_GET['srv'] : '';
    ?>
<div class="nextprev">
    <?php echo preg_replace('#<a(.*?)href="(.*?)"(.*?)>#', '<a href="$2' . $server_select . '"$3>', get_previous_post_link('%link', '« Previous Chapter', true)); ?><?php echo preg_replace('#<a(.*?)href="(.*?)"(.*?)>#', '<a href="$2' . $server_select . '"$3>', get_next_post_link('%link', 'Next Chapter »', true)); ?>
</div>
<?php }

/*** include section ***/
include 'inc/core.php';

function komikcast_all_scriptsandstyles()
{
    wp_register_script('placeholder', get_stylesheet_directory_uri() . '/js/placeholder.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('placeholder');
}
//add_action( 'wp_enqueue_scripts', 'komikcast_all_scriptsandstyles' );

/*** sidebar section ***/
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name'          => 'Sidebar Right',
        'id'            => 'sidebar-1',
        'before_widget' => '<div class="section">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="releases"><h4><span>',
        'after_title'   => '</span></h4></div>',
    ));
}

add_action('init', 'register_my_menus');

function register_my_menus()
{
    register_nav_menus(array(
        'main'   => __('Header Menu'),
        'bottom' => __('Bottom Menu'),
    ));
}

/* get post meta */
function meta($ID, $name)
{
    $meta = get_post_meta($ID, $name, true);
    echo $meta;
}

function term($ID, $name)
{
    echo get_the_term_list($ID, $name, '', ', ', '');
}

function term_sep($ID, $name)
{
    echo get_the_term_list($ID, $name, ' ');
}

if (!function_exists('dev_itemtype_schema')):
    function dev_itemtype_schema($type = 'Movie')
{
        $schema   = 'http://schema.org/';
        $itemtype = apply_filters('dev_article_itemtype', $type);
        $scope    = 'itemscope="itemscope" itemtype="' . $schema . $itemtype . '"';
        return $scope;
    }
endif;

if (!function_exists('dev_itemprop_schema')):
    function dev_itemprop_schema($type = 'headline')
{
        $itemprop = apply_filters('dev_itemprop_filter', $type);
        $scope    = 'itemprop="' . $itemprop . '"';
        return $scope;
    }
endif;

function SearchFilter($query)
{
    if ($query->is_search) {
        $query->set('post_type', array('komik'));
    }
    return $query;
}
if (!is_admin()) {
    add_filter('pre_get_posts', 'SearchFilter');
}

add_theme_support('automatic-feed-links');
function new_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
function custom_excerpt_length($length)
{
    return 23;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);
function excerpt($limit)
{
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
    return $excerpt;
}
add_filter('mce_buttons', 'my_add_next_page_button', 1, 2);
function my_add_next_page_button($buttons, $id)
{
    if ('content' != $id) {
        return $buttons;
    }

    array_splice($buttons, 13, 0, 'wp_page');
    return $buttons;
}
add_action('wp_enqueue_scripts', 'load_dashicons_front_end');
function load_dashicons_front_end()
{
    wp_enqueue_style('dashicons');
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css', [], '5.15', 'all');
    wp_enqueue_style('komik-redesign', get_template_directory_uri() . '/css/komik.redesign.css', [], 'r-1.70', 'all');
}
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
}
add_filter('wp_title', 'filter_wp_title');
/**
 * Filters the page title appropriately depending on the current page
 *
 * This function is attached to the 'wp_title' fiilter hook.
 *
 * @uses  get_bloginfo()
 * @uses  is_home()
 * @uses  is_front_page()
 */
function filter_wp_title($title)
{
    global $page, $paged;

    if (is_feed()) {
        return $title;
    }

    $site_description = get_bloginfo('description');

    $filtered_title = $title . get_bloginfo('name');
    $filtered_title .= (!empty($site_description) && (is_home() || is_front_page())) ? ' – ' . $site_description : '';
    $filtered_title .= (2 <= $paged || 2 <= $page) ? ' – ' . sprintf(__('Page %s'), max($paged, $page)) : '';

    return $filtered_title;
}

add_action('init', 'random_add_rewrite');
function random_add_rewrite()
{
    global $wp;
    $wp->add_query_var('random');
    add_rewrite_rule('random/?$', 'index.php?random=1', 'top');
}

add_action('template_redirect', 'random_template');
function random_template()
{
    if (get_query_var('random') == 1) {
        $posts = get_posts('post_type=komik&orderby=rand&numberposts=1');
        foreach ($posts as $post) {
            $link = get_permalink($post);
        }
        wp_redirect($link, 307);
        exit;
    }
}
add_action("wp_ajax_searchkomik_komikcast_redesign", "searchkomik_komikcast_redesign");
add_action("wp_ajax_nopriv_searchkomik_komikcast_redesign", "searchkomik_komikcast_redesign");
function searchkomik_komikcast_redesign()
{
    $result       = [];
    $searchquery  = $_POST['search'];
    $per_page     = $_POST['per_page'];
    $orderBy      = $_POST['order_by'];
    $getHistories = [
        'post_type'      => 'komik',
        'orderby'        => $orderBy,
        'order'          => 'asc',
        's'              => $searchquery,
        'posts_per_page' => $per_page,
    ];
    $searchkomikPosts = new WP_Query($getHistories);
    while ($searchkomikPosts->have_posts()): $searchkomikPosts->the_post();
        $thumbnail     = get_the_post_thumbnail(get_the_ID(), 'post-thumbnail', array('class' => 'image-thumbnail-img'));
        $permalink     = get_the_permalink();
        $title         = get_the_title();
        $term_obj_list = get_the_terms(get_the_ID(), 'genres');
        $terms         = [];
        foreach ($term_obj_list as $term) {
            $termlink = get_term_link($term, 'genres');
            $terms[]  = array(
                'name' => $term->name,
                'link' => $termlink,
            );
        }

        $result[] = [
            "thumbnail" => $thumbnail,
            "permalink" => $permalink,
            "title"     => $title,
            "genres"    => $terms,
        ];
    endwhile;
    wp_reset_postdata();
    die(json_encode($result));
}

function wpb_set_post_views($postID)
{
    $count_key = 'wpb_post_views_count';
    $count     = get_post_meta($postID, $count_key, true);
    if ('' == $count) {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function wpb_track_post_views($post_id)
{
    if (!is_single()) {
        return;
    }

    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    wpb_set_post_views($post_id);
}
add_action('wp_head', 'wpb_track_post_views');

function wpb_get_post_views($postID)
{
    $count_key = 'wpb_post_views_count';
    $count     = get_post_meta($postID, $count_key, true);
    if ('' == $count) {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count . ' Views';
}

function get_image()
{
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output    = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];

    if (empty($first_img)) {
        $first_img = get_template_directory_uri() . "/images/nothumb.png";
    }
    return $first_img;
}
function post_featured_image_json($data, $post, $context)
{
    $featured_image_id  = $data->data['featured_media']; // get featured image id
    $featured_image_url = wp_get_attachment_image_src($featured_image_id, 'original'); // get url of the original size

    if ($featured_image_url) {
        $data->data['featured_image_url'] = $featured_image_url[0];
    }

    return $data;
}
add_filter('rest_prepare_post', 'post_featured_image_json', 10, 3);
function adultwarning($idx, $days)
{
    $term_list = wp_get_post_terms($idx, 'genres', array("fields" => "names"));
    if (in_array("Ecchi", $term_list)) {?>
<script>
function createCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

var x = readCookie('komikcastreader');
if (!x) {
    if (!confirm("Halaman ini berisi konten dewasa, apakah anda ingin melanjutkannya?")) document.location =
        '<?php echo esc_url(home_url(' / ')); ?>';
    createCookie('komikcastreader', 'mature', <?php echo $days; ?>);
}
</script>
<?php }}

function redesign_social_sharing($id)
{

    // Get current page URL
    $redesignShareURL = urlencode(get_the_permalink($id));

    // Get current page title
    $redesignShareTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title($id), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
    // $redesignShareTitle = str_replace( ' ', '%20', get_the_title());

    // Get Post Thumbnail for pinterest
    $redesignShareThumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full');

    // Construct sharing URL without using any script
    $twitterURL  = 'https://twitter.com/intent/tweet?text=' . $redesignShareTitle . '&amp;url=' . $redesignShareURL . '&amp;via=krnm';
    $whatsapp    = 'whatsapp://send?text=' . $redesignShareTitle . ' ' . $redesignShareURL . '';
    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' . $redesignShareURL;
    $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $redesignShareURL . '&amp;title=' . $redesignShareTitle;

    // Based on popular demand added Pinterest too
    $pinterestURL = 'https://pinterest.com/pin/create/button/?url=' . $redesignShareURL . '&amp;media=' . $redesignShareThumbnail[0] . '&amp;description=' . $redesignShareTitle;
    $variable     = '';
    // Add sharing button at the end of page/page content

    $variable .= '<div class="redesign-social">';
    $variable .= '<a class="redesign-link redesign-twitter" href="' . $twitterURL . '" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>';
    $variable .= '<a class="redesign-link redesign-facebook" href="' . $facebookURL . '" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>';
    $variable .= '<a class="redesign-link redesign-linkedin" href="' . $linkedInURL . '" target="_blank"><i class="fab fa-linkedin-in"></i> LinkedIn</a>';
    $variable .= '<a class="redesign-link redesign-pinterest" href="' . $pinterestURL . '" data-pin-custom="true" target="_blank"><i class="fab fa-pinterest-p"></i> Pin It</a>';
    $variable .= '<a class="redesign-link redesign-whatsapp" href="' . $whatsapp . '" target="_blank"><i class="fab fa-whatsapp"></i> Whatsapp</a>';
    $variable .= '</div>';

    return $variable;
}

function myfeed_request($qv)
{
    if (isset($qv['feed']) && !isset($qv['post_type'])) {
        $qv['post_type'] = array('komik', 'chapter');
    }
    return $qv;
}
add_filter('request', 'myfeed_request');
function replace_thumbnail_statically($html)
{
    if (get_option('statically_thumbnail')) {
        $html = str_replace('https://', 'https://cdn.imagesimple.co/img/kcast/', $html);
        $html = str_replace('.jpg', '.jpg', $html);
        $html = str_replace(".jpeg", ".jpeg", $html);
        $html = str_replace(".png", ".png", $html);
        $html = str_replace(".gif", ".gif", $html);
        $html = str_replace(".webp", ".webp", $html);
    }
    return $html;
}
add_filter('post_thumbnail_html', 'replace_thumbnail_statically');

add_action('init', 'set_or_get_cookie_image');
function set_or_get_cookie_image()
{
    $current  = isset($_COOKIE) && isset($_COOKIE['_def_img_server']) ? $_COOKIE['_def_img_server'] : null;
    $selected = isset($_GET['srv']) && !empty($_GET['srv']) ? $_GET['srv'] : null;

    $_GET['selected_image_server'] = !is_null($current) ? $current : $selected;
    $_GET['cookie']                = $_COOKIE;

    $active = !is_null($selected) && $selected !== $current ? $selected : $current;
    return setcookie('_def_img_server', $active, current_time('timestamp') + YEAR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
}

function smartwp_remove_query_strings_from_static_resources($src)
{
    if (strpos($src, '?v=')) {
        $src = remove_query_arg('v', $src);
    }
    if (strpos($src, '?ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'smartwp_remove_query_strings_from_static_resources', 999);
add_filter('style_loader_src', 'smartwp_remove_query_strings_from_static_resources', 999);
add_filter('powered_cache_advanced_cache_purge_urls', function ($urls, $post_id) {
    $urls   = array();
    $urls[] = get_permalink($post_id);
}, 10, 2);

// add_action('after_setup_theme', 'remove_admin_bar');
// function remove_admin_bar() {
// if (!current_user_can('administrator') && !is_admin()) {
//   show_admin_bar(false);
// }
// }

// add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );