<?php

class page{
    
    public static $icon = "wpbuilder/images/1392377496_widgets.png";
    
    public static $plugin_slug = 'wpbuilder';
    
    function __construct(){
          add::action_page( array($this, 'admin_page') );
          
          /**
            * Backend Style
          **/
             
          add::style(true, self::$plugin_slug.'admin-style', 'wpbuilder/css/admin.css' );

          add::style(true, self::$plugin_slug.'jquery-ui', 'wpbuilder/css/jquery.ui.css'); 
          
          /**
           * Front Style
          **/
          
          add::style(false, self::$plugin_slug.'front-style', 'wpbuilder/css/front.css' );
            
          /**
            * Backend Script 
          **/

          add::wp_script('jQuery');
          add::wp_script('jquery-ui-sortable');
          add::wp_script('jquery-ui-draggable');
          add::wp_script('jquery-ui-droppable');
          
          add::wp_script('jquery-ui-core');
          add::wp_script('jquery-ui-dialog');
          add::wp_script('jquery-ui-slider');
          
          add::script(true, self::$plugin_slug.'admin-script', 'wpbuilder/js/admin.js' );
          add::script(true, self::$plugin_slug.'sort-script', 'wpbuilder/js/sort.js' );
          
          add::script(false, self::$plugin_slug.'front-script', 'wpbuilder/js/front.js' );
          
          add::script(true, 'ajax_handler', 'wpbuilder/js/ajax.js' );
          add::localize_script( true, 'ajax_handler', 'ajax_script', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
          
          add::action_ajax( array($this, 'ajax_search_action' ) );
          add::action_ajax( array($this, 'ajax_search_all' ) );
          add::action_ajax( array($this, 'ajax_category_search_action') );
          
          // actions option
          
          add::action_loaded( array($this,'update_db_check') );
          
          add::action_submit(1, array($this, 'save_option'));        
          add::action_submit(1, array($this, 'del_option')); 
          
          add::action_submit(1, array($this, 'add_option'));       
          
          add::action_submit(1, array($this, 'upload_option'));       
            
    } 
    
    public function admin_page(){
        $menu[] = array( 'WP Builder', 'WP Builder', 1, 'wp_builder', array( $this, 'wp_builder_function'), self::$icon );
        $menu[] = array( 'Add New Option', 'Add New Option', 1, 'wp_builder', 'add_new_option_wp_builder', array( $this, 'add_new_option_wp_builder_function' ) );
        $menu[] = array( 'Help?', 'Help?', 1, 'wp_builder', 'help_wp_builder', array( $this, 'help_wp_builder_function' ) );
        if( is_array( $menu )){
            add::load_menu_page( $menu );
        }
    }
    
    public function update_db_check() {
        global $db_version;
        if (get_site_option( 'db_version' ) != $db_version) {
            page::install();
        }
    }
    
    public static function install(){
        global $wpdb;
        
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        
        $table1 = $wpdb->prefix . "builder_option"; 
        
        $sql1 = "CREATE TABLE $table1 (
          id int(9) NOT NULL AUTO_INCREMENT,
          sid text NOT NULL,
          title text NOT NULL,
          description text NOT NULL,
          options text NOT NULL,
          post_checked text NOT NULL,
          post_options text NOT NULL,
          UNIQUE KEY id (id)
        );";
        
        dbDelta( $sql1 );
        
        $table2 = $wpdb->prefix . "builder_upload"; 
        
        $sql2 = "CREATE TABLE $table2 (
          id int(9) NOT NULL AUTO_INCREMENT,
          oid int(9) NOT NULL,
          pid int(9) NOT NULL,
          title text NOT NULL,
          images text NOT NULL,
          UNIQUE KEY id (id)
        );";
        
        dbDelta( $sql2 );

    }
    
    // view 
    
    public function wp_builder_function(){
        load::view('manager');
    }
    
    public function add_new_option_wp_builder_function(){
        load::view('add');
    }
    
    public function help_wp_builder_function(){
        load::view('help');
    }
    
    // controller action 
    
    public function add_option(){
        $is_post = input::post_is_array();
        if( isset($is_post['add_option'])){
            action::add( $is_post );
        }
    }
    
    public function save_option(){
        $is_post = input::post_is_array();
        if( isset($is_post['save_option']) ){
            action::insert( $is_post );
        }
        if( isset($is_post['update_option']) ){
            action::update( $is_post );
        }   
    }
    
    public function del_option(){
        $is_post = input::post_is_array();
        if( isset($is_post['delete_option'])){
            action::delete( $is_post );
        }
    }
    
    public function upload_option(){
        $is_post = input::post_is_array();
        if( isset( $is_post['update_option'] ) ){
            action::upload( $is_post ); 
        }
    }
    
    // ajax 
    
    public function ajax_search_action(){
        
        $is_post = input::post_is_array();
        $html    = null;
        $error   = "No results found.";
        
        if( isset($is_post['action']) ){
            
            $val = trim( $is_post['keyval'] );
   
            $search = db::posts_execute_injection( $val ); 
                 
            if(!empty($search)){
                
                $html .= $search;
                
            } else {
                
                $html .= "<div class='post-data-label'>$error</div>";
                  
            }
            
            echo $html;
             
        }
        
        die();
    }
    
    public function ajax_search_all(){
        
        $is_post = input::post_is_array();
        $html    = null;
        
        if( isset($is_post['action']) ){
        
            $search = db::posts_execute(); 
                     
            if(!empty($search)){
                foreach($search as $search_keys => $search_vals ){
                        
                        $html .= '<div class="post-data-label">';
                        $html .= '<span class="post-sort-icon">';
                        $html .= '<input id="show_post_val_id" class="show_post_val_class" type="checkbox" name="show_post_val[]" value="'. intval($search_vals->ID) .' "/>';
                        $html .= get_the_title($search_vals->ID);
                        $html .= '</span>';
                        $html .= '</div>';
                        
                }
            }
            
            echo $html; 
        }  
       
        die();
    }
    
    public function ajax_category_search_action(){
        
        $is_post = input::post_is_array();
        $html    = null;
        
        if( isset($is_post['action']) ){
            
            $term_id = intval( $is_post['keyval'] ); 

            $term_tax = db::term_taxonomy( $term_id );
            if(!empty($term_tax)){
                foreach($term_tax as $term_tax_keys => $term_tax_vals ){
                    $term_tax_id = intval( $term_tax_vals->term_taxonomy_id );
                    if( $term_tax_id ){
                        $term_rel = db::term_relationships($term_tax_id);
                        if(!empty($term_rel)){
                            foreach( $term_rel as $term_rel_keys => $term_rel_vals ){
                                
                                  $ojb_id = intval( $term_rel_vals->object_id ); 
                                   
                                  $html .= '<div class="post-data-label">';
                                  $html .= '<span class="post-sort-icon">';
                                  $html .= '<input id="show_post_val_id" class="show_post_val_class" type="checkbox" name="show_post_val[]" value="'. intval($ojb_id) .' "/>';
                                  $html .= get_the_title($ojb_id);
                                  $html .= '</span>';
                                  $html .= '</div>';
                            }
                        }
                    }
                }
                 
            }
            
            echo $html;
        }
         
        die();  
    }
} 

$page = new page();
?>