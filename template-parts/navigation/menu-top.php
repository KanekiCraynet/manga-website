<div class="th">
    <div id="header-komik" class="centernav bound header">
        <div class="shme"><span class="dashicons dashicons-menu"></span></div>
        <header role="banner" itemscope itemtype="http://schema.org/WPHeader">
            <div itemscope="itemscope" itemtype="http://schema.org/Brand" class="site-branding logox">
                <?php $logo = get_option('logo');if ($logo) {if (is_home()) {?>
                <h1 class="logos">
                    <a title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?> - <?php echo esc_attr(get_bloginfo('description', 'display')); ?>"
                        itemprop="url" href="<?php echo esc_url(home_url('/')); ?>"><img itemprop="logo"
                            src="<?php echo $logo; ?>"
                            alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?> - <?php echo esc_attr(get_bloginfo('description', 'display')); ?>"><span
                            class="hdl"><?php echo esc_attr(get_bloginfo('name', 'display')); ?> -
                            <?php echo esc_attr(get_bloginfo('description', 'display')); ?></span></a>
                </h1>
                <?php } else {?>
                <span class="logos">
                    <a title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?> - <?php echo esc_attr(get_bloginfo('description', 'display')); ?>"
                        itemprop="url" href="<?php echo esc_url(home_url('/')); ?>"><img itemprop="logo"
                            src="<?php echo $logo; ?>"
                            alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?> - <?php echo esc_attr(get_bloginfo('description', 'display')); ?>"><span
                            class="hdl"><?php echo esc_attr(get_bloginfo('name', 'display')); ?> -
                            <?php echo esc_attr(get_bloginfo('description', 'display')); ?></span></a>
                </span>
                <?php }}?>
                <meta itemprop="name"
                    content="<?php echo esc_attr(get_bloginfo('name', 'display')); ?> - <?php echo esc_attr(get_bloginfo('description', 'display')); ?>" />
            </div>
        </header>
        <div class="searchx">
            <form action="<?php bloginfo('url');?>/" id="form" method="get" itemprop="potentialAction" itemscope
                itemtype="http://schema.org/SearchAction">
                <meta itemprop="target" content="<?php bloginfo('url');?>/?s={query}" />
                <input id="s" itemprop="query-input" class="search-live" type="text" placeholder="Search..." name="s"
                    autocomplete="off" />
                <button type="submit" id="submit" class="submit-search-input"><span
                        class="dashicons dashicons-search"></span></button>
            </form>
            <div id="search-ajax-result-wrapper" class="hidden">
                <ul id="search-ajax-result"></ul>
            </div>
        </div>
        <?php if (is_singular('chapter')) {?>
        <?php } else {?>
        <div id="quickswitcher"> <span class="text">Light/Dark</span> <label class="switch"><input type="checkbox">
                <span class="slider round"></span></label></div>
        <?php }?>
    </div>
</div>
<nav id="main-menu"
    class="mm <?php if (is_user_logged_in() && current_user_can('manage_options')) {echo 'admin_bar_active';}
;?>">
    <div class="centernav">
        <div class="bound">

            <span itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" role="navigation">
                <?php
$nav_menu = wp_nav_menu(array('theme_location' => 'main', 'container' => '', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>', 'fallback_cb' => '', 'echo' => 0));
if (empty($nav_menu)) {
    $nav_menu = '<ul>' . wp_list_categories(array('show_option_all' => __('Home', 'dp'), 'title_li' => '', 'echo' => 0)) . '</ul>';
}

echo $nav_menu;
?>
            </span>
            <?php if (!is_user_logged_in()): ?>
            <a class="login-link" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement"
                role="navigation" title="masuk" href="<?php echo get_page_url('loginpages') ?>">Login/Register</a>
            <?php else: ?>
            <div class="user-navigation login-link">
                <img src="data:image/png;base64,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"
                    class="user-navigation-avatar">
                <div class="user-navigation-menu">
                    <ul>
                        <li>
                            <a itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement"
                                role="navigation" href="<?php echo get_page_url('usersetting'); ?>">Account Setting</a>
                        </li>
                        <li>
                            <a itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement"
                                role="navigation" href="<?php echo esc_url(wp_logout_url(home_url())); ?>">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
</nav>