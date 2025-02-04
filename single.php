<?php get_header(); ?>
<div class="bigblogt">
   <h1><?php the_title(); ?></h1>
   <span>Diposting oleh <?php $author_id = get_post_field( 'post_author', get_the_ID() ); echo get_the_author_meta('user_nicename', $author_id); ?> pada <?php the_time('l, F j, Y'); ?> - <?php the_time('H:i'); ?> WIB <?php term(get_the_ID(),'post_tag'); ?></span>
</div>
<div class="postbody komikinfo">
   <div class="bixbox">
      <div class="page blog">
         <div class="thumb">
            <div class="shdwx"></div>
       <?php the_thumbnail(); ?>
         </div>
    <?php the_content(); ?>
         <div class="rt">
            <div class="rating"></div>
         </div>
      </div>
   </div>
   
    <div class="bixbox">
  <div class="releases"><h3><span>Comment</span></h3></div>
  <div class="cmt commentx">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <?php echo get_post_meta($post->ID, "anime", true); ?>
  <?php comments_template(); ?>
  <?php endwhile; endif; ?>
     </div>
  </div>
</div>
<?php get_footer(); ?>