<div class="bma">
   <div class="bmb">
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
         <div class="bmlimit">
            <div class="shd"></div>
           <?php the_post_thumbnail(); ?>
         </div>
      </a>
      <div class="bmba">
         <div class="bmbah">
            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
         </div>
         <div class="bmbaa"> <span class="l"><?php term(get_the_ID(),'post_tag'); ?> </span> <span class="r"><?php the_time('j  F Y'); ?></span></div>
      </div>
   </div>
</div>