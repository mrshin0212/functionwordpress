function add_nofollow_to_anchor_tags() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('a:not([href])').attr('rel', 'nofollow');
        });
    </script>
    <?php
}
add_action('wp_footer', 'add_nofollow_to_anchor_tags');
