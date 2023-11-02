function delete_product_with_gallery_images( $postid ) {

    // We check if the global post type isn't ours and just return
    global $post_type;   
    if ( $post_type != 'product' ) return;

    // Check if the product has gallery images
    $product = wc_get_product( $postid );
    $attachment_ids = $product->get_gallery_image_ids();

    if ( $attachment_ids && is_array( $attachment_ids ) ) {
        // Loop through gallery images and delete them
        foreach ( $attachment_ids as $attachment_id ) {
            wp_delete_attachment( $attachment_id, true );
        }
    }

    // Check for a featured image ('Product Image') and delete it
    $featured_image_id = get_post_thumbnail_id( $postid );
    if ( $featured_image_id ) {
        wp_delete_attachment( $featured_image_id, true );
    }
}
add_action( 'before_delete_post', 'delete_product_with_gallery_images' );
