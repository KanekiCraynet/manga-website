<article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
   <meta content="<?php the_ID(); ?>" itemprop="postId"/>
   <tr>
      <th></th>
      <td class="shr">
         <div class="fb-save" data-uri="<?php the_permalink(); ?>" data-size="small"></div>
         <div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
      </td>
   </tr>

    <div class="white">
   <?php echo get_post_meta($post->ID, "post", true); ?>
   <?php wpb_set_post_views(get_the_ID()); wpb_get_post_views(get_the_ID()); $sx = get_post_meta( get_the_ID(), 'dev_seri', true ); ?>
   <div class="headpost">
      <h1 itemprop="name"><?php the_title(); ?></h1>
     
   </div>
 <div class="abuabu"> <div class="allc">

  <?php if ( function_exists('yoast_breadcrumb') ) 
{yoast_breadcrumb('<p id="breadcrumbs">','</p>');} else { ?> Semua chapter ada di <a href="<?php $meta = get_post_meta( get_the_ID(), 'dev_seri', true ); echo get_the_permalink($meta); ?>"><?php echo get_the_title($meta); ?></a><?php } ?></div></div>
   <div class="maincontent" itemprop="mainContentOfPage">
      <div style="margin-bottom: 10px;font-size: 14px;text-align: justify;">
         Selamat membaca manga <b><?php $meta = get_post_meta( get_the_ID(), 'dev_seri', true ); echo get_the_title($meta); ?> Chapter <?php $meta = get_post_meta( get_the_ID(), 'dev_chapter', true ); echo $meta; ?></b> bahasa indonesia, jangan lupa mengklik tombol like dan share ya. Manga <b><?php $meta = get_post_meta( get_the_ID(), 'dev_seri', true );echo get_the_title($meta); ?></b> bahasa Indonesia selalu update di <b><?php bloginfo('name'); ?></b>. Jangan lupa membaca update manga lainnya ya. Daftar koleksi manga <b><?php bloginfo('name'); ?></b> ada di menu Manga List.
      </div>
    </div>
      </div>
      <div class="navig">
    <div class="nextprev"><?php previous_post_link( '%link', '« Previous Chapter', TRUE ); ?>  <select name="episode" id="slch" onchange="window.open(this.options[this.selectedIndex].value,'_self')" text="Search Here&hellip;">
            <option value="">Select Chapter Manga</option>
            <?php
               $args = array(
                           'update_post_meta_cache' => true,
                   'post_type' => post,
                   'posts_per_page' => 1000, // How many items to display
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
            <option value="<?php the_permalink(); ?>">Chapter <?php $meta = get_post_meta( get_the_ID(), 'dev_chapter', true ); echo $meta; ?><?php $meta = get_post_meta( get_the_ID(), 'dev_title', true ); echo $meta; ?></option>
            <?php endforeach; wp_reset_postdata(); ?>
         </select><?php next_post_link( '%link', 'Next Chapter »', TRUE ); ?></div>
      </div>

    <div class="white">
      <div id="readerarea">
         <?php the_content(); ?>
      </div>
    </div>

        <div class="navig">
    <div class="nextprev"><?php previous_post_link( '%link', '« Previous Chapter', TRUE ); ?>  <select name="episode" id="slch" onchange="window.open(this.options[this.selectedIndex].value,'_self')" text="Search Here&hellip;">
            <option value="">Select Chapter Manga</option>
            <?php
               $args = array(
                   'post_type' => post,
                   'posts_per_page' => 1000, // How many items to display
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
            <option value="<?php the_permalink(); ?>">Chapter <?php $meta = get_post_meta( get_the_ID(), 'dev_chapter', true ); echo $meta; ?><?php $meta = get_post_meta( get_the_ID(), 'dev_title', true ); echo $meta; ?></option>
            <?php endforeach; wp_reset_postdata(); ?>
         </select><?php next_post_link( '%link', 'Next Chapter »', TRUE ); ?></div>
      </div>
      
<div id="perapih" class="atasan"><div id="hot">
    <h2>Sinopsis <?php the_title(); ?></h2> </div>
    <div id="hot">
    <div class="infosleft">
      <div class="h" style="width:100%;max-width:100%">
        <?php $meta = get_post_meta( get_the_ID(), 'dev_seri', true ); $post = get_post($meta); setup_postdata($post); ?>
        </div>
<div class="imgsinfosleft">
        <?php the_thumbnail(); ?>
      </div>
        <div class="sinsopss">
<?php the_excerpt(); ?> Selengkapnya: <a title="Manga <?php the_title(); ?>" href="<?php the_permalink(); ?>"><b>Manga <?php the_title(); ?></b></a>
</div>
<?php wp_reset_postdata(); ?>
    </div>
    
      <?php $meta = get_post_meta( get_the_ID(), 'dev_seri', true ); $post = get_post($meta); setup_postdata($post); ?>
    <div class="infosright">
    <div class="bigcontent chapter">
               <div class="infox">
              
            <span class="alter"><?php meta(get_the_ID(),'dev_japanese'); ?> </span>           <div class="spe">
    <span><b>English:</b> <?php meta(get_the_ID(),'dev_english'); ?></span>   
               <span><b>Status:</b> <?php meta(get_the_ID(),'dev_status'); ?></span>        
                     <span><b>Author:</b> <?php meta(get_the_ID(),'dev_author'); ?></span>          
               <span><b>Genres:</b> <?php term(get_the_ID(),'genre'); ?></span>    
                          <span><b>Chapter:</b> <?php meta(get_the_ID(),'dev_chapter'); ?></span>             
                           <span class="split"><b>Released:</b>  <?php meta(get_the_ID(),'published'); ?></span>           
               <span><b>Type:</b> <?php meta(get_the_ID(),'dev_type'); ?></span>       
                    <?php $meta = get_post_meta( get_the_ID(), 'dev_serialization', true ); if($meta){ ?><span><b>Serialization:</b> <?php echo $meta; ?></span><?php } ?>
                    <?php $meta = get_post_meta( get_the_ID(), 'dev_scanlation', true ); if($meta){ ?><span><b>Scanlation:</b> <?php echo $meta; ?></span><?php } ?>     
                                 
                                  <span itemprop="author" itemscope itemtype="https://schema.org/Person" class="author vcard"><b>Posted by:</b> <i itemprop="name"><?php the_author_meta(get_the_ID(),'display_name', 1); ?></i></span>
          <span class="split"><b>Posted on:</b> <time itemprop="datePublished" datetime="<?php the_time('c'); ?>"><?php the_time('F j, Y'); ?></time></span>
        <span class="split"><b>Updated on:</b> <time itemprop="dateModified" datetime="<?php the_modified_date('c'); ?>"><?php the_modified_date('F j, Y'); ?></time></span>
            </div>
               </div>
               <div class="rt">
                 <div class="rating">
          <strong>Rating <?php meta(get_the_ID(),'dev_score'); ?> </strong>
                      <div class="rtg">
          <?php $rating = get_post_meta( get_the_ID(), 'dev_score', true ); $display = number_format_i18n( $rating, 1 );
            echo '<div class="bar"><span style="width:'.($display*10).'%"></span></div>'; ?>        </div>
        </div>
               </div>
            </div>
    </div>
    <?php wp_reset_postdata(); ?>
  </div>


      </div>

<div class="relatedmanga">
<?php
   $myposts = array(
       'showposts' => 6,
       'post_type' => 'manga',
       'orderby' => 'rand',
   );
   $wp_query= null;
   $wp_query = new WP_Query();
   $wp_query->query($myposts);
   ?>
<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?> 

      <div class="newslist">
        <div class="newslist2">
            
          <div class="newsgambar">            <div class="hotmanga merah">
            <i class="fab fa-hotjar"></i>
          </div>
                    <a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>"><?php the_thumbnail(); ?></a></div>
          
            
          <div class="newsinfo">
              <div class="kategori">
            <i> <?php term(get_the_ID(),'genre'); ?></i> 
            </div>
            <h4 class="newsjudul">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
          </h4>
          <div class="newschapter">
           <?php latestchapter(get_the_ID(),1,1); ?>
          </div>
        </div>
        </div>
        </div>

<?php endwhile; ?>

</div>
   </div>
   <div class="commentarea">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php echo get_post_meta($post->ID, "chapter", true); ?>
      <?php comments_template(); ?>
      <?php endwhile; endif; ?>
   </div>
</article>