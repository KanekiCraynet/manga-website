<?php

  function chapter_save_post($id)
    {
        $seriesx = get_post_meta($id, 'dev_seri', true);
        $chapterx = get_post_meta($id, 'dev_chapter', true);
        $statusx = get_post_status($id);
        if ($seriesx && ($statusx === 'publish')) {
            $chapx = array('ID' => $seriesx);
            wp_update_post($chapx);
        }
    }


 function az_sc($atts)
    {
        echo "\t" . '<div class="lista"> <a href="?show=A">A</a> <a href="?show=B">B</a> <a href="?show=C">C</a> <a href="?show=D">D</a> <a href="?show=E">E</a> <a href="?show=F">F</a> <a href="?show=G">G</a> <a href="?show=H">H</a> <a href="?show=I">I</a> <a href="?show=J">J</a> <a href="?show=K">K</a> <a href="?show=L">L</a> <a href="?show=M">M</a> <a href="?show=N">N</a> <a href="?show=O">O</a> <a href="?show=P">P</a> <a href="?show=Q">Q</a> <a href="?show=R">R</a> <a href="?show=S">S</a> <a href="?show=T">T</a> <a href="?show=U">U</a> <a href="?show=V">V</a> <a href="?show=W">W</a> <a href="?show=X">X</a> <a href="?show=Y">Y</a> <a href="?show=Z">Z</a><div class="clear"></div></div>' . "\n\t" . '<div class=\'listo\'>' . "\n\t";
        global $wpdb;

        if (isset($_GET['show'])) {
            $first_char = $_GET['show'];
        }
        else {
            $first_char = 'A';
        }

        $postids = $wpdb->get_col($wpdb->prepare("\n\t" . 'SELECT      ID' . "\n\t" . 'FROM        ' . $wpdb->posts . "\n\t" . 'WHERE       SUBSTR(' . $wpdb->posts . '.post_title,1,1) = %s' . "\n\t" . 'ORDER BY    ' . $wpdb->posts . '.post_title', $first_char));

        if ($postids) {
            $paged = (get_query_var('paged') ? get_query_var('paged') : 1);
            $args = array('post__in' => $postids, 'post_type' => 'komik', 'post_status' => 'publish', 'orderby' => 'title','showposts' => '1', 'order' => 'ASC', 'ignore_sticky_posts' => 1, 'paged' => $paged);
            query_posts($args);

            while (have_posts()) {
                the_post();
              get_template_part('template-parts/post/a-z');
            }
        }

        echo "\t" . '</div>' . "\n\t" . '<div class="pagination">' . "\n\t\t";
        echo paginate_links();
        echo '  ' . "\n\t" . '</div>' . "\n\t";
        wp_reset_query();
    }

    add_shortcode('az', 'az_sc');

function list_chapter($ID){ ?>
<?php
$dev_chap = new WP_Query(array(
'showposts' => '1000',
'post_type' =>  array('chapter'),
'orderby' => 'date',
'meta_key' => 'smoker_chapter',
'meta_key' => 'smoke_series',
'meta_value' => $ID
));
while ($dev_chap->have_posts()):
$dev_chap->the_post(); ?>
 <li>
        <span class="lchx desktop"><a href="<?php the_permalink(); ?>" target="_top">Chapter <?php meta(get_the_ID(),'smoker_chapter'); ?></a></span>


        <span class="dt"><a href="<?php the_permalink(); ?>" target="_top"> Read</a></span>
               <?php $meta = get_post_meta( get_the_ID(), 'dev_download', true );  if($meta){ ?>    <span class="dt"><a href="<?php echo $meta; ?>" target="_top"><i class="dashicons dashicons-download"></i> Download</a></span><?php } ?>
                <span class="dt"><a href="https://dlkomik.net/?dl=<?php 
      $li = get_the_permalink();
      $link = get_option('linkdownload');

if ($link){
    $links = $link;
} else {
    $links = 'pdf';
} echo $links; ?>&id=<?php the_ID(); ?>&link=<?php echo parse_url($li, PHP_URL_PATH); ?>" target="_top"><i class="dashicons dashicons-download"></i> Download PDF</a></span>
    </li>
<?php endwhile;
} 

function theme_footer()
    { ?>
</div>
<div id="footer">
<div class="container footer">
<div class="footer-left">
  <div class="logo-footer">
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>" rel="home">
    <?php $logo = get_option('logo'); ?>
<img src="<?php echo $logo; ?>" title="<?php bloginfo('name'); ?>" rel="home" />
</a>
</div>
<span class="bloginfofoter"><h1><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></h1></span>
<span class="descfooter"><div class="descfoter"><?php  $desc = get_option('descfooter'); echo $desc; ?></div></span>
</div>
<div class="footer-right">
       <div class="footermenu">
         <div class="menu-footer-container">
             <?php 
  $nav_menu = wp_nav_menu(array('theme_location'=>'bottom', 'container'=>'', 'fallback_cb' => '', 'echo' => 0)); 

    if(empty($nav_menu))
      $nav_menu = '<ul><li>'.wp_list_categories(array('show_option_all'=>__('Home', 'dp'), 'title_li'=>'', 'echo'=>0)).'</li></ul>';
    echo $nav_menu;
?>
         </div>
      </div>
    
<div class="scm">
    <?php  $kln = get_option('facebook');if($kln){ ?>
<a href="<?php echo $kln; ?>" class="fb" title="Follow us on Facebook"><span class="fa fa-facebook-square"></span></a>
<?php } ?>
<?php  $kln = get_option('twitter');if($kln){ ?>
<a href="<?php echo $kln; ?>" class="tw" title="Follow us on Twitter"><span class="fa fa-twitter"></span></a>
<?php } ?>
<?php  $kln = get_option('instagram');if($kln){ ?>
<a href="<?php echo $kln; ?>" class="int" title="Follow us on instagram"><span class="fa fa-instagram"></span></a>
<?php } ?>
</div>
<div class="footer-desc">
<p>Copyright © 2018 <?php bloginfo('title'); ?>
</p>
</div>
</div>
</div>

</div>
<?php
    }

            
         include 'widget.php';
    include 'meta.php';
    include 'panel.php';
    include 'taxonomy.php';
      include 'ads.php';
    
      function meta_mal_api() {
  add_meta_box( 'meta_mal_api', __( 'Generate data from MyAnimeList', 'meta_mal' ), 'meta_mal_modal', 'komik', 'advanced', 'high' );
}

function meta_mal_modal() {
?>
<div class="rwmb-meta-box">
  <div class="rwmb-field rwmb-text-wrapper">
    <div class="rwmb-input ui-shortable">
      <div class="rwmb-clone rwmb-text-clone">
        <input size="30" type="text" id="meta_mal_api_input" class="rwmb-text " name="meta_mal_api_input"/>
      <a class="button-primary" id="meta_mal_api_button">Generate</a>
    </div>
    Example (https://myanimelist.net/manga/81117/Tokyo_Ghoul_re) = <b>81117</b>
    </div>
  </div>
</div>
<?php
}
add_action( 'add_meta_boxes', 'meta_mal_api' );
