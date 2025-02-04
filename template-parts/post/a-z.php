<div class="bx">
	<div class="imgx">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
	</div>
	<div class="inx">
		<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<span>
			<?php the_excerpt(); ?>
		</span>
	</div>
</div>