<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <title><?php wp_title( '–', true, 'right' ); ?></title>
	 <title>Komikcast</title>
  <meta name="description"
    content="Komikcast - Tempatnya Baca Komik Online Terlengkap Bahasa Indonesia, Baca Manga Bahasa Indonesia, Baca Online One Piece Bahasa Indonesia, Baca Komik Solo Leveling Bahasa Indonesia, Baca Komik Apotheois Bahasa Indonesia">
  <meta name="keywords"
    content="Komikcast, Komikcast me, Komiku, Baca online One Piece, Baca Online Solo Leveling, Baca Online Apotheois, Baca Online Star Martial God Technique, Baca Komik lengkap, Baca Manga, Baca Manhua, Baca Manhwa">
  <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/js/owl.carousel.css' type='text/css'
    media='all' />
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.barrating.min.js"></script>
  <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/style_v1.min.css' type='text/css'
    media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/darkmode.min.css' type='text/css'
    media='all' />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/css/tooltip.css';?>">
<?php   
$homeonly = get_option('homepopup');
  $allpages = get_option('allpagepopup');
  $excludes = get_option('excludehomepopup');
	
  if($homeonly && is_home()){
	      echo $homeonly;
  }
  if($allpages){
    echo $allpages;

  }
  if($excludes && !is_home()){
    echo $excludes;

  }
?>
 

<!-- End Meta Pixel Code -->
<?php 
if(is_home()){?>
<link rel="stylesheet" href="https://unpkg.com/swiper@7.4.1/swiper-bundle.min.css"/>
<script src="https://unpkg.com/swiper@7.4.1/swiper-bundle.min.js"></script>
<?php }
?>
<script>
  const tooltipUrl = "<?php echo get_stylesheet_directory_uri() . '/tooltip.php';?>"
  const loaderImg = "<?php echo get_stylesheet_directory_uri() . '/images/loader.gif';?>"
</script>
<style>
  .darkmode .splide__slide-image:hover > .splide__slide-overlay{
    display: block;
    background-color: rgba(0,0,0,.50);
  }
  .splide__slide-image:hover > .splide__slide-overlay{
    display: block;
    background-color: rgba(0,0,0,.50);
  }

</style>

  <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/owl.carousel.js'></script>
  <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php wp_head(); ?>
</head>
<script type="text/javascript">
  $( document ).ready( function () {
    $( ".shme" ).click( function () {
      $( ".mm" ).toggleClass( "shwx" );
    } );
    $( ".expand" ).click( function () {
      $( ".megavid" ).toggleClass( "xp" );
      $( ".pd-expand" ).toggleClass( "sxp" );
    } );
    $( ".gnr" ).click( function () {
      $( ".gnrx" ).toggleClass( "shwgx" );
    } );
    $( ".filter" ).click( function () {
      $( ".advancedsearch" ).toggleClass( "advs" );
    } );

  } );
</script>

<?php if ( is_home() ) {
  ?>

<?php } ?>
<script type="text/javascript">
  $( document ).ready( function () {

    //Check to see if the window is top if not then display button
    $( window ).scroll( function () {
      if ( $( this ).scrollTop() > 100 ) {
        $( '.scrollToTop' ).fadeIn();
      } else {
        $( '.scrollToTop' ).fadeOut();
      }
    } );

    //Click event to scroll to top
    $( '.scrollToTop' ).click( function () {
      $( 'html, body' ).animate( {
        scrollTop: 0
      }, 800 );
      return false;
    } );

  } );
</script>
<script>
  var max_bookmark = 30;
</script>


<body
  class="home page-template page-template-home page-template-home-php page-id-5 js darkmode"
  itemscope="itemscope" itemtype="http://schema.org/WebPage">
  <?php get_template_part( 'template-parts/navigation/menu', 'top' ); ?>
  
 
  <?php
if ( wp_is_mobile() ) { ?>
  
  <?php } ?>
  <?php $kln = get_option('intertitialads');if($kln){ echo $kln; } ?>

  <div id="content">
    <div class="wrapper">
		<?php $kln = get_option('tophome');if($kln && is_home()){ echo '<div class="kln"><div class="lmt">'.$kln.'</div></div>'; } ?>