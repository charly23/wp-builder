<?php

/*
Plugin Name: WP Builder
Description: Based Plugin Structure
Version: 1.0
Author: Plonta Creative
Author URI: http://plontacreative.com/
*/

function reqister() {
        
    $php = array( ".php", "/" );
    $php_val = array_shift(array_values($php));
    $slashes = end($php);
        
    /** auto load 
        $system = array( 'system1', 'system2', 'system3' );
    **/
        
    $system = array( 'add', 'load', 'input', 'html', 'direct' ); 
    
    define('SYSTEMS', 'system');
    foreach ( $system as $system_key => $system_var ) {
       if( is_string( $system[$system_key] )){  
           require_once ( SYSTEMS . $slashes . $system[$system_key] . $php_val );
       }
    }

    /** config load 
        $config = array( 'config1', 'config2', 'config3' );
    **/
        
    $config = array( 'autoload' );
    
    define('CONFIG', 'config');
    foreach ( $config as $config_key => $config_var ) {
       if( is_string(  $config[$config_key] )){ 
           require_once ( CONFIG . $slashes . $config[$config_key] . $php_val );
       }
    }

    /** model load 
        $model = array( 'model1', 'model2', 'model3' );
    **/
        
    $model = array( 'db' );
    
    define('MODEL', 'model');
    foreach ( $model as $model_key => $model_var ) {
       if( is_string(  $model[$model_key] )){ 
           require_once ( MODEL . $slashes . $model[$model_key] . $php_val );
       }
    }
    
    /** control load 
        $control = array( 'control1', 'control2', 'control3' );
    **/
    
    $control = array( 'action' );
    
    define('CONTROLLER', 'controller');
    foreach ( $control as $control_key => $control_var ) {
       if( is_string(  $control[$control_key] )){ 
           require_once ( CONTROLLER . $slashes . $control[$control_key] . $php_val );
       }
    }
        
}

if( function_exists( 'reqister' ) ) : reqister(); 
    endif;

/**
 * Adds WP_Builder widget.
 */
 
class wp_builder extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'wp_builder', // Base ID
			__('WP Builder', 'text_domain'), // Name
			array( 'description' => __( 'A WP Builder', 'text_domain' ), ) // Args
		);
        
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Builder::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];
		echo $args['after_widget'];
        
        $option_id = isset( $instance['option'] ) ? intval( $instance['option'] ) : null;

        if( !is_null($option_id)){
             
             $sql = db::query_rows("builder_option", "WHERE id=$option_id", 'desc');
             if(!empty($sql)){
                if(!empty($sql->options)){
                   $options_values = unserialize($sql->options);
                   $post_options   = unserialize($sql->post_options);
                   $post_checked   = unserialize($sql->post_checked);
                }
             }
         ?>    
         <style type="text/css">
         div.wp-builder-content{ width:<?php echo $options_values['option_width']; ?>; }
         div.wp-builder-post-content{ font-size:<?php echo $size_content; ?>; margin-bottom: 10px; }
         div.wp-builder-post-content p{ line-height: 18px; text-align: justify; }
         div.wp-builder-post-featured{  margin-top: 20px; overflow: hidden; }
         a.more-link{ background-color: #E6E6E6; background-image: -moz-linear-gradient(center top , #F4F4F4, #E6E6E6); border:1px solid #D2D2D2; border-radius: 3px; display: inline-block; margin-top: 10px; padding: 5px; text-decoration: none; }
         </style>
         <?php    
   
             if( !empty($options_values)){
                  
                  load::view( 'widget' );
                  Widget_Builder::inner( $options_values, $post_options, $post_checked );
                  
             }
        }
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Builder::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
	   global $wpdb;
        
        if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'New title', 'text_domain' );
		}
        
        if ( isset( $instance[ 'option' ] ) ) {
			$option = $instance[ 'option' ];
		} else {
			$option = null;
		}
        
	?> 
   
        <p id="field">
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        
        <p id="field">
		<label for="<?php echo $this->get_field_id( 'option' ); ?>"><?php _e( 'Option:' ); ?></label> 
		<select id="<?php echo $this->get_field_id( 'option' ); ?>" name="<?php echo $this->get_field_name( 'option' ); ?>" class="option-select">
            <?php
                $sql = db::querys("builder_option",'desc');
                if(!empty($sql)){
           ?>
                <option>Select Option</option>
           <?php
                    foreach($sql as $sql_key => $sql_val){
                        if(intval($sql_val->id)){
                        
                        $is_selected = $sql_val->id == $option ? "selected=''" : false;    
           ?> 
                        <option value="<?php echo intval($sql_val->id); ?>" <?php echo $is_selected; ?> ><?php echo $sql_val->title; ?></option>
           <?php
                        }
                    }
                }
            ?>
        </select> 
		</p>
       
	<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Builder::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
        
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['option'] = ( ! empty( $new_instance['option'] ) ) ? intval( $new_instance['option'] ) : '';
        
		return $instance;
	}

} 

function wp_load_builder() { register_widget( 'wp_builder' ); }

add_action( 'widgets_init', 'wp_load_builder' );