<?php get_header(); ?>

<div class="postbody komikinfo">
<div class="bixbox">
<?php if (have_posts()) : ?>
<div class="releases"><h1><span><?php the_title(); ?></span></h1></div>
<div class="page">
<?php while ( have_posts() ) : the_post(); the_content(); endwhile; endif; ?>
</div>
</div>
</div>
<?php get_footer(); ?>