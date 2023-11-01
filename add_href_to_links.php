function add_href_to_links( $content ) {
    $dom = new DOMDocument();
    @$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    $links = $dom->getElementsByTagName('a');
    
    foreach ($links as $link) {
        // Kiểm tra nếu thẻ <a> không có thuộc tính href
        if (!$link->getAttribute('href')) {
            $images = $link->getElementsByTagName('img');
            if ($images->length > 0) {
                $image = $images->item(0);
                $imgSrc = $image->getAttribute('src');
                // Thêm thuộc tính href vào thẻ <a>
                $link->setAttribute('href', $imgSrc);
            }
        }
    }

    return $dom->saveHTML();
}
add_filter('the_content', 'add_href_to_links');
