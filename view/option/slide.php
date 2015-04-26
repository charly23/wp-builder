<?php

$cat_tab1_array = array( 'Name', 'Slug', 'Post' );
 
$cat_tab2_array = array();

$cat_tab3_array = array();

$object_res = array();
$res_object_html = null;

$terms_query = db::terms();
if( !empty($terms_query ) ){
     foreach($terms_query as $terms_query_rows => $terms_query_vals ){
          
          $term_id = intval( $terms_query_vals->term_id );

          $cat_tab2_array[] = array(
                                      'cat_name' => $terms_query_vals->name,
                                      'cat_slug' => $terms_query_vals->slug, 
                                      'cat_post' => '<span class="edit-plus-icon"></span>'
                                   );
                                   
          if( !is_null($term_id)){
            
              $term_tax = db::term_taxonomy($term_id);
              if( !empty($term_tax)){

                   foreach($term_tax as $term_tax_keys => $term_tax_vals ){
                   
                       $tax_id = intval( $term_tax_vals->term_taxonomy_id );
                       
                       if( !is_null($tax_id) ){
                        
                            $term_rel = db::term_relationships($tax_id, 'desc');
                            if( !empty($term_rel)){
                                 foreach( $term_rel as $term_rel_keys => $term_rel_vals ){
                                      
                                      $obj_id = intval( $term_rel_vals->object_id );
                                      if(!is_null($obj_id)){
                                          
                                           $object_res[] = $obj_id;
                                      }    
                                 }
                            }
                            
                       }
                   
                  }
                  
                  if( !is_null($object_res) ){
                       if( is_array( $object_res ) ){
                           
                           if(!empty($object_res)){
                               foreach($object_res as $object_res_key => $object_res_vals){
                                   
                                   if( intval($object_res_vals)){
                                       
                                       $post_id = intval( $object_res_vals );
                                       
                                       $posts_sql = db::posts($post_id, 'desc');
                                       if(!empty($posts_sql)){
                                        
                                           $res_object_html .= '<div class="post-data-content">';
                                           
                                           $res_object_html .= '<div class="post-data-action">';
                                           $res_object_html .= '<span class="post-data-action-title">'.html::label(array( 'text' => $posts_sql->post_title, 'for' => 'description' )).'</span>';
                                           
                                           if( isset( input::get_is_object()->oid )){
                                            
                                               $oid = '&oid='.intval( input::get_is_object()->oid );
                                               $oid_val = intval( input::get_is_object()->oid );
                                               
                                           } else {
                                               $oid = '';
                                               $oid_val_string = '';
                                           }
                                           
                                           $post_id = intval( $posts_sql->ID );
                                           
                                           $pid_val_string = "WHERE pid={$post_id} AND oid={$oid_val}";
                                           
                                           $upload_rows = db::query_rows_injection_count('builder_upload', $pid_val_string );
                                           
                                           if( intval($upload_rows) >=1 ){ 
                                               $res_object_html .= '<span class="count-pid">'.intval($upload_rows).'</span>';
                                           } else {
                                               $res_object_html .= '<span class="count-pid">'.__(0).'</span>';
                                           }
                                           
                                           $res_object_html .= '<a href="admin.php?page=add_new_option_wp_builder'.$oid.'&pid='.intval($posts_sql->ID).'" class="post-data-action-upload">Upload</a>';
                                           $res_object_html .= '<div class="clear"></div>';
                                           $res_object_html .= '</div>';
                                           
                                           /**
                                           $slug_title = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $posts_sql->post_title)));
                                           
                                           $res_object_html .= '<div class="post-data-field-upload" id="'.$slug_title.'">'.$posts_sql->post_title.'</div>'; **/
                                           
                                           $res_object_html .= '</div>';
                                           
                                       }
                                   
                                   }
                                   
                               }
                           }
                              
                       }
                  }
                   
                  $cat_tab3_array[] = '<div class="post-list-form">'.($res_object_html).'</div>';
                   
                  /** $cat_tab2_array[] = array(
                                               ''
                                            ); */
              }
          }
     }
}

echo html::table_list( array( 'id' => 'form_list', 'class' => 'category_form_list' ), $cat_tab1_array, $cat_tab2_array, $cat_tab3_array );       



?>