<?php

/***** Pre-Select a Category for a New Post *****/

function ws_preselect_post_category() {
    if ( isset($_GET['category_id']) && is_numeric($_GET['category_id']) ) {
        $catId = intval($_GET['category_id']);
        ?>
        <script type="text/javascript">
            jQuery(function() {
                var catId = <?php echo json_encode($catId); ?>;
                jQuery('#in-category-' + catId).click();
            });
        </script>
        <?php
    }
}
add_action('admin_footer-post-new.php', 'ws_preselect_post_category');