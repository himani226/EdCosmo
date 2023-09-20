<?php


/**
 * Adds love to the posts used in various post types.
 * 
 * @since 1.0.0
 */


class Codeless_Post_Like
{

    function __construct() {

        add_action('wp_ajax_codeless_post_like', array(&$this,
            'action_trigger'
        ));
        add_action('wp_ajax_nopriv_codeless_post_like', array(&$this,
            'action_trigger'
        ));

    }

    function action_trigger($post_id) {
        
        if (isset($_POST['post_id'])) {
            $post_id = str_replace('codeless-like-', '', $_POST['post_id']);
            echo self::post_like($post_id, 'update');
        } 
        else {
            $post_id = str_replace('codeless-like-', '', $_POST['post_id']);
            echo self::post_like($post_id, 'get');
        }
        
        exit;
    }

    static function post_like($post_id, $action = 'get') {
        
        if (!is_numeric($post_id)) return;
        
        switch ($action) {
            case 'get':
                $love_count = get_post_meta($post_id, '_codeless_post_like', true);
                if (!$love_count) {
                    $love_count = 0;
                    add_post_meta($post_id, '_codeless_post_like', $love_count, true);
                }
                
                return '<span class="cl-entry__tool-count">' . $love_count . '</span>';
                break;

            case 'update':
                $love_count = get_post_meta($post_id, '_codeless_post_like', true);
                if (isset($_COOKIE['codeless_thype_post_like_' . $post_id])) return $love_count;
                
                $love_count++;
                update_post_meta($post_id, '_codeless_post_like', $love_count);
                setcookie('codeless_thype_post_like_' . $post_id, $post_id, time() * 20, '/');
                
                return '<span class="cl-entry__tool-count">' . $love_count . '</span>';
                break;
            }
    }
    



    static function like($icon = 'cl-icon-heart') {
        global $post;
        
        $love_count = self::post_like($post->ID);
        
        $class = '';

        if (isset($_COOKIE['codeless_thype_post_like_' . $post->ID])) {
            $class = 'item-liked';
        }
        
        return '<a href="#" class="like ' . $class . '" id="codeless-like-' . $post->ID . '">' . $love_count . '<i class="'.$icon.'"></i> </a>';

    }
}
new Codeless_Post_Like();

?>