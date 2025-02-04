   <div class="listupd">

       <?php
$paged   = (get_query_var('paged')) ? get_query_var('paged') : 1;
$count   = get_option('mangapost');
$myposts = array(
    'showposts'              => $count,
    'post_type'              => 'komik',
    'orderby'                => 'date',
    'update_post_meta_cache' => true,

);
$wp_query = null;
$wp_query = new WP_Query();
$wp_query->query($myposts);
?>
       <?php while ($wp_query->have_posts()): $wp_query->the_post();?>
	       <div class="utao">
	           <div class="uta">
	               <div class="imgu data-tooltip" data-tooltip-id="<?php echo get_the_ID(); ?>"> <a rel="<?php the_ID();?>"
	                       class="series" href="<?php the_permalink();?>">
	                       <?php $meta = get_post_meta(get_the_ID(), 'smoke_hot', true);if ('Yes' == $meta) {?><span
	                           class="hot">Hot</span><?php }?>
	                       <?php the_thumbnail();?> </a></div>
	               <div class="luf">
	                   <a class="series data-tooltip" data-tooltip-id="<?php echo get_the_ID(); ?>"
	                       href="<?php the_permalink();?>" title="<?php the_title();?>">
	                       <h3><?php the_title();?></h3>
	                   </a>
	                   <ul class="<?php echo strip_tags(get_the_term_list($post->ID, 'type')); ?>">
	                       <?php

// Default arguments

    $args = array(

        'post_type'      => 'chapter',

        'posts_per_page' => 3, // How many items to display

        'post__not_in' => array(get_the_ID()), // Exclude current post

        'no_found_rows' => true, // We don't ned pagination so this speeds up the query

    );

// Check for current post category and add tax_query to the query arguments

    $cats = wp_get_post_terms(get_the_ID(), 'category');

    $cats_ids = array();

    foreach ($cats as $wpex_related_cat) {

        $cats_ids[] = $wpex_related_cat->term_id;

    }

    if (!empty($cats_ids)) {

        $args['category__in'] = $cats_ids;

    }

// Query posts

    $wpex_query = new wp_query($args);

// Loop through posts

    foreach ($wpex_query->posts as $post): setup_postdata($post);?>

		                       <li><a href="<?php the_permalink();?>">Chapter
		                               <?php meta(get_the_ID(), 'smoker_chapter');?></a><span><i><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></i></span>
		                       </li>

		                       <?php

// End loop

    endforeach;

// Reset post data

    wp_reset_postdata();?>
	                   </ul>
	               </div>
	           </div>
	       </div>
	       <?php
endwhile;
wp_reset_postdata();?>
       <!--selesai-->










       <div class="hpage"><a href="/daftar-komik/?sortby=update">View More <span
                   class="dashicons dashicons-arrow-right-alt2"></a></div>

   </div>