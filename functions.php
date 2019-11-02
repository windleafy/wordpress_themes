<?php
    add_theme_support( 'post-thumbnails' );
    /*set_post_thumbnail_size( 100, 100, true ); 
    add_image_size( 'single-post-thumbnail', 400, 9999, true );*/

    /*自定义获取缩略图地址的函数*/
    function post_thumbnail_url(){
        global $post, $posts;
        if (has_post_thumbnail()) {
            $html = get_the_post_thumbnail();
            preg_match_all("/<img.*src\s*=\s*[\"|\']?\s*([^>\"\'\s]*)/i", $html, $matches);
            $imgsrc=$matches[1][0];
        }else{
            $content = $post->post_content;
            preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',$post->post_content,$matches);
            $imgsrc=$matches[1][0];
            if($imgsrc==""){ 
            // 如果无图片则显示none，当然也可以自定义个URL地址
                $imgsrc="none";
            }
        }
        echo "$imgsrc";
    };

    /*支持webp图片上传*/
    function bzg_filter_mime_types( $array ) {
      $array['webp'] = 'image/webp';
      return $array; 
    }
    add_filter( 'mime_types', 'bzg_filter_mime_types', 10, 1 );
    /*支持webp图片缩略图*/
    function bzg_file_is_displayable_image($result, $path) {
      $info = @getimagesize( $path );
      if($info['mime'] == 'image/webp') {
        $result = true;
      }
      return $result;
    }
    add_filter( 'file_is_displayable_image', 'bzg_file_is_displayable_image', 10, 2 );

    add_action('template_include', 'load_single_template');

    function load_single_template($template) {
        $new_template = '';
        // single post template
        if( is_single() ) {
            global $post;
            // 'wordpress' is category slugs
            if( has_term('wordpress', 'category', $post) ) {
                // use template file single-wordpress.php
                $new_template = locate_template(array('single-wordpress.php' ));
            }
        }
        return ('' != $new_template) ? $new_template : $template;
    }

/*获取文章第一个标签*/
function get_1st_tag(){
        $posttags = get_the_tags();
        if ($posttags) {
            return $posttags[0]->name;
        }
    }

/*禁用wordpress自动emoji*/
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');    
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');    
remove_action('embed_head', 'print_emoji_detection_script');

remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

#给媒体文件添加分类和标签
function ludou_add_categories_tags_to_attachments() {
  register_taxonomy_for_object_type( 'category', 'attachment' );
  register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init' , 'ludou_add_categories_tags_to_attachments' );
?>