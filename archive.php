<?php get_header(); ?>
<div class="postbody komikinfo">
<div class="bixbox">
  <?php if (have_posts()) : ?>
  <div class="releases"><h1><span><?php single_tag_title(); ?></span></h1></div>
  <div class="listupd list-update">
      <ul class="genresx">           
<?php
$taxonomy = 'genres';
$tax_terms = get_terms($taxonomy,'number=100&hide_empty=0');
foreach ($tax_terms as $tax_term) {
echo '<li><a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a> ('.$tax_term->count.')</li>';
}
?>
</ul>
    <p class="ctn"> Baca manga <?php single_tag_title(); ?>&nbsp; bahasa Indonesia, manga <?php single_tag_title(); ?>&nbsp; terbaik, komik manga <?php single_tag_title(); ?>&nbsp; terbaru, baca manga manhwa manhua terpopuler genre <?php single_tag_title(); ?>&nbsp; indo.</p>
		<div class="list-update_items">
			<div class="list-update_items-wrapper">
      <?php while ( have_posts() ) : the_post();    get_template_part('template-parts/post/archive');  endwhile; ?>
    </div>
			 <div class="pagination">
      <?php echo paginate_links(); ?>  
    </div>
		</div>
  </div>  
 
  <?php endif; ?>
</div>
</div>
<?php get_footer(); ?>