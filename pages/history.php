<?php
/*
Template Name: History List
 */

get_header();

?>
<script>
var is_history_page = true;
</script>
<div id="history" class="history">
    <div class="history_header">
        <h2>History</h2>
    </div>

    <div id="history_wrapper" class="history_wrapper">

    </div>
</div>
<template id="history-item">
    <li class="komik_info-chapters-item" style="padding-inline: 1rem;">
        <a class="chapter-link-item" style="padding-block: 0.25rem;" href="">default_title</a>
        <div class="chapter-link-time">
            added_time
        </div>
    </li>
</template>
<?php get_footer();?>