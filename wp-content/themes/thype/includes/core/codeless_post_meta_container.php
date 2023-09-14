<?php

class Cl_Post_Meta{
    
    public static $meta = array();
    public $post_meta = array();

    public function __construct(){
        add_filter( 'rwmb_outer_html', array( $this, 'add_required_fields'), 10, 3 );
    }
    
    public function init(){
        
    }

    public function add_required_fields( $outer_html, $field, $meta ){
        if( strpos($outer_html, 'required"') !== false ){
            $replace = 'required" data-actual-id="'.$field['id'].'" data-required-field="'.$field['required'][0].'" data-required-value="'.$field['required'][2].'" data-required-operator="'.$field['required'][1].'"';
            $outer_html = str_replace('required"', $replace, $outer_html);
        }
        return $outer_html;
    }

    /**
     * Add Meta in page Metabox plugin
     * 
     * @since 2.0.0
     */
    
    public static function register_meta_boxes_inpage( $meta_boxes ) {

        // all meta
        $meta = self::codeless_transform_meta_inpage( self::$meta );


        $meta_boxes[] = array(
            'id'         => 'layout_sect',
            'title'      => esc_html__( 'Layout', 'thype' ),
            'post_types' => array('page', 'post'),
            'priority'   => 'high',
            'context'    => 'side',
            'fields'     => $meta['layout_sect'],
            'closed'      => false,
        );

        $meta_boxes[] = array(
            'id'         => 'general',
            'title'      => esc_html__( 'General', 'thype' ),
            'post_types' => array('page'),
            'priority'   => 'high',
            'fields'     => $meta['general'],
            'closed'      => true,
        );

        $meta_boxes[] = array(
            'id'         => 'post_data',
            'title'      => esc_html__( 'Post Data', 'thype' ),
            'post_types' => array( 'post' ),
            'priority'   => 'high',
            'fields' => $meta['post_data'],
            'closed'      => true,
        );



        $meta_boxes[] = array(
            'id'         => 'slider_layout',
            'title'      => esc_html__( 'Style & Layout', 'thype' ),
            'post_types' => array('codeless_slider'),
            'priority'   => 'high',
            'fields'     => $meta['slider_layout'],
            'closed'      => false,
        );
 
        $meta_boxes[] = array(
            'id'         => 'slider_query',
            'title'      => esc_html__( 'Slider Query', 'thype' ),
            'post_types' => array('codeless_slider'),
            'priority'   => 'high',
            'fields'     => $meta['slider_query'],
            'closed'      => true,
        );

        $meta_boxes[] = array(
            'id'         => 'portfolio_data',
            'title'      => esc_html__( 'Portfolio Data', 'thype' ),
            'post_types' => array('portfolio'),
            'priority'   => 'high',
            'fields'     => $meta['portfolio_data'],
            'closed'      => false,
        );

        return $meta_boxes;
    }


    public static function codeless_transform_meta_inpage($post_metas){

        $organized_metas = array();

        foreach( $post_metas as $meta ){
            if( isset( $meta['group_in'] ) )
                $organized_metas[ $meta['group_in'] ][ $meta['id'] ] = $meta;
        }

        return $organized_metas;
    }

    public static function map($meta){
        if( ! function_exists( 'codeless_get_meta' ) )
            return;

        if( ! codeless_get_meta( $meta['id'] ) )
            $meta['value'] = isset( $meta['std'] ) ? $meta['std'] : '';
        else
            $meta['value'] = codeless_get_meta( $meta['id'] );

        self::$meta[] = $meta;
    }

    
}

$cl_post_meta = new Cl_Post_Meta();
$cl_post_meta->init();

?>