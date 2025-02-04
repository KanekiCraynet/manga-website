<?php get_header();
/*
Template Name: Completed Page
 */
?>


<div class="postbody komikinfo">
    <div class="bixbox">

        <div class="releases">
            <h1><span><?php the_title();?></span></h1>
        </div>
        <div class="listupd">
            <div class="listo">
                <?php
$paged   = (get_query_var('paged')) ? get_query_var('paged') : 1;
$count   = get_option('mangapostprojectpage');
$myposts = array(
    'showposts'  => $count,
    'post_type'  => 'komik',
    'meta_query' => array('relation' => 'AND', 1 => array('key' => 'smoke_status', 'value' => 'Completed', 'compare' => '=')),
    'paged'      => $paged,
);
$wp_query = null;
$wp_query = new WP_Query();
$wp_query->query($myposts);
?>
                <?php while ($wp_query->have_posts()): $wp_query->the_post();?>

	                <div class="bs">
	                    <div class="bsx">
	                        <a href="<?php the_permalink();?>" title="<?php the_title();?>">
	                            <div class="limit">
	                                <div class="ply"></div>

	                                <span
	                                    class="type <?php echo strip_tags(get_the_term_list($post->ID, 'type')); ?>"><?php echo strip_tags(get_the_term_list($post->ID, 'type')); ?></span><?php the_post_thumbnail();?>

	                            </div>
	                            <div class="bigor">
	                                <div class="tt"> <?php the_title();?></div>
	                                <div class="adds">
	                                    <div class="epxs"> <?php
    $args = array(

        'post_type'      => 'chapter',
        'posts_per_page' => '1', // How many items to display
        'post__not_in' => array(get_the_ID()), // Exclude current post
        'no_found_rows' => true, // We don't ned pagination so this speeds up the query
    );
    $cats     = wp_get_post_terms(get_the_ID(), 'category');
    $cats_ids = array();
    foreach ($cats as $wpex_related_cat) {
        $cats_ids[] = $wpex_related_cat->term_id;
    }
    if (!empty($cats_ids)) {
        $args['category__in'] = $cats_ids;
    }
    $wpex_query = new wp_query($args);
    foreach ($wpex_query->posts as $post): setup_postdata($post);?>
		                                        <a
		                                            href="<?php the_permalink();?>">Ch.<?php $meta = get_post_meta(get_the_ID(), 'smoker_chapter', true);
        echo $meta;?></a>

		                                        <?php
    endforeach;
    wp_reset_postdata();?>
	                                    </div>
	                                    <div class="rating">
	                                        <div class="rtg">
	                                            <div class="br-wrapper br-theme-fontawesome-stars">
	                                                <?php $rating = get_post_meta(get_the_ID(), 'smoke_rate', true);if ('' == $rating) {$rating = '?';}?>
	                                                <?php if ($rating) {$ma = $rating / 2;} else { $ma = '0.0';}?>
	                                                <select class="score" data-current-rating="<?php echo $ma; ?>"
	                                                    autocomplete="off" style="display:none">
	                                                    <option value="1">1</option>
	                                                    <option value="2">2</option>
	                                                    <option value="3">3</option>
	                                                    <option value="4">4</option>
	                                                    <option value="5">5</option>
	                                                </select>
	                                            </div>
	                                        </div> <i><?php echo $rating; ?></i>
	                                    </div>
	                                </div>
	                            </div>
	                        </a>
	                    </div>
	                </div>

	                <?php endwhile;?>
            </div>
        </div>
        <div class="pagination">
            <?php echo paginate_links(); ?>
        </div>
    </div>
</div>

<?php get_footer();?>