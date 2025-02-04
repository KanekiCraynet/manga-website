<?php
   /*
   Template Name: Manga List
   */
  
   get_header(); 
	$kln = get_option('topdaftar');
    if ($kln) {
        echo '<br/><div class="kln"><div class="lmt">' . $kln . '</div></div>';
    }


?>
<div class="komiklist heading">
   <div class="komiklist_header">
      <h1>Daftar Manga</h1>
      <!-- Button untuk ubah mode gambar/text, gunakan if -->

      <button class="komiklist_mode"
         onclick="document.location='<?php if(isset($_GET['list'])){echo '?';}else{echo '?list';} ;?>'"><?php if(isset($_GET['list'])){
         echo 'Mode Gambar';
      }else{
         echo 'Mode Text';
      } ;?></button>
   </div>
   <div class="komiklist_overlay"></div>
   <!-- Filtering -->
   <div class="komiklist_filter">
      <form action="<?php the_permalink() ;?>;?>" class="komiklist_filter-form" method="GET">
         <?php if(isset($_GET['list'])){?>
         <input type="hidden" name="list">
         <?php } ;?>
         <div class="komiklist_filter-dropdown">
            <button type="button" class="komiklist_dropdown-toggle genre" data-toggle="dropdown">
               Genre
               <i class="fa fa-angle-down" aria-hidden="true"></i>
            </button>
            <!-- UL untuk item filter -->
            <ul class="komiklist_dropdown-menu c4 genrez">
               <?php 
            $taxonomy = 'genres';
            $tax_terms = get_terms($taxonomy, 'number=100&hide_empty=0');
   
            foreach ($tax_terms as $tax_term) {?>
               <li>
                  <input class="komiklist_filter-item" type="checkbox" id="genre-<?php echo($tax_term->slug);?>"
                     name="genre[]" value="<?php echo($tax_term->slug);?>" <?php 
                  if (isset($_GET['genre'])) {
                     if (in_array($tax_term->slug, $_GET['genre'], true)) {
                           echo 'checked';
                     }
                  }
                  ;?> />
                  <label for="genre-<?php echo($tax_term->slug);?>"> <?php echo($tax_term->name) ;?>
                  </label>
                  <?php 
            } 
            ;?>
               </li>

            </ul>

         </div>
         <div class="komiklist_filter-dropdown">
            <button type="button" class="komiklist_dropdown-toggle status" data-toggle="dropdown">
               Status
               <i class="fa fa-angle-down" aria-hidden="true"></i>
            </button>
            <ul class="komiklist_dropdown-menu status">
               <li>
                  <input class="komiklist_filter-item" type="radio" id="status-all" name="status" <?php 
               if (!isset($_GET['status'])) {
                  echo 'checked';
              }
      
              if (isset($_GET['status'])) {
                  if ($_GET['status'] === '') {
                      echo 'checked';
                  }
              } ;?> value="" />
                  <label for="status-all"> All
                  </label>
               </li>
               <li>
                  <input class="komiklist_filter-item" type="radio" id="status-Ongoing" name="status" <?php 
               if (isset($_GET['status'])) {
                  if ($_GET['status'] === 'Ongoing') {
                      echo 'checked';
                  }
              } ;?> value="Ongoing" />
                  <label for="status-Ongoing"> Ongoing
                  </label>
               </li>
               <li>
                  <input class="komiklist_filter-item" type="radio" id="status-Completed" name="status" <?php 
               if (isset($_GET['status'])) {
                  if ($_GET['status'] === 'Completed') {
                      echo 'checked';
                  }
              } ;?> value="Completed" />
                  <label for="status-Completed"> Completed
                  </label>
               </li>
            </ul>
         </div>
         <div class="komiklist_filter-dropdown">
            <button type="button" class="komiklist_dropdown-toggle type" data-toggle="dropdown">
               type
               <i class="fa fa-angle-down" aria-hidden="true"></i>
            </button>
            <ul class="komiklist_dropdown-menu type">
               <li>
                  <input class="komiklist_filter-item" type="radio" id="type-all" name="type" value="" <?php 
               if (!isset($_GET['type']) || $_GET['type'] === '') {
                  echo 'checked';
              } ;?> />
                  <label for="type-all"> All
                  </label>
               </li>
               <li>
                  <input class="komiklist_filter-item" type="radio" id="type-manga" name="type" <?php 
               if (isset($_GET['type']) && $_GET['type'] === 'manga') {
                  echo 'checked';
              } ;?> value="manga" />
                  <label for="type-manga"> Manga
                  </label>
               </li>
               <li>
                  <input class="komiklist_filter-item" type="radio" id="type-manhwa" name="type" <?php 
                  if (isset($_GET['type']) && $_GET['type'] === 'manhwa') {
                      echo 'checked';
                  }
               ;?> value="manhwa" />
                  <label for="type-manhwa"> Manhwa
                  </label>
               </li>
               <li>
                  <input class="komiklist_filter-item" type="radio" id="type-manhua" name="type" <?php 
                  if (isset($_GET['type']) && $_GET['type'] === 'manhua') {
                      echo 'checked';
                  }
               ;?> value="manhua" />
                  <label for="type-manhua"> Manhua
                  </label>
               </li>
            </ul>
         </div>
         <div class="komiklist_filter-dropdown">
            <button type="button" class="komiklist_dropdown-toggle sort_by" data-toggle="dropdown">
               Sort By
               <i class="fa fa-angle-down" aria-hidden="true"></i>
            </button>
            <ul class="komiklist_dropdown-menu sort_by">
               <li>
                  <input class="komiklist_filter-item" type="radio" id="sort_by-title" name="orderby" <?php
                  if(!isset($_GET['orderby']) || $_GET['orderby'] === '' || $_GET['orderby'] === 'titleasc'){
                     echo 'checked';
                  } ;?> value="titleasc" />
                  <label for="sort_by-title"> A-Z
                  </label>
               </li>
               <li>
                  <input class="komiklist_filter-item" type="radio" id="sort_by-titlereverse" name="orderby" <?php 
               if(isset($_GET['orderby']) && $_GET['orderby'] === 'titledesc') {
                  echo 'checked';
              };?> value="titledesc" />
                  <label for="sort_by-titlereverse"> Z-A
                  </label>
               </li>
               <li>
                  <input class="komiklist_filter-item" type="radio" id="sort_by-update" name="orderby" <?php 
               if (isset($_GET['orderby'])&&$_GET['orderby'] === 'update') {
                      echo 'checked';
              } ;?> value="update" />
                  <label for="sort_by-update"> update
                  </label>
               </li>
               <li>
                  <input class="komiklist_filter-item" type="radio" id="sort_by-popular" name="orderby" <?php 
               if (isset($_GET['orderby']) && $_GET['orderby'] === 'popular') {
                      echo 'checked';
              } ;?> value="popular" />
                  <label for="sort_by-popular"> Popular
                  </label>
               </li>
            </ul>
         </div>
         <div class="komiklist_filter-submit">
            <button type="submit" class="btn btn-custom-search">
               <i class="fa fa-search" aria-hidden="true"></i> Cari
            </button>
         </div>
      </form>
      <div class="list-update">
         <div class="<?php if(isset($_GET['list'])){echo 'text-mode';}else{echo 'list-update_items';} ;?>">
            <?php 
            if(!isset($_GET['list'])){
               $paged = (get_query_var('paged') ? get_query_var('paged') : 1);
               $orderby = '';
               $order = '';
               $meta_query = [];
               $tax_query = [];
               $genres = [];
               $type = '';
               $status ='';
               $meta_key = '';

               if(isset($_GET['genre']) && $_GET['genre'] !== ''){
                  $genres = ['taxonomy' => 'genres', 'field' => 'slug', 'terms' => $_GET['genre'], 'operator' => 'AND'];
                  array_push($tax_query, $genres);
               }
               if(isset($_GET['type']) && $_GET['type'] !== ''){
                  $type = ['taxonomy' => 'type', 'field'=>'slug', 'terms' => $_GET['type']];
                  array_push($tax_query, $type);
               }
               if(isset($_GET['status']) && $_GET['status'] !== ''){
                  $status = ['key' => 'smoke_status', 'value' => $_GET['status'], 'compare' => '='];
                  array_push($meta_query, $status);
               }
               
               if(!isset($_GET['orderby'])){
                  $order = 'DESC';
                  $orderby = 'date';
               }else{
                  switch ($_GET['orderby']) {
                     case 'popular':
                        $meta_key = 'wpb_post_views_count';
                        $orderby = 'meta_value_num';
                        $order = 'DESC';

                        break;
                     case 'titledesc':
                        $orderby = 'title';
                        $order = 'DESC';
                        break;
                     case 'update':
                        $orderby = 'meta_value';
                        array_push($meta_query, [
                           'relation'=> 'AND',
                           ['key' => 'manga_order_id','compare' => 'EXIST']
                        ]);
                        break;
                     default:
                        $orderby = 'title';
                        $order = 'ASC';
                        break;
                  };
               }


               
               $query = [
                  'post_type'          => 'komik',
                  'posts_per_page'     => 28,
                  'ignore_sticky_posts'=> 1,
                  'orderby'            => $orderby,
                  'order'              => $order,
                  'tax_query'          => $tax_query,
                  'meta_query'         => $meta_query,
                  'paged'              => $paged,
                  'meta_key'           => $meta_key
               ];

               query_posts($query);?>
               <div class="list-update_items-wrapper">
                  <?php
                  while(have_posts()):the_post();
                     get_template_part('template-parts/post/archive');
                  endwhile;?>
               </div>
               <div class="pagination"><?php echo paginate_links() ;?></div>
               <?php
               wp_reset_query();
            }else{
               
               $query = [
                  'post_type'          => 'komik',
                  'posts_per_page'     => -1,
                  'ignore_sticky_posts'=> 1,
                  'orderby'            => 'title',
                  'order'              => 'ASC',
               ];
               query_posts($query);?>
               <div class="text-mode_alphabet">
                  <?php
                     foreach (range('a', 'z') as $letter) {?>
                        <a href="#<?php echo strtoupper($letter);?>"><?php echo strtoupper($letter); ;?></a>
                     <?php 
                     }?>
               </div>
               <?php
                  $first_letter = '';
                  while(have_posts()){
                     the_post();
                     $seriesname = get_the_title();
                     $first_lettercur = $seriesname[0];

                     if (is_numeric($first_lettercur)) {
                        $first_lettercur = '#';
                     }
                     if($first_lettercur === $first_letter){?>
                        <li><a class="text-mode_list-item" href="<?php the_permalink() ;?>"
                              rel="<?php the_ID() ;?>"><?php the_title() ;?></a>
                           <?php $meta = get_post_meta( get_the_ID(), 'smoke_status', true );  if($meta=='Completed'){;?>
                           <b class="stat Completed">Completed</b>
                           <?php } ;?>
                        </li>
                  <?php
                  }else{
                     echo '</ul></div><div class="text-mode_list-items"><span><a name="' . $first_lettercur . '">' . $first_lettercur . '</a></span><ul>';
                    echo "\t" . '<li><a class="series" rel="';
                    the_ID();
                    echo '" href="';
                    the_permalink();
                    echo '">';
                    the_title(); ?>
                     </a>
                     <?php $meta = get_post_meta( get_the_ID(), 'smoke_status', true );  if($meta=='Completed'){ ?> <b
                        class="stat Completed">Completed</b><?php } ?>
                     </li>
                  <?php
                        }
                        $first_letter = $first_lettercur;
                     }
               wp_reset_query();
            }
            ?>

         </div>
      </div>
   </div>
<?php get_footer(); ?>