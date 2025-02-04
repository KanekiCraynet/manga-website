<?php get_header();
$kln = get_option('singlepage');
if ($kln) {
    echo '<br/><div class="kln"><div class="lmt">' . $kln . '</div></div>';
}

$meta          = get_post_meta(get_the_ID(), 'smoke_series', true);
$current_title = get_post_meta(get_the_ID(), 'smoker_chapter', true);
$sx            = get_the_ID();
$term_list     = wp_get_post_terms($sx, 'genres', array("fields" => "names"));
$allchapters   = []; ?>
<style>
    @media (min-width: 768px) {
        .left-control-new {
            max-width: 416px;
        }
    }

    .server_select_notif {
        background: #282731;
        box-shadow: inset 3px 2px 6px 1px #2f2f2f;
        overflow: hidden;
        padding: 10px 15px;
        font-size: 16px;
        width: 100%;
        color: #999;
        border-radius: 3px;
        text-align: center;
        font-weight: 600;
    }
</style>
<script>
    var is_chapter_page = true;
    var save_history_read = {
        title: "<?php echo get_the_title($sx); ?>",
        id: <?php echo $sx; ?>,
        added: Date.now(),
        link: "<?php the_permalink(); ?>"
    };
</script>
<div class="chapter_" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
    <meta content="<?php the_ID(); ?>" itemprop="postId">
    <div class="chapter_headpost">
        <h1 itemprop="name"><?php the_title(); ?></h1>
        <div class="allc">Semua chapter ada di <a href="<?php echo get_the_permalink($meta); ?>"><?php echo get_the_title($meta); ?></a>
        </div>
    </div>
    <div class="chapter_breadcrumb">
        <ol class="chapter_breadcrumb-list">
            <li><a href="<?php echo get_site_url(); ?>"><?php echo get_bloginfo('name'); ?></a></li>
            <i class="fas fa-caret-right"></i>
            <li><a href="<?php echo get_the_permalink($meta); ?>"><?php echo get_the_title($meta); ?></a>
            </li>
            <i class="fas fa-caret-right"></i>
            <li><?php the_title(); ?></li>
        </ol>
    </div>
    <center>
        <?php $kln = get_option('readertop');
        if ($kln) {
            echo '<div class="kln"><div class="lmt">' . $kln . '</div></div>';
        } ?>
    </center>

    <?php echo redesign_social_sharing(get_the_ID()); ?>
    <p itemprop="mainContentOfPage">Baca manga <a href="<?php echo get_the_permalink($meta); ?>"><?php echo get_the_title($meta); ?></a>
        terbaru di <a href="<?php echo get_site_url(); ?>"><?php echo get_bloginfo('name'); ?></a>. Manga <a href="<?php echo get_the_permalink($meta); ?>"><?php echo get_the_title($meta); ?></a>
        selalu update di <a href="<?php echo get_site_url(); ?>"><?php echo get_bloginfo('name'); ?></a>. Jangan lupa
        membaca update manga lainnya ya. Daftar koleksi manga <a href="<?php echo get_site_url(); ?>"><?php echo get_bloginfo('name'); ?></a> ada di menu Daftar Manga.
    </p>

    <div id="chapter_body" class="chapter_body">
        <span class="server_select_notif"> Laporkan jika ada gambar rusak/tidak muncul ke <a href="https://discord.gg/n8XEka8">Discord Kami</a>
        </span>
        <div class="chapter_nav-control" style="margin-top:0;">
            <div class="left-control left-control-new">
                <label for="chapter" class="select-label">
                    <select name="chapter" id="slch" onchange="window.open(this.options[this.selectedIndex].value,'_self')" text="Search Here&hellip;">
                        <?php
                        $selected_server = isset($_GET['srv']) && !empty($_GET['srv']) ? $_GET['srv'] : (get_option('default_server') ? get_option('default_server') : 'cdn');
                        $args            = array(
                            'post_type'      => 'chapter',
                            'posts_per_page' => 1000, // How many items to display
                            'no_found_rows' => true, // We don't ned pagination so this speeds up the query
                        );
                        $cats     = wp_get_post_terms(get_the_ID(), 'category');
                        $cats_ids = array();
                        foreach ($cats as $wpex_related_cat) {
                            $cats_ids[] = $wpex_related_cat->term_id;
                        }
                        if (!empty($cats_ids)) {
                            $args['category__in'] = $cats_ids;
                        }
                        $wpex_query = new wp_query($args);
                        foreach ($wpex_query->posts as $post) : setup_postdata($post);

                            $metalist = get_post_meta(get_the_ID(), 'smoker_chapter', true)
                        ?>
                            <option value="<?php the_permalink(); ?>" <?php if ($metalist === $current_title) {
                                                                            echo 'selected';
                                                                        }; ?>>
                                Chapter <?php echo $metalist; ?>
                            </option>
                        <?php endforeach;
                        wp_reset_postdata(); ?>
                    </select>
                    <svg>
                        <use xlink:href="#select-arrow-down"></use>
                    </svg>
                </label>
            </div>

            <div class="right-control">
                <?php nextprev(); ?>
            </div>
        </div>
        <?php $customreader = get_option('readercustom');
        if ($customreader) {
            echo $customreader;
        }; ?>
        <div class="main-reading-area">
            <?php $chp = get_post_meta($post->ID, 'smoke_gamb', true);
            $server                = array("svr4.imgkc1.my.id", "svr5.imgkc2.my.id", "svr6.imgkc3.my.id", "svr7.imgkc4.my.id", "svr9.imgkc.my.id");
            $rand                  = array_rand($server);
            $imagex                = str_replace(array("cdn.komikcast.com", "cdn.komikcast.me", "image.komikcast.xyz"), $server[$rand], $chp);
            if (get_option('lazyload_chapter', false)) {
                $imagex = str_ireplace(["src=\"", "class=\""], ["data-src=\"", "class=\"lazyload "], $imagex);
            }
            foreach ($imagex as $image) {
                echo $image;
            }; ?>
        </div>
        <div class="chapter_nav-control">
            <div class="left-control">
                <label for="chapter" class="select-label">
                    <select name="chapter" id="slch" onchange="window.open(this.options[this.selectedIndex].value,'_self')" text="Search Here&hellip;">
                        <?php
                        $args = array(
                            'post_type'      => 'chapter',
                            'posts_per_page' => 1000, // How many items to display
                            'no_found_rows' => true, // We don't ned pagination so this speeds up the query
                        );
                        $cats     = wp_get_post_terms(get_the_ID(), 'category');
                        $cats_ids = array();
                        foreach ($cats as $wpex_related_cat) {
                            $cats_ids[] = $wpex_related_cat->term_id;
                        }
                        if (!empty($cats_ids)) {
                            $args['category__in'] = $cats_ids;
                        }
                        $wpex_query = new wp_query($args);
                        foreach ($wpex_query->posts as $post) : setup_postdata($post);
                            $metalist = get_post_meta(get_the_ID(), 'smoker_chapter', true); ?>
                            <option value="<?php the_permalink(); ?>" <?php if ($metalist === $current_title) {
                                                                            echo 'selected';
                                                                        }; ?>>
                                Chapter <?php echo $metalist; ?>
                            </option>
                        <?php endforeach;
                        wp_reset_postdata(); ?>
                    </select>
                    <svg>
                        <use xlink:href="#select-arrow-down"></use>
                    </svg>

                </label>
            </div>
            <div class="right-control">
                <?php nextprev(); ?>
            </div>
        </div>
        <?php
        if (in_array("Adult", $term_list)) {
            $kln = get_option('bottomadult');
            if ($kln) {
                echo '<br/><div class="kln"><div class="lmt">' . $kln . '</div></div>';
            }
        } else {
            $kln = get_option('readerbottom');
            if ($kln) {
                echo '<br/><div class="kln"><div class="lmt">' . $kln . '</div></div>';
            }
        }; ?>
    </div>
    <div class="tags">tags: baca manga
        <?php $meta = get_post_meta(get_the_ID(), 'smoke_series', true);
        echo get_the_title($meta); ?> Chapter
        <?php $meta = get_post_meta(get_the_ID(), 'smoker_chapter', true);
        echo $meta; ?> bahasa Indonesia, komik
        <?php $meta = get_post_meta(get_the_ID(), 'smoke_series', true);
        echo get_the_title($meta); ?> Chapter
        <?php $meta = get_post_meta(get_the_ID(), 'smoker_chapter', true);
        echo $meta; ?> bahasa Indonesia, baca
        <?php $meta = get_post_meta(get_the_ID(), 'smoke_series', true);
        echo get_the_title($meta); ?> Chapter
        <?php $meta = get_post_meta(get_the_ID(), 'smoker_chapter', true);
        echo $meta; ?> online,
        <?php $meta = get_post_meta(get_the_ID(), 'smoke_series', true);
        echo get_the_title($meta); ?> Chapter
        <?php $meta = get_post_meta(get_the_ID(), 'smoker_chapter', true);
        echo $meta; ?> bab,
        <?php $meta = get_post_meta(get_the_ID(), 'smoke_series', true);
        echo get_the_title($meta); ?> Chapter
        <?php $meta = get_post_meta(get_the_ID(), 'smoker_chapter', true);
        echo $meta; ?> chapter,
        <?php $meta = get_post_meta(get_the_ID(), 'smoke_series', true);
        echo get_the_title($meta); ?> Chapter
        <?php $meta = get_post_meta(get_the_ID(), 'smoker_chapter', true);
        echo $meta; ?> high quality,
        <?php $meta = get_post_meta(get_the_ID(), 'smoke_series', true);
        echo get_the_title($meta); ?> Chapter
        <?php $meta = get_post_meta(get_the_ID(), 'smoker_chapter', true);
        echo $meta; ?> manga scan, <time itemprop="datePublished" datetime="<?php the_time('c'); ?>"><?php the_time('F j, Y'); ?></time>, <span itemprop="author"><?php the_author(); ?></span>
    </div>

    <div class="komik_info-body chapter_comment">
        <div class="komik_info-comments">
            <h3>Comment</h3>
        </div>
        <div class="komik_info-comments-form" style="flex-direction:column">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php echo get_post_meta($post->ID, "anime", true); ?>
                    <?php comments_template(); ?>
            <?php endwhile;
            endif; ?>
        </div>
    </div>
    <svg class="sprites">
        <symbol id="select-arrow-down" viewbox="0 0 10 6">
            <polyline points="1 1 5 5 9 1"></polyline>
        </symbol>
    </svg>
</div>
<?php
// Current (chapter)
$chapterID = get_the_ID();
?>
<script type="text/javascript">
    // 	Lazyloading
    const imgs = document.querySelectorAll('.size-full');
    if (imgs && imgs.length !== 0) {
        imgs.forEach(i => {
            i.setAttribute('loading', 'lazy');
        })
    }
    // // Chapter for visited
    // const chapterID = [<?php echo $chapterID; ?>];
    // var vch = localStorage.getItem('visited-chapters') ? JSON.parse(localStorage.getItem('visited-chapters')) : [];
    // if (vch && !Array.isArray(vch)) {
    //     localStorage.setItem('visited-chapters', JSON.stringify(chapterID));
    // }
    // if (vch.length === 0) {
    //     localStorage.setItem('visited-chapters', JSON.stringify([...new Set([...vch, ...chapterID])]));
    // }

    // if (vch.length > 0) {
    //     var existed;
    //     for (var vc = 0; vc < vch.length; vc++) {
    //         if (vch[vc] === chapterID) {
    //             existed = true;
    //         }
    //     }

    //     if (!existed) localStorage.setItem('visited-chapters', JSON.stringify([...new Set([...vch, ...chapterID])]));
    // }
</script>
<?php get_footer(); ?>