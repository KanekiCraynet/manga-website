<?php

add_filter('__user_read_marks', '__get_user_read_marks', 10, 1);
function __get_user_read_marks(\WP_Query $chapters)
{
    if (!$chapters || !$chapters->have_posts()) {
        echo "";
        return;
    }

    ob_start();
    foreach ($chapters->posts as $post):
        $meta    = get_post_meta($post->ID, 'smoker_chapter', true);
        ?>
<li class="komik_info-chapters-item" data-visited="<?=$post->ID?>">
    <a class="chapter-link-item" href="<?=get_the_permalink($post->ID);?>">Chapter
        <?php echo $meta; ?></a>
    <div class="chapter-link-time">
        <?php echo human_time_diff(get_the_time('U', $post), current_time('timestamp')) . ' ago'; ?>
    </div>
</li>
<?php
endforeach;

    echo ob_get_clean();
}

function __user_read($chapter = 0)
{
    $id = get_current_user_id();
    if (!$id) {
        return false;
    }

    $read = get_user_meta($id, '__user_chapter_read', true);

    if (!$read) {
        return false;
    }

    $read = json_decode($read, true);

    if (!in_array($chapter, $read)) {
        return false;
    }

    return true;

}

add_action('rest_api_init', '__rest_reads');
function __rest_reads()
{
    register_rest_route('tukutema/v1', 'read/(?P<id>\d+)', [
        'methods'             => 'POST',
        'permission_callback' => '__return_true',
        'args'                => [],
        'callback'            => '__user_add_read',
    ]);
}

function __user_add_read(WP_REST_Request $req)
{
    $komik = $req['id'];
    $uid   = get_current_user_id();

    $read   = get_user_meta($uid, '__user_chapter_read', true);
    $return = ['status' => false];
    if (!$read) {
        update_user_meta($uid, '__user_chapter_read', json_encode([$komik]));
        $return['status'] = true;
    } else {
        $read = json_decode($read, true);
        if (!in_array(intval($komik), $read)) {
            array_push($read, $komik);
            update_user_meta($uid, '__user_chapter_read', json_encode($read));
        }

        $return['status'] = true;
    }

    return new WP_REST_Response($return);
}