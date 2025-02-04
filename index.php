<?php get_header(); ?>

<div class="bixbox hothome">
   <div class="releases">
      <h3><span>Hot Komik Update</span></h3>
   </div>
   <div id="" class="listupd komikinfo">
         <div class="swiper">
            <div class="swiper-wrapper">
               <?php
               $hotcount = get_option('hotpost');
   $myposts = array(
       'showposts' => $hotcount,
       'post_type' => 'komik',
      'meta_query' => 'smoke_hot',
      'meta_value' => 'Yes'
   );
   $wp_query= null;
   $wp_query = new WP_Query();
   $wp_query->query($myposts);
   ?>
               <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
               <?php get_template_part('template-parts/post/hots'); ?>
               <?php endwhile; ?>
            </div>
         </div>
   </div>
</div>
<?php wp_reset_query(); wp_reset_postdata(); ?>
<div class="postbody">

   <?php $notice = get_option('notice'); if($notice) { ?>
   <p class="index"><?php echo $notice; ?></p>
   <?php } ?>
	
   <div class="bixbox">
      <div class="releases">
         <h3><span>Update Projek Komikcast</span></h3>
         <a class="vl" href="<?php bloginfo('url'); ?>/project-list/">View All</a>
      </div>
      <?php get_template_part('template-parts/post/content','project'); ?>
   </div>

   <?php wp_reset_query(); wp_reset_postdata(); ?>
	<?php $homeslider = get_option('homeslider'); if($homeslider){echo '<div style="padding:1rem 0;margin:0 auto;">'.$homeslider.'</div>';};?>
   <div class="bixbox">
      <div class="releases">
         <h3><span>Rilisan Terbaru</span></h3>
         <a class="vl" href="<?php bloginfo('url'); ?>/daftar-komik/?orderby=update">View All</a>
      </div>
      <?php get_template_part('template-parts/post/content'); ?>
   </div>
   <?php wp_reset_query(); wp_reset_postdata(); ?>


</div>


<?php get_sidebar(); ?>


<?php get_footer(); ?>