       <div class="slidtop">
            <div class="loop owl-carousel full owl-theme owl-center owl-loaded">
        
<?php
   $myposts = array(
       'showposts' => 7,
       'post_type' => 'komik',
       'orderby' => 'rand',
   );
   $wp_query= null;
   $wp_query = new WP_Query();
   $wp_query->query($myposts);
   ?>
<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?> 
                           <div class="slide-item full">
                           <div class="slide-bg"> <img src="<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); $meta = get_post_meta( get_the_ID(), 'snap_cover', true ); if($featured_img_url) { echo $featured_img_url; } else {echo $meta; } ?>"></div>
                           <div class="slide-shadow"></div>
                           <div class="slide-content">
                              <div class="poster" style="position:relative"> <a href="<?php the_permalink(); ?>">
                                <?php the_thumbnail(); ?>
                              </a></div>
                              <div class="info-left">
                                 <div class="title">
                                    <div class="rating">
                                       <div class="vote">
                                          <div class="site-vote"> <span class="dashicons dashicons-star-filled"><span><?php meta(get_the_ID(),'smoke_rate'); ?></span></span></div>
                                       </div>
                                    </div>
                                    <span class="ellipsis"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span> <span class="release-year"><?php meta(get_the_ID(),'snap_type'); ?></span>
                                 </div>
                                 <div class="extras">
                                    <div class="extra-category"><?php term(get_the_ID(),'genres'); ?></div>
                                 </div>
                                 <div class="excerpt">
                                    <span class="title">Summary</span>
                                    <p class="story"></p>
                                    <p><?php the_excerpt(); ?></p>
                                    <p></p>
                                 </div>
                                 <div class="cast"> <span class="director"><strong>Status:</strong> <?php meta(get_the_ID(),'smoke_status'); ?></span> <span class="actor"><strong>Author:</strong> <?php meta(get_the_ID(),'smoke_author'); ?></span></div>
                              </div>
                           </div>
                        </div>
                     <?php endwhile; ?>
   <?php wp_reset_query(); ?>

            </div>
            <script type="text/javascript">$(document).ready(function() {
               $('.loop').owlCarousel({
                   center: true,
                   loop:true,
                   nav:true,
                   //animateOut: 'fadeOut',
                   navText: ["<span class='prev icon-angle-left'></span>","<span class='next icon-angle-right'></span>"],
                   margin:0,
                   autoplay: true,
                autoplayTimeout:5000,
                      autoplayHoverPause:true,
                   responsive:{
                       0:{
                           items:1,
                           stagePadding: 0,
                       }
                   }
               });
               });
            </script> 
             <?php
$counter = 1;
   $posts = wp_most_popular_get_popular( array( 'limit' => 1, 'post_type' => 'komik', 'range' => 'weekly' ) );
global $post;
if ( count( $posts ) > 0 ): foreach ( $posts as $post ):
    setup_postdata( $post );
                echo ' ' . "\n";
?>   
            <div class="trending">
               <div class="tdb">
                  <a href="<?php the_permalink(); ?>">
                     <div class="crown"></div>
                     <div class="textbg blxc">
                        <div class="bghover"> <span class="numa">KomikCast <b>Trending</b> Minggu Ini</span> <span class="numb"><b><?php the_title(); ?></b></span></div>
                     </div>
                     <div class="imgxa">
                        <div class="imgxb" style="background-image: url('<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); $meta = get_post_meta( get_the_ID(), 'snap_cover', true ); if($featured_img_url) { echo $featured_img_url; } else {echo $meta; } ?>');"></div>
                     </div>
                  </a>
               </div>
            </div>
             <?php  ++$counter; endforeach; endif; ?>

         </div>