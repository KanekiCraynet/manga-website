<?php get_header(); 
/*
   Template Name: Project Page
*/
?>

<div class="postbody komikinfo">
  <div class="bixbox">

    <div class="releases">
      <h1><span><?php the_title(); ?></span></h1>
    </div>
    <div class="list-update_items">
      <div class="list-update_items-wrapper">
        <?php
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $count = get_option('mangapostprojectpage') ? get_option('mangapostprojectpage') : 14;
$myposts = array(
    'posts_per_page' => $count,
    'post_type' => 'komik',
'meta_query'          => array('relation' => 'AND', 0 => array('key' => 'manga_order_id','compare' => 'EXIST'), 1 => array('key' => 'smoke_project', 'value' => 'Yes', 'compare' => '=')),
       'paged' => $paged
);
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query($myposts);
?>
        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
        <?php  get_template_part('template-parts/post/archive');  endwhile; ?>
      </div>
    </div>
    <div class="pagination">
      <?php echo paginate_links(); ?>
    </div>
  </div>
</div>



<?php get_footer(); ?>