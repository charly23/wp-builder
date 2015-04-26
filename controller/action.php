<?php if( !class_exists('action')){
    
     class action{
          
          public static $tb = 'builder_option';
          
          public static $tb_upload = 'builder_upload';
          
          public static function add($attr=null){
                wp_redirect( 'admin.php?page=add_new_option_wp_builder', 301 ); 
                exit;
          }
          
          public static function insert($attr=null){
                global $wpdb;
                
                $table = $wpdb->prefix . self::$tb;
                
                $option_id_val = !empty( $attr['post_field_option_id_val'] ) ? $attr['post_field_option_id_val'] : array();
                    
                /** sort post id values **/
                    
                $post_filter_options = !empty( $attr['option_post_sort_id'] ) ? $attr['option_post_sort_id'] : array();
                    
                $show_post_val = !empty($attr['show_post_val']) ? $attr['show_post_val'] : array();
     
                if( !empty($attr['option_title'])){
        
                    if (($key = array_search('Save Option', $attr)) !== false) {
                         unset($attr[$key]);                
                         $attr_val = serialize($attr);
                    }
                    
                    $title = stripslashes_deep($attr['option_title']);
                    
                    $descr = stripslashes_deep($attr['option_descr']);
                    
                    $field = array(
                                      'title' => $title,
                                      'description' => $descr,
                                      'options' => $attr_val, 
                                      'post_options' => serialize( $option_id_val ),
                                      'post_checked' => serialize( $show_post_val )
                                  );
                    
                    $field_format = array(
                                              '%s',
                                              '%s',
                                              '%s',
                                              '%s'
                                         );
                    
                    $wpdb->insert($table, $field, $field_format);
                    
                    wp_redirect( 'admin.php?page=wp_builder', 301 ); 
                    exit;        
              }
                
          }
          
          public static function update($attr=null){
                global $wpdb;
                
                $table = $wpdb->prefix . self::$tb; 
                
                if( isset(input::get_is_object()->oid ) ){
                    
                    $option_id_val = !empty( $attr['post_field_option_id_val'] ) ? $attr['post_field_option_id_val'] : array();
                    
                    /** sort post id values **/
                    
                    $post_filter_options = !empty( $attr['option_post_sort_id'] ) ? $attr['option_post_sort_id'] : array();
                    
                    $show_post_val = !empty($attr['show_post_val']) ? $attr['show_post_val'] : array();       

                    if( !empty($attr['option_title'])){
                        
                        $id = intval(input::get_is_object()->oid);
                    
                        if (($key = array_search('Update Option', $attr)) !== false) {
                             unset($attr[$key]);                
                             $attr_val = serialize($attr);
                        }
                        
                        $title = stripslashes_deep($attr['option_title']);
                        
                        $descr = stripslashes_deep($attr['option_descr']);
                        
                        $field = array(
                                          'title' => $title,
                                          'description' => $descr,
                                          'options' => $attr_val, 
                                          'post_options' => serialize( $option_id_val ),
                                          'post_checked' => serialize( $show_post_val )
                                     );
                                     
                        $field_id = array( 'id' => $id );
                        
                        $field_format = array(
                                                  '%s',
                                                  '%s',
                                                  '%s',
                                                  '%s',
                                             );
                                             
                        $field_id_format = array( '%d' );
                        
                        $wpdb->update($table, $field, $field_id, $field_format, $field_id_format);
                        
                        wp_redirect( 'admin.php?page=add_new_option_wp_builder&oid='.$id, 301 ); 
                        exit;
                    }
                         
                } 
          }
          
          public static function delete($attr=null){
                global $wpdb;
                
                $table = $wpdb->prefix . self::$tb; 
                
                if(!empty($attr['delete_option_checked'])){
                    
                    $checked_val = $attr['delete_option_checked'];
                    
                    if( is_array($checked_val)){
                        
                        foreach($checked_val as $checked_val_key => $checked_val_res){
                            
                                if( intval($checked_val_res) ){
                                    
                                    $checked_id = intval( $checked_val_res );
                                    
                                    $wpdb->delete($table, array( 'id' => $checked_id ), array('%d') );
                                
                                }    
                        }
                    }
                }
          }
          
          public static function upload($attr=null){
                global $wpdb;
                
                $table = $wpdb->prefix . self::$tb_upload; 
                
                if(!empty($attr)){
                    
                    $post_upload_image = $attr['post_upload_image'];
                    if(!empty($post_upload_image)){
                        
                        if( isset(input::get_is_object()->oid)){
                            $oid = intval( input::get_is_object()->oid );
                        } else {
                            $oid = null;
                        }
                        
                        if( isset(input::get_is_object()->pid)){
                            $pid = intval( input::get_is_object()->pid );
                        } else {
                            $pid = null;
                        }
                        
                        foreach($post_upload_image as $post_upload_image_keys => $post_upload_image_vals ){
                            
                               $url_name = substr( $post_upload_image[$post_upload_image_keys], strrpos( $post_upload_image[$post_upload_image_keys], '/' )+1 );
                               
                               $field = array(
                                                  'oid' => $oid,
                                                  'pid' => $pid,
                                                  'title' => $url_name, 
                                                  'images' => $post_upload_image_vals 
                                             );
                    
                                $field_format = array(
                                                          '%d',
                                                          '%d',
                                                          '%s',
                                                          '%s'
                                                     );
                              
                              $wpdb->insert($table, $field, $field_format);
                        }
                        
                    }
                     
                }
                 
          }
          
     }
}
?>