<nav id="main-menu" <?php echo ngeblog_itemtype_schema( 'SiteNavigationElement' ); ?>>
	<div class="center">
<label for="show-menu" class="show-menu"><span><?php bloginfo('name'); ?></span><i class="dashicons dashicons-menu"></i></label>
<input type="checkbox" id="show-menu" role="button">
<?php 
	$nav_menu = wp_nav_menu(array('theme_location'=>'main', 'container'=>'', 'fallback_cb' => '', 'echo' => 0)); 
		if(empty($nav_menu))
			$nav_menu = '<ul>'.wp_list_categories(array('show_option_all'=>__('Home', 'dp'), 'title_li'=>'', 'echo'=>0)).'</ul>';
		echo $nav_menu;
?>
<div class="clear"></div>

	<form id="form" method="get" action="<?php bloginfo('url'); ?>">
<fieldset>
<input id="s" type="text" placeholder="search here..." name="s">
<input type="hidden" name="post_type" value="post">
<button id="cari" type="submit"><i class="fa fa-search"></i></button>
</fieldset>
</form>
</div>
</nav>