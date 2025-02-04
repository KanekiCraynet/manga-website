<?php

 function register_popularsidebar_widget() {
      register_widget( 'popularsidebar_widget' );
   }
   add_action( 'widgets_init', 'register_popularsidebar_widget' );
   
   class popularsidebar_widget extends WP_Widget {
   
   
   function __construct() {
      parent::__construct(
         'popularsidebar_widget', 
         esc_html__( 'Popular Manga [Sidebar]', 'text_domain' ), 
         array( 'description' => esc_html__( 'Popular Manga [Sidebar]', 'text_domain' ), ) 
      );
   }
   
   public function widget( $args, $instance ) {
      echo $args['before_widget'];
      if ( ! empty( $instance['title'] ) ) {
         echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
      }
      ?>
<div class='widget-post'>
     <div class="serieslist pop">
               <ul>
                   <?php  $counter = 1;
            $recent = new WP_Query('post_type=komik&showposts=' . $instance['count'] . '&meta_key=wpb_post_views_count&meta_type=NUMERIC&orderby=meta_value_num&order=DESC&no_found_rows=true&update_post_term_cache=false&update_post_meta_cache=false&cache_results=false');

            while ($recent->have_posts()) {
                $recent->the_post();
                $idx = get_the_ID();
                echo ' ' . "\n"; ?>
                <?php if ($counter == 1) { ?>
                  <li class="topone">
                     <div class="limit">
                        <div class="shadow"></div>
                        <div class="bw">
                           <div class="ctr"><?php echo $counter; ?></div>
                           <div class="imgseries"><a class="series data-tooltip" data-tooltip-id="<?php the_ID();?>" href="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>"><?php the_post_thumbnail(); ?></a></div>
                           <div class="leftseries">
                              <h2><a class="series data-tooltip" data-tooltip-id="<?php the_ID();?>" href="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>"><?php the_title(); ?></a></h2>
                              <span><b>Genres</b>:<?php term(get_the_ID(),'genres'); ?></span>
                                 <span><?php meta(get_the_ID(),'smoke_date'); ?></span>  
                           </div>
                        </div>
                     <?php the_post_thumbnail(); ?>
                     </div>
                  </li>
                    <?php } else { ?>
               <li> 
<div class="ctr"><?php echo $counter; ?></div>
<div class="imgseries"><a class="series data-tooltip" data-tooltip-id="<?php the_ID();?>" href="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>"><?php the_post_thumbnail(); ?></a></div>
<div class="leftseries"> 
 <h2><a class="series data-tooltip" data-tooltip-id="<?php the_ID();?>" href="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>"><?php the_title(); ?></a></h2> 
      <span><b>Genres</b>: <?php term(get_the_ID(),'genres'); ?></span> 
  <span><?php meta(get_the_ID(),'smoke_date'); ?></span>  
         </div> 
</li>
                    <?php } ?>
   <?php    ++$counter; } ?>
               </ul>
            </div>
</div>
</div>
<?php

   }
   
   public function form( $instance ) {
   $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
   $count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( '5', 'text_domain' );
   $orderby = ! empty( $instance['orderby'] ) ? $instance['orderby'] : esc_html__( 'Orderby', 'text_domain' );
   ?>
<p>
   <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
   <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
   <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_attr_e( 'Count:', 'text_domain' ); ?></label> 
   <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="number" value="<?php echo esc_attr( $count ); ?>">
   <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Orderby:' ); ?></label>
      <select name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_id( 'orderby' ); ?>" class="widefat">
      <option value="date"<?php selected( $instance['orderby'], 'date' ); ?>><?php _e( 'Date' ); ?></option>
      <option value="rand"<?php selected( $instance['orderby'], 'rand' ); ?>><?php _e( 'Rand' ); ?></option>
   </select>
</p>
<?php 
   }
   
   public function update( $new_instance, $old_instance ) {
      $instance = array();
      $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
      $instance['count'] = ( ! empty( $new_instance['count'] ) ) ? sanitize_text_field( $new_instance['count'] ) : '';
      $instance['orderby'] = ( ! empty( $new_instance['orderby'] ) ) ? sanitize_text_field( $new_instance['orderby'] ) : '';
   
      return $instance;
   }
   
   
   
   } 
 
   function register_popular_widget() {
      register_widget( 'popular_widget' );
   }
   add_action( 'widgets_init', 'register_popular_widget' );
   
   class popular_widget extends WP_Widget {
   
   
   function __construct() {
   	parent::__construct(
   		'popular_widget', 
   		esc_html__( 'Recent Manga', 'text_domain' ), 
   		array( 'description' => esc_html__( 'Recent Manga', 'text_domain' ), ) 
   	);
   }
   
   public function widget( $args, $instance ) {
   	echo $args['before_widget'];
   	if ( ! empty( $instance['title'] ) ) {
   		echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
   	}
   	?>
<div class='widget-post'>
     <div class="serieslist">
               <ul> <?php
    $args = $cat_args = array(
    'post_type' => 'komik',
    'posts_per_page' => $instance['count'],
    'orderby' => $instance['orderby'],

);
$cat_args['meta_query'] = array(
    'relation' => 'OR',
    array(
        'key'       => 'dev_type',
        'value'     => $instance['type'],
        'compare'   => 'LIKE',
    ),
 );
if ( get_posts( $cat_args ) ) {    // See if any category posts exist
    $query_args = $cat_args;
} else {                           // Otherwise, pass original $args
    $query_args = $args;
}

// Use the newly set $query_args
$wp_query = new WP_Query($query_args); while ($wp_query->have_posts()) : $wp_query->the_post(); ?>  
                         <li> 
<div class="imgseries"><a class="series" href="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>"><?php the_thumbnail(); ?></a></div>
<div class="leftseries"> 
 <h2><a class="series" href="<?php the_permalink(); ?>" rel="<?php the_ID(); ?>"><?php the_title(); ?></a></h2> 
      <span><b>Genres</b>: <?php term(get_the_ID(),'genres'); ?></span> 
      <span><?php meta(get_the_ID(),'smoke_date'); ?></span>  
         </div> 
</li>
         <?php endwhile; ?>
   <?php wp_reset_query(); ?>       
               </ul>
            </div>
</div>
</div>
<?php

   }
   
  public function form( $instance ) {
   $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
    $link = ! empty( $instance['link'] ) ? $instance['link'] : esc_html__( 'Link', 'text_domain' );
   $count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( '5', 'text_domain' );
   $type = ! empty( $instance['type'] ) ? $instance['type'] : esc_html__( 'TV', 'text_domain' );
   $orderby = ! empty( $instance['orderby'] ) ? $instance['orderby'] : esc_html__( 'Date', 'text_domain' );
   ?>
<p>
   <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
   <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">


   <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_attr_e( 'Count:', 'text_domain' ); ?></label> 
   <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="number" value="<?php echo esc_attr( $count ); ?>">
   <label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e( 'Type:' ); ?></label>
      <select name="<?php echo $this->get_field_name( 'type' ); ?>" id="<?php echo $this->get_field_id( 'type' ); ?>" class="widefat">
      <option value="all"<?php selected( $instance['type'], 'all' ); ?>><?php _e( 'All' ); ?></option>
      <option value="Manga"<?php selected( $instance['type'], 'Manga' ); ?>><?php _e( 'Manga' ); ?></option>
      <option value="Novel"<?php selected( $instance['type'], 'Novel' ); ?>><?php _e( 'Novel' ); ?></option>
      <option value="Manhwa"<?php selected( $instance['type'], 'Manhwa' ); ?>><?php _e( 'Manhwa' ); ?></option>
      <option value="Manhua"<?php selected( $instance['type'], 'Manhua' ); ?>><?php _e( 'Manhua' ); ?></option>
   </select>
<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Orderby:' ); ?></label>
      <select name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_id( 'orderby' ); ?>" class="widefat">
      <option value="date"<?php selected( $instance['orderby'], 'date' ); ?>><?php _e( 'Date' ); ?></option>
      <option value="rand"<?php selected( $instance['orderby'], 'rand' ); ?>><?php _e( 'Rand' ); ?></option>
   </select>
</p>
<?php 
   }
   
   public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
     $instance['link'] = ( ! empty( $new_instance['link'] ) ) ? sanitize_text_field( $new_instance['link'] ) : '';
    $instance['count'] = ( ! empty( $new_instance['count'] ) ) ? sanitize_text_field( $new_instance['count'] ) : '';
      $instance['type'] = ( ! empty( $new_instance['type'] ) ) ? sanitize_text_field( $new_instance['type'] ) : '';
      $instance['orderby'] = ( ! empty( $new_instance['orderby'] ) ) ? sanitize_text_field( $new_instance['orderby'] ) : '';
   
   	return $instance;
   }
   
   
   
   } 
   

   function register_genre_widget() {
      register_widget( 'genre_widget' );
   }
   add_action( 'widgets_init', 'register_genre_widget' );
   
   class genre_widget extends WP_Widget {
   
   
   function __construct() {
   	parent::__construct(
   		'genre_widget', 
   		esc_html__( 'Genre', 'text_domain' ), 
   		array( 'description' => esc_html__( 'Genre', 'text_domain' ), ) 
   	);
   }
   
   public function widget( $args, $instance ) {
   	echo $args['before_widget'];
   	if ( ! empty( $instance['title'] ) ) {
   		echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
   	}
   	$taxonomy = 'genres';
   $tax_terms = get_terms($taxonomy,'number=$total'); ?>
<ul class="genre">   <?php
   foreach ($tax_terms as $tax_term) {
   echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all seri in genre %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.' ('.$tax_term->count.')</a></li>';
   }
   ?>       </ul>
 </div>
<?php

   }
   
   public function form( $instance ) {
   $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
   ?>
<p>
   <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
   <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php 
   }
   
   public function update( $new_instance, $old_instance ) {
   	$instance = array();
   	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
   
   	return $instance;
   }
   
   
   
   } 
   

 function register_recentchapter_widget() {
      register_widget( 'recentchapter_widget' );
   }
   add_action( 'widgets_init', 'register_recentchapter_widget' );
   
   class recentchapter_widget extends WP_Widget {
   
   
   function __construct() {
      parent::__construct(
         'recentchapter_widget', 
         esc_html__( 'Recent Chapter [Sidebar]', 'text_domain' ), 
         array( 'description' => esc_html__( 'Recent Chapter [Sidebar]', 'text_domain' ), ) 
      );
   }
   
   public function widget( $args, $instance ) {
      echo $args['before_widget'];
      if ( ! empty( $instance['title'] ) ) {
         echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
      }
      ?>
<div class='widget-post'>
 <div id="theHISTORYs">

</div>
</div>
<script type="text/javascript">
 jQuery(document).ready(function($){
   $.ajax({
     url:'https://komikcast.com/wp-content/themes/KomikCAST/history.php',
     data: {'historyread': JSON.parse(localStorage.getItem('history'))},
     type: 'POST',
     dataType: 'text',
   }).done(function(response){
           $('#theHISTORYs').html(response);
        });
});

</script>
</div>
<?php

   }
   
   public function form( $instance ) {
   $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
   $count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( '5', 'text_domain' );
   $orderby = ! empty( $instance['orderby'] ) ? $instance['orderby'] : esc_html__( 'Orderby', 'text_domain' );
   ?>
<p>
   <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
   <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
   <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_attr_e( 'Count:', 'text_domain' ); ?></label> 
   <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="number" value="<?php echo esc_attr( $count ); ?>">
   <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Orderby:' ); ?></label>
      <select name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_id( 'orderby' ); ?>" class="widefat">
      <option value="date"<?php selected( $instance['orderby'], 'date' ); ?>><?php _e( 'Date' ); ?></option>
      <option value="rand"<?php selected( $instance['orderby'], 'rand' ); ?>><?php _e( 'Rand' ); ?></option>
   </select>
</p>
<?php 
   }
   
   public function update( $new_instance, $old_instance ) {
      $instance = array();
      $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
      $instance['count'] = ( ! empty( $new_instance['count'] ) ) ? sanitize_text_field( $new_instance['count'] ) : '';
      $instance['orderby'] = ( ! empty( $new_instance['orderby'] ) ) ? sanitize_text_field( $new_instance['orderby'] ) : '';
   
      return $instance;
   }
   
   
   
   } 
 