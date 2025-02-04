<?php get_header(); 
/*
   Template Name: Blog Page
*/
?>

<div class="postbody komikinfo">
<div class="bixbox">
<div class="releases"><h1><span><?php the_title(); ?></span></h1></div>
<div class="page blogbox homeblog">
	 <div class="boxlist">
   <?php
   $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $count = get_option('blogpostpage');
   $myposts = array(
       'showposts' => $count,
       'post_type' => 'post',
       'orderby' => 'date',
           'paged' => $paged
   );
   $wp_query= null;
   $wp_query = new WP_Query();
   $wp_query->query($myposts);
   ?>
<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?> 
         <?php get_template_part('template-parts/post/blog'); ?>
         <?php endwhile; ?>        
     </div>
           <div class="pagination">
      <?php echo paginate_links(); ?>  
    </div>
</div>
</div>
	
</div>
<?php get_footer(); ?>