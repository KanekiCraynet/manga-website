<?php

add_action('rest_api_init', 'bookmark_rest_api');
function bookmark_rest_api()
{
    register_rest_route('tukutema/v1', 'bookmark/reset', [
        'methods'             => 'POST',
        'permission_callback' => '__return_true',
        'args'                => [

        ],
        'callback'            => '_reset_bookmark',
    ]);
    register_rest_route('tukutema/v1', 'bookmark/(?P<id>\d+)', [
        [
            'methods'             => 'POST',
            'permission_callback' => '__return_true',
            'args'                => [

            ],
            'callback'            => '__process_add_bookmark',
        ],
        [
            'methods'             => 'PUT',
            'permission_callback' => '__return_true',
            'args'                => [],
            'callback'            => '__process_remove_bookmark',
        ],
    ]);
}

function __process_add_bookmark(WP_REST_Request $req)
{
    if (!$req['id']) {
        return new WP_REST_Response(['status' => false, 'message' => 'Id salah!']);
    }

    $komik_id = intval($req['id']);
    $user_id  = get_current_user_id();

    if (!$user_id) {
        return new WP_REST_Response(['status' => false, 'message' => 'Kamu harus masuk terlebih dahulu!']);
    }

    $result        = [];
    $bookmark_data = get_user_meta($user_id, 'bookmarked_komik', true);
    $result['start'] = $bookmark_data;
    $bookmark_data = !is_null($bookmark_data) && !empty($bookmark_data) && 'null' !== $bookmark_data ? json_decode($bookmark_data, true) : [];
	$result['decoded'] = $bookmark_data;

    if (in_array($komik_id, $bookmark_data)) {
        $result['status']  = true;
        $result['message'] = 'Sudah ditambahkan.';
    } else {
        array_unshift($bookmark_data, $komik_id);
        $result['status']  = update_user_meta($user_id, 'bookmarked_komik', json_encode($bookmark_data));
        $result['message'] = 'Komik ditambahkan.';
        $result['end'] = $bookmark_data;
    }
    return new WP_REST_Response($result);
}

function __process_remove_bookmark(WP_REST_Request $req)
{
    if (!$req['id']) {
        return new WP_REST_Response(['status' => false, 'message' => 'Id salah!']);
    }

    $komik_id = intval($req['id']);
    $user_id  = get_current_user_id();

    if (!$user_id) {
        return new WP_REST_Response(['status' => false, 'message' => 'Kamu harus masuk dulu!']);
    }

    $result        = [];
    $bookmark_data = get_user_meta($user_id, 'bookmarked_komik', true);
    $result['start'] = $bookmark_data;
    $bookmark_data = !is_null($bookmark_data) && !empty($bookmark_data) && 'null' !== $bookmark_data ? json_decode($bookmark_data, true) : [];
    

    if (!$bookmark_data || empty($bookmark_data) || !is_array($bookmark_data) || !in_array($komik_id, $bookmark_data)) {
        $result['status']  = true;
        $result['message'] = 'Sudah dihapus.';
    } else {
        $filter = array_filter($bookmark_data, function ($id) use ($komik_id) {
            return intval($id) !== intval($komik_id);
        });

        $result['status']  = update_user_meta($user_id, 'bookmarked_komik', json_encode($filter));
        $result['message'] = 'Sudah dihapus.';
        $result['end'] = $filter;
    }
    return new WP_REST_Response($result);
}

function _reset_bookmark(WP_REST_Request $req)
{
    $param = $req->get_json_params();
    $uid   = get_current_user_id();
    $pass  = $param['password'];

    $user_data = get_userdata($uid);
    if (!wp_check_password($pass, $user_data->user_pass, $uid)) {
        return new WP_REST_Response(['status' => false, 'message' => 'Password salah.']);
    }

    $result = delete_user_meta($uid, 'bookmarked_komik');
    return new WP_REST_Response(['status' => $result, 'message' => $result ? 'Bookmark sudah di reset.' : 'Gagal reset bookmark, bookmark sudah dihapus atau tidak ada.']);
}

function _is_bookmarked()
{
    if (is_user_logged_in()) {
        $uid  = get_current_user_id();
        $kid  = get_the_ID();
        $meta = get_user_meta($uid, 'bookmarked_komik', true);
        $meta = !is_null($meta) && !empty($meta) && 'null' !== $meta ? json_decode($meta, true) : false;
        $meta = $meta ? array_map(function ($val) {return intval($val);}, $meta) : false;
        $is_bookmarked = $meta ? in_array($kid, $meta) : false;
    }

    $bookmarked = isset($is_bookmarked) && $is_bookmarked;
    ob_start();
    ?>
<div class="bookmark-wrapper">
    <div id="bookmark" class="bookmark_button" data-bookmarked='<?php echo $bookmarked ? "true" : "false" ?>'>
        <?php if (!$bookmarked): ?>
        <i class="fas fa-heart"></i> Bookmark
        <?php else: ?>
        <i class="fas fa-heart"></i> Bookmarked
        <?php endif;?>
    </div>

</div>
<?php
echo ob_get_clean();
}

function __get_user_bookmarks($orderby = 'added', $paged = 1)
{
    $uid   = get_current_user_id();
    $komik = get_user_meta($uid, 'bookmarked_komik', true);
    $komik = !is_null($komik) && !empty($komik) && 'null' !== $komik ? json_decode($komik, true) : [];

    if (!$komik || is_null($komik) || !is_array($komik)) {
        return ['type' => gettype($komik), 'komik' => $komik];
    }

    $args = [
        'post_type'      => 'komik',
        'posts_per_page' => 28,
        'post__in'       => $komik,
        'paged'          => $paged,
    ];

    switch ($orderby) {
        case 'added':
            $args['orderby'] = 'post__in';
            break;
        case 'title_asc':
            $args['orderby'] = 'title';
            $args['order']   = 'asc';
            break;
        case 'title_desc':
            $args['orderby'] = 'title';
            $args['order']   = 'desc';
            break;
    }

    $bookmarks = new WP_Query($args);

    return $bookmarks;
}