<?php

add_action('rest_api_init', '__rest_history');
function __rest_history()
{
    register_rest_route('tukutema/v1', 'history/(?P<id>\d+)', [
        'methods'             => 'POST',
        'permission_callback' => '__return_true',
        'args'                => [],
        'callback'            => '__set_user_history',
    ]);
    register_rest_route('tukutema/v1', 'history/reset', [
        'methods'             => 'POST',
        'permission_callback' => '__return_true',
        'args'                => [],
        'callback'            => '__reset_user_history',
    ]);
}

function __set_user_history(WP_REST_Request $req)
{
    $id = $req['id'];

    $uid = get_current_user_id();

    $key = "user_set_history_$id-$uid";
    if ($cached = __get_my_cache($key)) {
        return new WP_REST_Response($cached);
    }

    if (!$uid) {
        __set_my_cache($key, ['status' => false]);
        return new WP_REST_Response(['status' => false]);
    }

    $meta = get_user_meta($uid, '__user_history_data', true);

    __set_my_cache($key, ['status' => true]);
    if (!$meta) {
        update_user_meta($uid, '__user_history_data', json_encode([$id]));
        return new WP_REST_Response(['status' => true]);
    }

    $meta = json_decode($meta);
    if (in_array($id, $meta)) {
        $meta = array_filter($meta, function ($v) use ($id) {
            return $v !== $id;
        });
    } else {
        if (count($meta) > 50) {
            array_pop($meta);
        }
    }

    array_unshift($meta, $id);
    update_user_meta($uid, '__user_history_data', json_encode($meta));
    return new WP_REST_Response(['status' => true]);
}

add_filter('__user_history_read', '__user_get_history', 10, 1);
function __user_get_history($uid = null)
{
    $meta = get_user_meta($uid, '__user_history_data', true);
    if ($meta) {
        $posts = get_posts([
            'post_type'      => 'chapter',
            'post__in'       => json_decode($meta),
            'orderby'        => 'post__in',
            'posts_per_page' => 50,
        ]);

        ob_start();
        foreach ($posts as $chapter):
        ?>
<li class="komik_info-chapters-item">
    <a class="chapter-link-item" href="<?=get_the_permalink($chapter->ID);?>">
        <?php echo get_the_title($chapter); ?></a>
    <div class="chapter-link-time">
        <?php echo human_time_diff(get_the_time('U', $chapter), current_time('timestamp')) . ' ago'; ?>
    </div>
</li>
<?php
endforeach;
        echo ob_get_clean();
    } else {
        echo "<span>Belum ada apa-apa..</span>";
    }

}

function __reset_user_history(WP_REST_Request $req){
    $param = $req->get_json_params();
    $uid = get_current_user_id();
    $password = $param['password'];

    $user = get_userdata($uid);
    if(!wp_check_password($password, $user->user_pass, $uid)){
        return new WP_REST_Response(['status'=> false, 'message'=> 'Password salah.']);
    }

    $result = delete_user_meta($uid, '__user_history_data');
    return new WP_REST_Response(['status' => $result, 'message' => $result ? 'History sudah di reset.' : 'Gagal reset history, history sudah dihapus atau tidak ada.']);
}