<?php if( !class_exists('db')){
    
     class db{
          
          public static $tb = 'builder_option';
          
          public static $tb_upload = 'builder_upload';
          
          /**
           * @return return values terms ( array)
          **/
          
          public static function terms(){
              global $wpdb; 
                 
              $prefix = $wpdb->prefix;
              
              $query_string = "SELECT * FROM ".$prefix."terms";
              
              $category = $wpdb->get_results($query_string, OBJECT);  
              
              if(!empty($category)){
                  if( is_array($category)){
                      
                      return $category; 
                      
                  }
              }
              
          }
          
          /**
           * @int term_rows (term_id)
           * @string 'desc' or 'asc'
           * @return array()
          **/
          
          public static function term_rows($id=null){
              global $wpdb; 
                 
              $prefix = $wpdb->prefix;
              
              $term_id = intval( $id );

              $query_string = "SELECT * FROM ".$prefix."terms WHERE term_id={$term_id}";
              
              $category = $wpdb->get_row($query_string, OBJECT);  
              
              if(!empty($category)){
                  if( is_object($category)){
                      
                      return $category; 
                      
                  }
              }
              
          }

          /**
           * @int term_relationships (term_taxonomy_id)
           * @string 'desc' or 'asc'
           * @return array()
          **/
          
          public static function term_relationships($id=null, $sort=null){
              global $wpdb; 
                 
              $prefix = $wpdb->prefix;
              
              $term_taxonomy_id = intval( $id);
              
              if( $sort == 'desc'){
                  $sort_val = "ORDER BY `object_id` DESC";
              } else 
           
              if( $sort == 'asc' ) {
                  $sort_val = "ORDER BY `object_id` ASC";
              } else {
                  $sort_val = null;
              }

              $query_string = "SELECT * FROM ".$prefix."term_relationships WHERE term_taxonomy_id={$term_taxonomy_id} $sort_val";
              
              $sql = $wpdb->get_results($query_string, OBJECT);  
              
              if(!empty($sql)){
                  if( is_array($sql)){
                      
                      return $sql; 
                      
                  }
              }
              
          }
          
          /**
           * @int term_relationships_post_id (object_id/postID)
           * @string 'desc' or 'asc'
           * @return array()
          **/
          
          public static function term_relationships_post_id($id=null, $sort='desc'){
              global $wpdb; 
                 
              $prefix = $wpdb->prefix;
              
              $object_id = intval( $id);
              
              if( $sort == 'desc'){
                  $sort_val = "ORDER BY `object_id` DESC";
              } else 
           
              if( $sort == 'asc' ) {
                  $sort_val = "ORDER BY `object_id` ASC";
              } else {
                  $sort_val = null;
              }

              $query_string = "SELECT * FROM ".$prefix."term_relationships WHERE object_id={$object_id} $sort_val";
              
              $sql = $wpdb->get_row($query_string, OBJECT);  
              
              if(!empty($sql)){
                  if( is_object($sql)){
                      
                      return $sql; 
                      
                  }
              }
              
          }
          
          /**
           * @int post_id_category_name (object_id/postID)
           * @return array(object)
          **/

          public static function post_id_category_name($id=null){
              global $wpdb; 
                 
              $prefix = $wpdb->prefix;
              
              $object_id = intval( $id);

              $query_string = "SELECT * FROM ".$prefix."term_relationships WHERE object_id={$object_id}";
              
              $sql = $wpdb->get_row($query_string, OBJECT);  
              
              if(!empty($sql)){
                  if( is_object($sql)){
                      
                      $term_tax_id = intval( $sql->term_taxonomy_id );
                      
                      if( !is_null( $term_tax_id ) ){
                        
                          $term_id_object = db::term_taxonomy_id( $term_tax_id );
                          
                          $term_id = intval( $term_id_object->term_id );
                          
                          if( !is_null($term_id)){

                               $term_object = db::term_rows( $term_id );
                               
                               if( is_object( $term_object ) ){
                                   
                                   return $term_object;
                                   
                               }
                               
                          }
                      }
                      
                  }
              }
              
          }
          
          /**
           * @int term_taxonomy (term_id)
           * @return array()
          **/
          
          public static function term_taxonomy($id=null){
              global $wpdb; 
                 
              $prefix = $wpdb->prefix;
              
              $term_id = intval( $id);
              
              $query_string = "SELECT * FROM ".$prefix."term_taxonomy WHERE term_id={$term_id}";
              
              $sql = $wpdb->get_results($query_string, OBJECT);  
              
              if(!empty($sql)){
                  if( is_array($sql)){
                      
                      return $sql; 
                      
                  }
              }
              
          }
          
          /**
           * @int term_taxonomy_id (term_taxonomy_id)
           * @return array(object)
          **/
          
          
          public static function term_taxonomy_id($id=null){
              global $wpdb; 
                 
              $prefix = $wpdb->prefix;
              
              $term_tax_id = intval( $id);
              
              $query_string = "SELECT * FROM ".$prefix."term_taxonomy WHERE term_taxonomy_id={$term_tax_id}";
              
              $sql = $wpdb->get_row($query_string, OBJECT);  
              
              if(!empty($sql)){
                  if( is_object($sql)){
                      
                      return $sql; 
                      
                  }
              }
              
          }
          
          /**
           * @int posts (postID)
           * @string 'desc' or 'asc'
           * @return object()
          **/
          
          public static function posts($id=null, $sort=''){
              global $wpdb; 
                 
              $prefix = $wpdb->prefix;
              
              $post_id = intval( $id);
              
              if( $sort == 'desc'){
                  $sort_val = "ORDER BY `ID` DESC";
              } else 
           
              if( $sort == 'asc' ) {
                  $sort_val = "ORDER BY `ID` ASC";
              } else {
                  $sort_val = '';
              }
              
              $query_string = "SELECT * FROM ".$prefix."posts WHERE ID={$post_id} AND post_status='publish' $sort_val";
              
              $sql = $wpdb->get_row($query_string, OBJECT);  
              
              if(!empty($sql)){
                  if( is_object($sql)){
                      
                      return $sql; 
                      
                  }
              }
              
          }
          
          /**
           * @array return values posts
           * post type default / posts
          **/
          
          public static function posts_execute($sort=''){
              global $wpdb; 
                 
              $prefix = $wpdb->prefix;

              if( $sort == 'desc'){
                  $sort_val = "ORDER BY `ID` DESC";
              } else 
           
              if( $sort == 'asc' ) {
                  $sort_val = "ORDER BY `ID` ASC";
              } else {
                  $sort_val = '';
              }
              
              $query_string = "SELECT * FROM ".$prefix."posts WHERE post_type='post' AND post_status='publish' $sort_val";
              
              $sql = $wpdb->get_results($query_string, OBJECT);  
              
              if(!empty($sql)){
                  if( is_array($sql)){
                      
                      return $sql; 
                      
                  }
              }
              
          }
          
          /**
           * @array return values posts
           * post type default / posts
          **/
          
          public static function posts_execute_injection($post_title=null){
              global $wpdb; 
                 
              $prefix = $wpdb->prefix;
              $length = strlen( $post_title );
              $len    = mb_strlen( html_entity_decode($post_title, ENT_QUOTES, 'UTF-8'),'UTF-8');
              $html   = null;
              $array  = $wpdb->get_results("SELECT * FROM ".$prefix."posts WHERE post_type='post' AND post_status='publish'", OBJECT); 
              
              if( !empty($post_title)){
              
                  if(!empty($array)){
                    
                      foreach($array as $array_keys => $array_vals){
                        
                             $string = trim($array_vals->post_title);
                             
                             if( !empty($string) ){
    
                                   $substr_length      = $len ? substr($string, 0, $length) : false;
                                   $substr_length_post = $len ? substr($post_title, 0, $length) : false;
    
                                       if( strpos($substr_length_post, $substr_length) !== false ){
                                           
                                               if( is_string( $substr_length ) AND is_string( $substr_length_post ) ){
                                               
                                                   $get_title = get_the_title($array_vals->ID);
                                                   $get_id    = intval($array_vals->ID);
                
                                                   $html .= '<div class="post-data-label">';
                                                   $html .= '<span class="post-sort-icon">';
                                                   $html .= '<input id="show_post_val_id" class="show_post_val_class" type="checkbox" name="show_post_val[]" value="'. $get_id .' "/>';
                                                   $html .= $get_title;
                                                   $html .= '</span>';
                                                   $html .= '</div>';
                                               } 
                                               
                                       }
                             }
                      }
                    
                  }
                  
                  return $html;
              
              }
              
              /** if( !empty($post_title)){
 
                       $post_title_val = "AND post_title='$post_title'";
                   
              } else {
                   $post_title_val = "";
              }
               
              $query_string = "SELECT * FROM ".$prefix."posts WHERE post_type='post' AND post_status='publish' $post_title_val";
              
              $sql = $wpdb->get_results($query_string, OBJECT);  
              
              if(!empty($sql)){
                  if( is_array($sql)){
                      
                      return $sql; 
                      
                  }
              } **/
              
          }
          
          /**
           * @string 'name'
           * @string 'desc/asc'
          **/
          
          public static function querys($name=null, $sort='desc'){
              global $wpdb;
              
              $table = $wpdb->prefix . self::$tb;
              
              if(!is_null($name)){
                
                   if( $sort == 'desc'){
                       $sort_val = "ORDER BY `id` DESC";
                       
                   } else 
                   
                   if( $sort == 'asc' ) {
                       $sort_val = "ORDER BY `id` ASC";
                       
                   } else {
                       $sort_val = null;
                   }
                   
                   $sql = $wpdb->get_results("SELECT * FROM $table $sort_val");
                
              }
              
              return $sql;
          }
          
          /**
           * @string 'name'
           * @string 'WHERE id=int'
           * @string 'desc/asc'
          **/
          
          public static function querys_injection($name=null, $field=null, $sort='desc'){
              global $wpdb;
              
              $table = $wpdb->prefix . self::$tb_upload; 
              
              if(!is_null($name)){
                
                   if( $sort == 'desc'){
                       $sort_val = "ORDER BY `id` DESC";
                       
                   } else 
                   
                   if( $sort == 'asc' ) {
                       $sort_val = "ORDER BY `id` ASC";
                       
                   } else {
                       $sort_val = null;
                   }
                   
                   if( !is_null($field)){
                       $field_val = $field;
                   } else {
                       $field_val = '';
                   }
                   
                   $sql = $wpdb->get_results("SELECT * FROM $table $field_val $sort_val");
                
              }
              
              return $sql;
          }
          
          public static function query_rows_injection_count($name=null, $field=null, $sort='desc'){
              global $wpdb;
              
              $table = $wpdb->prefix . self::$tb_upload; 
              
              if(!is_null($name)){
                
                   if( $sort == 'desc'){
                       $sort_val = "ORDER BY `id` DESC";
                       
                   } else 
                   
                   if( $sort == 'asc' ) {
                       $sort_val = "ORDER BY `id` ASC";
                       
                   } else {
                       $sort_val = '';
                   }
                   
                   if( !is_null($field)){
                       $field_val = $field;
                   } else {
                       $field_val = '';
                   }
                   
                   $sql = $wpdb->get_results("SELECT * FROM $table $field_val $sort_val");
                   
                   if(!empty($sql)){
                       foreach($sql as $sql_keys => $sql_res ){
                          $id_count[] = intval( $sql_res->id );
                       }
                   }
                   
                   if( !empty($id_count)){
                       return count( $id_count );
                   }
                
              }
          }
          
          /**
           * @string 'name'
           * @string 'WHERE id=1'
           * @string 'desc/asc'
          **/
          
          public static function query_rows($name=null, $field='', $sort='desc'){
              global $wpdb;
              
              $table = $wpdb->prefix . self::$tb;
              
              if(!is_null($name)){
                
                   if( $sort == 'desc'){
                       $sort_val = "ORDER BY `id` DESC";
                       
                   } else 
                   
                   if( $sort == 'asc' ) {
                       $sort_val = "ORDER BY `id` ASC";
                       
                   } else {
                       $sort_val = null;
                   }
                   
                   if( is_string($field)){
                       $field_var = $field;
                   } else {
                       $field_var = null; 
                   }
                   
                   $sql = $wpdb->get_row("SELECT * FROM $table $field_var $sort_val");
                
              }
              
              return $sql;
          }
          
          
          /**
           * @string 'name'
           * @array 'array('name'=>'value')'
           * @array 'array('%s', '%d')'
          **/
          
          public static function insert($tbl=null, $field=array(), $field_format=array()){
              global $wpdb;
              
              if( !is_null($tbl)){
                  
                  if( is_array($field)){
                      
                      if( count($field)>=1){
                          $field_var = $field;
                      }
                  }
                  
                  if( is_array($field_format)){
                      
                      if( count($field_format)>=1){
                          $field_format_var = $field_format;
                      }
                  }
                  
                  $wpdb->insert($tbl, $field_var, $field_format_var);
                  
              }
          }
          
          // db::update(tbl, array(), array(), array(), array());
          public static function update($tbl=null, $field=array(), $field_id=array(), $field_format=array(), $field_id_format=array()){
              global $wpdb;
              
              if( !is_null($tbl)){
                  
                  if( is_array($field)){
                      
                      if( count($field) >= 1 AND !is_null($field) ){
                          $field_var = $field;
                      }

                  }
                  
                  if( is_array($field_id)){
                      
                      if( count($field_id) >= 1 AND !is_null($field_id) ){
                          $field_id_var = $field_id;
                      }

                  }
                  
                  if( is_array($field_format)){
                      
                      if( count($field_format) >= 1 AND !is_null($field_format) ){
                          $field_format_var = $field_format;
                      }

                  }
                  
                  if( is_array($field_id_format)){
                      
                      if( count($field_id_format) >= 1 AND !is_null($field_id_format) ){
                          $field_id_format_var = $field_id_format;
                      }

                  }
                  
                  $wpdb->update($tbl, $field_var, $field_id_var, $field_format_var, $field_id_format_var); 
                  
              }
          }
          
          // db::replace(tbl, array(), array());
          public static function replace($tbl=null, $field=array(), $field_format=array() ){
              global $wpdb;
              
              if( !is_null($tbl)){
                  
                  if( is_array($field)){
                      
                      if( count($field)>=1){
                          $field_var = $field;
                      }
                  }
                  
                  if( is_array($field_format)){
                      
                      if( count($field_format)>=1){
                          $field_format_var = $field_format;
                      }
                  }
                  
                  $wpdb->replace($tbl, $field_var, $field_format_var); 
                 
              }
          }
          
          // db::delete(tbl, array(), array());
          public static function delete($tbl, $field=array(), $field_format=array()){
              global $wpdb;
              
              if( !is_null($tbl)){
                  
                  if( is_array($field)){
                      
                      if( count($field) >= 1 AND !is_null($field) ){
                        
                          $field_var = $field;
                      }
                  }
                  
                  if( is_array($field_format)){
                      
                      if( count($field_format) >= 1 AND !is_null($field_format) ){
                        
                          $field_format_var = $field_format;
                      }
                  }
                
              }
                
              $wpdb->delete($tbl, $field_var, $field_format_var);
          }
          
     }
     
}