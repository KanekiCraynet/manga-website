<?php get_header();

$kln = get_option('komikinfo');
if ($kln) {
    echo '<br/><div class="kln"><div class="lmt">' . $kln . '</div></div>';
}

$cats      = wp_get_post_terms(get_the_ID(), 'category');
$cats_ids  = array();
$cats_data = '';
foreach ($cats as $wpex_related_cat) {
    $cats_ids[] = $wpex_related_cat->term_id;
}
if (!empty($cats_ids)) {
    $cats_data = $cats_ids;
}
$args = array(
    'post_type'     => 'chapter',
    'post__not_in'  => array(get_the_ID()), // Exclude current post
    'order_by'     => 'meta_value_num',
    'no_found_rows' => true, // We don't ned pagination so this speeds up the query
    'category__in' => $cats_data,
);

?>
<script>
var komik_id = <?php the_ID();?>;
var is_komik_page = true;
</script>
<div class="komik_info" itemscope="itemscope" itemtype="http://schema.org/Article" data-komikid="<?php the_ID();?>">
    <meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage"
        itemid="<?php the_permalink();?>">
    <div class="komik_info-body">
        <div class="komik_info-cover-box">
            <div class="komik_info-cover-image">
                <?php $images = rwmb_meta('ero_cover', 'type=image&size=full');
if (!empty($images)) {
    foreach ($images as $image) {?>
                <img src="<?php esc_url($image['url']);?>" alt="<?php esc_attr($image['alt']);?>">
                <?php }
} else {the_post_thumbnail();}?>
            </div>
        </div>
        <div class="komik_info-content">
            <div class="komik_info-content-thumbnail" itemprop="image" itemscope
                itemtype="https://schema.org/ImageObject">
                <?php the_post_thumbnail('medium_large', array('class' => 'komik_info-content-thumbnail-image'));?>
                <meta itemprop="url" content="<?php echo get_the_post_thumbnail_url(); ?>">
                <meta itemprop="width" content="190">
                <meta itemprop="height" content="260">
            </div>
            <div class="komik_info-content-body">
                <h1 itemprop="headline" class="komik_info-content-body-title"><?php the_title();?> Bahasa Indonesia
                </h1>
                <span class="komik_info-content-native"><?php meta(get_the_ID(), 'smoke_nativez');?></span>
                <span class="komik_info-content-genre">
                    <?php $termsdata = get_the_terms(get_the_ID(), 'genres');
foreach ($termsdata as $term) {
    ?>
                    <a class="genre-item <?php echo $term->slug; ?>" rel="tag" href="<?php $url = get_term_link($term->slug, 'genres');
    echo $url;?>"><?php echo $term->name; ?></a>
                    <?php }
;?>
                </span>
                <div class="komik_info-content-meta">
                    <span class="komik_info-content-info-release"><b>Released:</b>
                        <?php meta(get_the_ID(), 'smoke_date');?></span>
                    <span class="komik_info-content-info"><b>Author:</b>
                        <?php meta(get_the_ID(), 'smoke_author');?></span>
                    <span class="komik_info-content-info"><b>Status:</b>
                        <?php meta(get_the_ID(), 'smoke_status');?></span>
                    <span class="komik_info-content-info-type"><b>Type:</b> <?php term(get_the_ID(), 'type');?></span>
                    <span class="komik_info-content-info"><b>Total Chapter:</b>
                        <?php meta(get_the_ID(), 'smoke_total');?></span>

                    <span class="komik_info-content-update"><b>Updated on:</b> <time itemprop="dateModified"
                            datetime="<?php the_modified_date('c');?>"><?php the_modified_date('F j, Y');?></time></span>
                </div>
            </div>
            <div class="komik_info-content-rating">
                <div class="komik_info-content-rating-bungkus">
                    <?php $rating = get_post_meta(get_the_ID(), 'smoke_rate', true);if ('' == $rating) {$rating = '?';}?>
                    <div class="data-rating" data-ratingkomik="<?php echo $rating ? $rating : '?'; ?>">
                        <strong>Rating <?php echo $rating; ?></strong>
                        <div class="rating-bintang">
                            <?php if ($rating) {$ma = $rating / 2;} else { $ma = 0.0;}?>
                            <select class="score" data-current-rating="<?php echo $ma; ?>" autocomplete="off"
                                style="display:none">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <?php _is_bookmarked()?>
                </div>
            </div>
        </div>
        <div class="komik_info-description">
            <h3>Sinopsis</h3>
            <div class="komik_info-description-sinopsis" itemprop="articleBody">
                <?php if (have_posts()): while (have_posts()): the_post();?>
		                <?php echo get_post_meta($post->ID, "komik", true);
        wpb_set_post_views(get_the_ID()); ?>
		                <?php the_content();?>
		                <?php endwhile;endif;?>
            </div>
        </div>
        <?php if (has_term(array('Mature', 'Thriller', 'Gore'), 'genres', get_the_ID())) {?>
        <div style="background: #d1233a;color: white;padding: 0.5rem;">
            <span
                style="text-align: justify;color: inherit;font-size: 1rem; line-height: 1.5rem; font-family: Arial, Helvetica, sans-serif;">
                Peringatan, komik berjudul "<?php the_title();?>" ini di dalamnya mungkin terdapat konten
                kekerasan, berdarah, atau seksual yang tidak sesuai dengan pembaca di bawah umur.
            </span>
        </div>
        <?php }?>
        <div class="social-share" style="padding:1rem;">
            <?php echo redesign_social_sharing(get_the_ID()); ?>
        </div>

        <?php $kln = get_option('chaptertop');if ($kln) {echo '<div class="kln"><div class="lmt">' . $kln . '</div></div>';}?>


    </div>
    <div class="komik_info-body">
        <div class="komik_info-release">
            <h3>Chapter <?php the_title();?></h3>
        </div>

        <div class="komik_info-chapters">
            <ul id="chapter-wrapper" class="komik_info-chapters-wrapper">
                <?php
$args['posts_per_page'] = -1;
// Query posts
apply_filters('__user_read_marks', new WP_Query($args));
?>
            </ul>
        </div>
    </div>
    <div class="komik_info-body">
        <div class="komik_info-comments">
            <h3>Comment</h3>
        </div>
        <div class="komik_info-comments-form" style="flex-direction:column">
            <?php if (have_posts()): while (have_posts()): the_post();?>
		            <?php echo get_post_meta($post->ID, "anime", true); ?>
		            <?php comments_template();?>
		            <?php endwhile;endif;?>
        </div>
    </div>
    <span style="display: none;" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
        <span style="display: none;" itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
            <meta itemprop="url" content="<?php echo get_option('logo'); ?>">
        </span>
        <meta itemprop="name" content="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
    </span>
</div>
<?php get_footer();?>
<script>
function closeAlert() {
    document.getElementsByClassName("komik_info-alert")[0].style.display = "none";
    document.getElementsByClassName("komik_info-alert-overlay")[0].style.display = "none";
};
</script>