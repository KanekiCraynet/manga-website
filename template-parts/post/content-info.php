<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
   <div class="mangainfo">
<div class="rih">
	<?php if( has_term( 'Ecchi', 'genre' ) ) { ?>
<div class="alr">Peringatan, seri berjudul "<?php the_title(); ?>" ini telah dikategorikan sebagai "Adult" kategori, yang di dalamnya mungkin terdapat konten kekerasan, berdarah, atau seksual yang tidak sesuai dengan pembaca di bawah umur.</div>
<?php } ?>
	<div class="montok"><h2><b>Perhatian:</b> Jika menemukan gambar rusak atau halaman chapter tidak dapat diakses, silakan melapor ke fanspage kami.</h2></div>
	<div class="mamang">
<div class="sintit"><i class="fa fa-book" aria-hidden="true"></i> Sinopsis</div>
<span class="desc"><?php the_content(); ?>
</span>
</div>
<div class="cl">
<div class="offzone"><span class="leftoff"><b><i class="fa fa-bookmark" aria-hidden="true"></i> <?php the_title(); ?> Chapter List</b></span></div>
<div class="bxcl">
<ul>
<?php list_chapter(); ?>
</ul>
</div>
</div>

</div>

</div>

    <?php endwhile; endif; ?>