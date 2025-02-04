<div class="notif">
	<div class="center">
	<div class="data_announ"><?php $taxonomy = 'genre';
$tax_terms = get_terms($taxonomy,'number=7'); ?>
<ul class="genre_top">   <?php
foreach ($tax_terms as $tax_term) {
echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all seri in genre %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
}
?>       </ul></div>
</div>
</div>