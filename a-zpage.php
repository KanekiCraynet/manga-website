<?php
/*
   Template Name: A-Z List
*/
get_header(); ?>

<div class="postbody komikinfo">
<div class="bixbox">

<div class="releases"><h1><span><?php the_title(); ?></span></h1></div>
<div class="page">
     <?php echo do_shortcode('[az]'); ?>
</div>
</div>
</div>

<?php get_footer(); ?>