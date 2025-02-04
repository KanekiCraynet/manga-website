<?php get_header(); ?>
   <div class="postbody komikinfo">
      <div class="dev">
         <main id="main" class="site-main" role="main">
             <div class="list-update search">
                  <div class="list-update-search-header">
                     <h1>
                        <span>Search "<?php echo get_search_query(); ?>"</span>
                     </h1>
                  </div>
                  <div class="list-update_items">
                     <div class="list-update_items-wrapper search-item">
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                           <?php get_template_part('template-parts/post/archive'); ?>
                        <?php endwhile; ?>
                     </div>
                     <div class="pagination">
                     <?php echo paginate_links(); ?>
                     </div>
                  </div>
            </div>
         </main>
    <?php else : ?>
   <?php endif; ?>
      </div>

   </div>

  

<?php get_footer(); ?>