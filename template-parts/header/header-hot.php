<div class="hots" style="">
   <ul>
      <li class="hotss">HOT</li>
       <?php
    $myposts = array(
        'showposts' => '10',
        'post_type' => 'manga',
        'orderby' => 'date',
        'meta_key' => 'dev_hot',
        'meta_value' => 'Yes'
          );
    $wp_query = null;
    $wp_query = new WP_Query();
    $wp_query->query($myposts);
?>
    <?php
    while ($wp_query->have_posts()):
        $wp_query->the_post(); ?> 
         <li><a href="<?php the_permalink(); ?>" title="Manga <?php the_title(); ?>"><b><?php the_title(); ?></b></a></li>
     <?php endwhile; wp_reset_query(); wp_reset_postdata(); ?>
   </ul>
</div>