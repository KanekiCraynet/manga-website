<?php
/*
Template Name: Bookmark Page
 */
if (!is_user_logged_in()) {
    $loginpage    = get_page_url('loginpages');
    $bookmarkpage = get_page_url('bookmark');
    wp_safe_redirect("$loginpage?from=$bookmarkpage");
    exit;
}
$orderby   = isset($_GET['sortby']) ? $_GET['sortby'] : 'added';
$paged     = (get_query_var('paged')) ? get_query_var('paged') : 1;
$bookmarks = __get_user_bookmarks($orderby, $paged);
get_header();
?>
<script>
var is_bookmark_page = true;
var bookmark_query =
    <?php echo $bookmarks instanceof WP_Query ? json_encode($bookmarks->query) : json_encode($bookmarks);?>;
</script>
<div class="postbody komikinfo">
    <div class="bixbox">
        <div class="releases">
            <div class="header-left">
                <h1><span>Bookmark</span></h1>
                <span><?php echo $bookmarks instanceof WP_Query ? $bookmarks->found_posts : '0' ?> Total
                    bookmark</span>
            </div>
            <div class="sortby">
                <form
                    style="display: inline-flex;flex-direction: row; flex-wrap: wrap; justify-content: center;align-items: center; gap: 1rem;">
                    <label class="select_bookmark" for="sortby_bookmark">
                        <select id="sortby_bookmark" name="sortby" required="required">
                            <option value="added" <?php selected('added', $orderby)?>>Date</option>
                            <option value="title_asc" <?php selected('title_asc', $orderby)?>>A-Z</option>
                            <option value="title_desc" <?php selected('title_desc', $orderby)?>>Z-A</option>
                        </select>
                        <svg>
                            <use xlink:href="#select-arrow-down"></use>
                        </svg>
                    </label>
                    <button class="bookmark_button" type="submit">Filter</button>
                </form>
            </div>
        </div>
        <div id="list-update" class="list-update">
            <div id="list-update_items-wrapper" class="list-update_items-wrapper">
                <?php if ($bookmarks instanceof WP_Query && $bookmarks->have_posts()): foreach ($bookmarks->posts as $post):
        get_template_part('template-parts/post/content', 'bookmark', ['post' => $post]);endforeach;else: ?>
                <span>Belum ada yang kamu bookmark...</span>
                <?php endif;?>
            </div>
            <div class="pagination bookmark-page">
                <?php echo paginate_links(['total' => $bookmarks->max_num_pages, 'current' => $paged]); ?>
            </div>
        </div>
        <?php if ($bookmarks instanceof WP_Query && $bookmarks->found_posts): ?>
        <div class="reset-bar">
            <div class="delete">
                <button class="delete-button" id="deleteButton">Delete</button>
            </div>
            <div class="reset">
                <button class="reset-button" data-bs-toggle="modal" data-bs-target="#resetModal">Reset</button>
            </div>
        </div>
        <?php endif;?>
    </div>
</div>
<div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="resetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="resetModalLabel">Masukkan Password Untuk Reset</h1>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">

                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">

                </div>
                <div class="alert alert-info alert-dismissible fade show" role="alert" style="display: none;">

                </div>

                <div class="form-group">
                    <label class="form-label" for="resetbookmarkpassword">Password</label>
                    <input type="password" class="form-control" id="resetbookmarkpassword" name="resetbookmarkpassword"
                        required="true">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-success-status
                    data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Reset Sekarang</button>
            </div>
        </div>
    </div>
</div>

<svg class="bookmark_sprites">
    <symbol id="select-arrow-down" viewbox="0 0 10 6">
        <polyline points="1 1 5 5 9 1"></polyline>
    </symbol>
</svg>

<?php get_footer();?>