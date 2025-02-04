<a href="#" class="scrollToTop"><span class="dashicons dashicons-arrow-up-alt2"></span></a>
</div>
</div>
</div>
<?php $kln = get_option('footerall');if($kln && !is_singular('chapter')){ echo '<div class="kln" style="padding-top:1rem;padding-bottom:1rem"><div class="lmt">'.$kln.'</div></div>'; } ?>
<div class="fm">
    <?php 
  $nav_menu = wp_nav_menu(array('theme_location'=>'bottom', 'container'=>'', 'link_before'=>'<span itemprop="name">','link_after'=>'</span>','fallback_cb' => '', 'echo' => 0)); 
    if(empty($nav_menu))
      $nav_menu = ' <ul id="menu-bottom" class="menu">'.wp_list_categories(array('show_option_all'=>__('Home', 'dp'), 'title_li'=>'', 'echo'=>0)).'</ul>';
    echo $nav_menu;
?>
   </div> 
   <div id="footer">
<footer id="colophon" class="site-footer" itemscope="itemscope" itemtype="//schema.org/WPFooter" role="contentinfo">
<div class="footercopyright">Semua komik di website ini hanya preview dari komik aslinya, mungkin terdapat banyak kesalahan bahasa, nama tokoh, dan alur cerita. Untuk versi aslinya, silahkan beli komiknya jika tersedia di kotamu.
</div>
	   
</footer>
</div>

<div id="Evo" style="overflow:hidden;background: #222;">
  <?php $floatingbawah = get_option('floatingbawah');
$floatingreader = get_option('floatingreader'); 
	 ?>
  <?php if($floatingbawah && !is_singular('chapter')){ ?>
<div id="teaser3" style="width: 100%;height:0;text-align: center;display: scroll;position:fixed;bottom: 100px;margin: 0 auto;z-index:9999">
<div align="center"><span id="close-teaser" onclick="document.getElementById('teaser3').style.display = 'none';" style="cursor:pointer;"><img src="//3.bp.blogspot.com/-wgV2RBU-PhQ/Uj-t8ybhmSI/AAAAAAAAFbM/GVhtnL_hY68/s1600/close.png"/></span></div>
<div class="blox">
<?php echo '<div class="kln"><div class="lmt">'.$floatingbawah.'</div></div>'; ?>
</div>
</div>
<?php  } ?>
	<?php if($floatingreader && is_singular('chapter')){ ?>
<div id="teaser4" style="width: 100%;height:0;text-align: center;display: unset;position:fixed;bottom: 100px;margin: 0 auto;z-index:9999">
<div align="center"><span id="close-teaser" onclick="document.getElementById('teaser4').style.display = 'none';" style="cursor:pointer;"><img src="//3.bp.blogspot.com/-wgV2RBU-PhQ/Uj-t8ybhmSI/AAAAAAAAFbM/GVhtnL_hY68/s1600/close.png"/></span></div>
<div class="blox">
<?php echo '<div class="kln"><div class="lmt">'.$floatingreader.'</div></div>'; ?>
</div>
</div>
<?php  } ?>
<center>

     <!-- Histats.com  (div with counter) --><div id="histats_counter"></div>
<!-- Histats.com  START  (aync)-->
<script type="text/javascript">var _Hasync= _Hasync|| [];
_Hasync.push(['Histats.start', '1,3653987,4,128,112,33,00000001']);
_Hasync.push(['Histats.fasi', '1']);
_Hasync.push(['Histats.track_hits', '']);
(function() {
var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
hs.src = ('//s10.histats.com/js15_as.js');
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
})();</script>
<noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?3653987&101" alt="" border="0"></a></noscript>
<!-- Histats.com  END  -->
</div>

	
<style>
	
	
    @media only screen and (max-width: 480px) {
			#teaser3 {
			bottom:170px !important;
		}
	}
	

	
	</style>	
<script type="text/javascript">if(localStorage.getItem('theme-mode') == 'darkmode') {
        document.querySelectorAll('.switch > input').forEach(function(el) {
          el.checked = true;
        });
      } else {
        document.querySelectorAll('.switch > input').forEach(function(el) {
          el.checked = false;
        });
      }
</script>
<script type="text/javascript">
  jQuery(function($) {
    $('#quickswitcher input').on('click', function(e) {
        if ($(this).is(':checked')) {
            $('body').addClass('darkmode');
            $('.switch input').each(function(item, key) {
                $(this).prop('checked', true);
            });
            localStorage.setItem('theme-mode', 'darkmode');
        } else {
            $('body').removeClass('darkmode');
            $('.switch input').each(function(item, key) {
                $(this).prop('checked', false);
            });
            localStorage.setItem('theme-mode', 'lightmode');
        }
    });
  });
	
	
	document.addEventListener('DOMContentLoaded', ()=>{
			var themeMode = localStorage.getItem('theme-mode');
		if(!themeMode){
			$('body').addClass('darkmode');
			$('.switch input').each(function(item, key) {
                $(this).prop('checked', true);
            });
			localStorage.setItem('theme-mode', 'darkmode');
		}
	})

  $('.score').each(function(index, el) {
	  var $El = $(el);
	  $El.barrating({
	    theme: 'fontawesome-stars',
	    readonly: true,
	    initialRating: $El.attr('data-current-rating') 
	  });
	});
</script>

	

<?php
wp_footer(); ?>
<script>
if(typeof Swiper !== 'undefined'){
	new Swiper(".swiper",{direction:"horizontal",loop:!1,slidesPerView:7,spaceBetween:10,breakpoints:{320:{slidesPerView:2,spaceBetween:20},480:{slidesPerView:3,spaceBetween:30},768:{slidesPerView:4,spaceBetween:40},1024:{slidesPerView:6,spaceBetween:16},1200:{slidesPerView:7,spaceBetween:16}}})
}
</script>
	
	<script>

	(function($){
		let discusInterval = setInterval(() => {
			$.each($('#disqus_thread iframe'), (arr,x) => {
				let src = $(x).attr('src');
				if (!src) {
					$(x).remove();
					clearInterval(discusInterval);
				}
			});
		}, 2000);
	})(jQuery);
	
</script>
</body>
</html>