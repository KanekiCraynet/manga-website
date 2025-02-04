<div class="swiper-slide splide-slide">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <div class="splide__slide-image">
            <div class="splide__slide-overlay"></div>
            <span
                class="type <?php $type = strip_tags(get_the_term_list( $post->ID, 'type' )); echo strtolower($type); ?>-bg">
                <?php echo strip_tags(get_the_term_list( $post->ID, 'type' )); ?>
            </span>
			<span
                class="flag <?php $type = strip_tags(get_the_term_list( $post->ID, 'type' )); echo strtolower($type); ?>-bg">
            </span>
			<?php 
		  $newdataimage = get_the_post_thumbnail_url(get_the_ID(),'full');
		  if(get_option('statically_link')){
				$newdataimage = str_replace('https://', 'https://img.statically.io/img/kcast/', $newdataimage);
				$newdataimage = str_replace('.jpg', '.jpg?q=100', $newdataimage);
				$newdataimage = str_replace(".jpeg", ".jpeg?q=100".$qim, $newdataimage);
				$newdataimage = str_replace(".png", ".png?q=100".$qim, $newdataimage);
				$newdataimage = str_replace(".gif", ".gif?q=100".$qim, $newdataimage);
				$newdataimage = str_replace(".webp", ".webp?q=100".$qim, $newdataimage);
		  }
		  ?>
            <img src="<?php echo $newdataimage;?>"
                class="ts-post-image wp-post-image attachment-medium size-medium" loading="lazy" style="position: absolute;top: 0;height: 100%; width: 100%;" />
        </div>
        <div class="splide__slide-info">
            <div class="title" style="display:inline-block;width:calc(100%);white-space: nowrap;"><?php the_title();?></div>
            <div class="other">
                <?php
               $args = array(
        'update_post_meta_cache' => true,
               'post_type' => 'chapter',
               'posts_per_page' => '1', // How many items to display
               'post__not_in'   => array( get_the_ID() ), // Exclude current post
               'no_found_rows'  => true, // We don't ned pagination so this speeds up the query
               );
               $cats = wp_get_post_terms( get_the_ID(), 'category' ); 
               $cats_ids = array();  
               foreach( $cats as $wpex_related_cat ) {
               $cats_ids[] = $wpex_related_cat->term_id; 
               }
               if ( ! empty( $cats_ids ) ) {
               $args['category__in'] = $cats_ids;
               }
               $wpex_query = new wp_query( $args );
               foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>
                <div class="chapter" href="<?php the_permalink(); ?>">
                    Ch.<?php $meta = get_post_meta( get_the_ID(), 'smoker_chapter', true ); echo $meta; ?>
                </div>
                <?php
               endforeach;
               wp_reset_postdata(); ?>
                <div class="rate">
                    <div class="rating">
                        <div class="rating-bungkus">
                            <div class="rating-bungkus-bintang">
                                <div class="rating-bintang">
                                    <?php $rating = get_post_meta( get_the_ID(), 'smoke_rate', true ); if($rating==''){$rating = '?';} ?>
                                    <?php if($rating){ $ma = $rating; } else {$ma = '0.0';}; ?>
                                    <span style="width: <?php echo($ma * 10);?>%"></span>
                                </div>
                            </div>
                        </div>
                        <div class="numscore"><?php echo $rating; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>