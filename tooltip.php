<?php 
require('../../../wp-blog-header.php');
$target = $_POST["id"]; 
$id = $target;
$post = get_post($id); //assuming $id has been initialized
setup_postdata($post);
$terms = get_the_term_list(get_the_ID(), 'genres', '','','')
?>
<div class="seriestitle"><?php the_title(); ?></div>
<div class="infseries">
<?php the_thumbnail(); ?>
    <div class="right">
        <span><b>Native Title</b>: <?php echo get_post_meta(get_the_ID(), 'smoke_nativez', true); ?></span>
        <span><b>Type</b>: <?php echo get_the_term_list(get_the_ID(), 'type'); ?></span>
        <span><b>Chapter</b>: <?php echo get_post_meta(get_the_ID(), 'smoke_total', true); ?></span>
        <span><b>Status</b>: <?php echo get_post_meta(get_the_ID(), 'smoke_status', true); ?></span>
        <span><b>Aired</b>: <?php echo get_post_meta(get_the_ID(), 'smoke_date', true); ?></span>
        <span><b>Genre</b> <?php if($terms && !is_wp_error($terms)){echo $terms;}else{echo 'null';} ?></span>
        <span><b>Score</b>: <?php echo get_post_meta(get_the_ID(), 'smoke_rate', true); ?></span>
        <div class="deskrip">
            <p><?php the_excerpt(); ?></p>
        </div>
    </div>
</div>
<?php wp_reset_postdata(); ?>