<?php
$post = $args['post'];
$type = strip_tags(get_the_term_list($post->ID, 'type'));
?>
<div class="list-update_item" data-bookmark-id="<?php echo $post->ID ?>">
    <a href="<?php echo get_the_permalink($post->ID) ?>" title="Revenge of the Iron-Blooded Sword Hound ">
        <div class="list-update_item-image">
            <div class="list-update_item-overlay"></div>
            <span class="type <?php echo strtolower($type); ?>-bg">
                <?php echo $type; ?>
            </span>
            <span class="flag <?php echo strtolower($type); ?>-bg">
            </span>
            <?php
$newdataimage = get_the_post_thumbnail_url($post->ID, 'full');
if (get_option('statically_link')) {
    $newdataimage = str_replace('https://', 'https://img.statically.io/img/kcast/', $newdataimage);
    $newdataimage = str_replace('.jpg', '.jpg?q=100', $newdataimage);
    $newdataimage = str_replace(".jpeg", ".jpeg?q=100" . $qim, $newdataimage);
    $newdataimage = str_replace(".png", ".png?q=100" . $qim, $newdataimage);
    $newdataimage = str_replace(".gif", ".gif?q=100" . $qim, $newdataimage);
    $newdataimage = str_replace(".webp", ".webp?q=100" . $qim, $newdataimage);
}
?>
            <img src="<?php echo $newdataimage; ?>" class="ts-post-image wp-post-image attachment-medium size-medium"
                loading="lazy" />

        </div>
        <div class="list-update_item-info">
            <div class="title"
                style="white-space:nowrap;display:inline-block; overflow: hidden; text-overflow: ellipsis; width: calc(100%);">
                <?php echo get_the_title($post->ID) ?>
            </div>
            <div class="other">
                <div class="rate">
                    <div class="rating">
                        <div class="rating-bungkus">
                            <div class="rating-bungkus-bintang">
                                <div class="rating-bintang">
                                    <?php
$rating = get_post_meta($post->ID, 'smoke_rate', true);if ('' == $rating) {$rating = '?';}
if ($rating) {$ma = $rating;} else { $ma = '0.0';}
?>
                                    <span style="width: <?php echo ($ma * 10); ?>%"></span>
                                </div>
                            </div>
                        </div>
                        <div class="numscore"><?php echo $rating; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>