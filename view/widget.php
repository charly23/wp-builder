<?php
   
   if( !class_exists( 'Widget_Builder' ) ) {
    
       class Widget_Builder {
            
            public static function inner ( $options_values=null, $post_options=null, $post_checked=null ) {

                  $option_post_sort_val = isset( $options_values['option_post_sort_id'] ) ? $options_values['option_post_sort_id'] : array();
                  
                  if( !empty( $option_post_sort_val ) ){
                    

                       foreach( $option_post_sort_val as $option_post_sort_val_keys => $option_post_sort_val_res ){

                                $post_id_expl = explode( "=", $option_post_sort_val_res);
                                
                                /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                  * Sticky post area
                                  * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                **/
                                
                                if( $post_id_expl[0] == 0 ){
                                    
                                    $post_id_filter = intval( $post_id_expl[1] ); 

                                    if( !empty($post_options ) ){
    
                                         foreach($post_options as $post_options_keys => $post_options_vals ){

                                               $post_options_id =  explode( '=', $post_options_vals );

                                               $post_id_val     = intval( $post_options_id[1] );
                                               $option_id_val   = intval( $post_options_id[2] );
                                               
                                               if( $post_id_val == $post_id_filter ){
                                                   
                                                   $get_posts = get_post( $post_id_val );
                                                   
                                                   $post_id_val_filter = ( $post_options_id[0]."=".$post_id_val );
                                               ?>
                                                   <div class="wp-builder-content">
                                                      
                                                        <?php
                                                          
                                                          /**
                                                           * title options 
                                                          **/
                                                          
                                                          if( $option_id_val == 1 ){
                                                              $show_title = !empty( $options_values['show_post_title'.$post_id_val_filter][0] ) ? intval($options_values['show_post_title'.$post_id_val_filter][0]) : null;
                                                              $limit_title = !empty( $options_values['limit_post_title'.$post_id_val_filter][0] ) ? intval($options_values['limit_post_title'.$post_id_val_filter][0]) : null;

                                                              if( $show_title == 1 ){
                                                        ?>
                                                              <h1><a href="<?php echo get_permalink($post_id_val); ?>"><?php echo substr( get_the_title( $post_id_val ), 0, $limit_title ); ?></a></h1>
                                                        <?php  
                                                              }    
                                                          }
                                                        ?>
                                                        
                                                        <?php
                                                          
                                                          /**
                                                           * content options 
                                                          **/
                                                          
                                                          if( $option_id_val == 2 ){
                                                              
                                                              $show_content = isset( $options_values['show_post_content'.$post_id_val_filter][0] ) ? intval($options_values['show_post_content'.$post_id_val_filter][0]) : null;
                                                              $limit_content = isset( $options_values['limit_post_content'.$post_id_val_filter][0] ) ? intval($options_values['limit_post_content'.$post_id_val_filter][0]) : null;
                                                              $size_content = isset( $options_values['font_size_content_text'.$post_id_val_filter][0] ) ? intval($options_values['font_size_content_text'.$post_id_val_filter][0]) : null;
                                                              $more_content = isset( $options_values['more_post_content_text'.$post_id_val_filter][0] ) ? trim($options_values['more_post_content_text'.$post_id_val_filter][0]) : null;
                                                              
                                                              $content_post = get_post($post_id_val);
                                                              $content = $content_post->post_content;
                                                              $content = apply_filters('the_content', $content);
                                                              $content = str_replace(']]>', ']]&gt;', $content);
                                                        ?>
                                                              <div class="wp-builder-post-content"><?php echo substr($content, 0, $limit_content ); ?><a href="<?php echo get_permalink($post_id_val); ?>" class="more-link"><?php echo $more_content; ?></a></div>
                                                        <?php      
                                                          }
                                                          
                                                        ?>
                                                        
                                                        <?php
                                                          
                                                          /**
                                                           * image options 
                                                          **/
                                                          
                                                          if( $option_id_val == 3 ){
                                                            
                                                              $show_image = isset( $options_values['show_post_featured'.$post_id_val_filter][0] ) ? intval($options_values['show_post_featured'.$post_id_val_filter][0]) : null;
                                                              $size_image = isset( $options_values['image_size_select'.$post_id_val_filter][0] ) ? intval($options_values['image_size_select'.$post_id_val_filter][0]) : null;
                                                              $position_image = isset( $options_values['image_align_select'.$post_id_val_filter][0] ) ? intval($options_values['image_align_select'.$post_id_val_filter][0]) : null;

                                                              $all_sizes = get_intermediate_image_sizes(); 
                                                              
                                                              $url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id_val), $all_sizes[$size_image] );
                                                              
                                                              if( $position_image == 1){
                                                                  $pos_image = 'left';
                                                              } else {
                                                                  $pos_image = 'right';
                                                              }
                                                              
                                                              if( $show_image == 1 ){
                                                        ?>
                                                              <div class="wp-builder-post-featured" style="text-align:<?php echo $pos_image; ?>;"><?php if(!empty($url[0])): ?><img src="<?php echo $url[0]; ?>" longdesc="URL_2" alt="Text_2" width="<?php echo $url[1]; ?>" height="<?php echo $url[2]; ?>" /><?php else: ?><span><?php echo __('No featured image uploaded.'); ?></span><?php endif; ?></div>
                                                        <?php
                                                              }
                                                          }
                                                        ?>
                                                        
                                                        <?php
                                                          
                                                          /**
                                                           * gravatar options 
                                                          **/
                                                          
                                                          if( $option_id_val == 4 ){
                                                            
                                                              $show_gravatar = isset( $options_values['show_post_gravatar'.$post_id_val_filter][0] ) ? intval($options_values['show_post_gravatar'.$post_id_val_filter][0]) : null;
                                                              $post_data = get_postdata($post_id_val);
                                                              $author_id = intval( $post_data['Author_ID'] );
                                                              
                                                              $gravatar_size = isset($options_values['gravatar_size_select'.$post_id_val_filter][0]) ? intval( $options_values['gravatar_size_select'.$post_id_val_filter][0] ) : null;
                                                              $gravatar_align = isset($options_values['gravatar_align_select'.$post_id_val_filter][0]) ? intval( $options_values['gravatar_align_select'.$post_id_val_filter][0] ) : null;
                                                              
                                                              if( $gravatar_align == 1 ){
                                                                  $gra_align = 'left';
                                                              } else {
                                                                  $gra_align = 'right'; 
                                                              }
                                   
                                                              if( $show_gravatar == 1 ){
                                                        ?>
                                                        
                                                              <div class="wp-builder-post-gravatar" style="text-align:<?php echo $gra_align; ?>;" ><?php echo get_avatar( $author_id, $gravatar_size, 'Mystery Man', false ); ?></div>
                                                        
                                                        <?php
                                                              }
                                                          } 
                                                        ?>
                                                        
                                                        <?php
                                                          
                                                          /**
                                                           * slider options 
                                                          **/
                                                          
                                                          if( $option_id_val == 5 ){
                                                              
                                                              $post_sliders = is_array( $options_values['browse_text_values'.$post_id_val_filter] ) ? $options_values['browse_text_values'.$post_id_val_filter] : array();  
                                                        ?>
                                                        
                                                             <div class="WPBuilder-Slider">
                                                                      <div class="wrapper">
                                                                            <ul>
                                                                             <?php
                                                                                 if( !empty($post_sliders)){
                                                                                      foreach($post_sliders as $post_sliders_keys => $post_sliders_vals){
                                                                              ?>
                                                                                         <li><a href="<?php echo $post_sliders_vals; ?>" title=""><img src="<?php echo $post_sliders_vals; ?>" height="40" width="40" alt="" /></a></li>
                                                                              <?php           
                                                                                      }
                                                                                 }
                                                                              ?>
                                                                            </ul>      
                                                                       </div>
                                                                       <a href = "#" onclick = "toggle()" class="arrow back">Next</a>
                                                                       <a href = "#" onclick = "toggle()" class="arrow forward">Prev</a>
                                                                </div>

                                                        <?php
                                                          }
                                                        ?>
                                                        
                                                        <?php
                                                          
                                                          /**
                                                           * addon (date) format options 
                                                          **/
                                                          
                                                          if( $option_id_val == 6 ){ 
                                                            
                                                              $date_format = isset( $options_values['date_post_format'.$post_id_val_filter][0] ) ? trim($options_values['date_post_format'.$post_id_val_filter][0]) : null;
                                                              $postdate = get_the_date( $date_format, $post_id_val );
                                                        ?>
                                                              <div class="wp-builder-post-date"><span class="date-format">Date: <?php echo $postdate; ?></span></div>
                                                        <?php  
                                                          }
                                                        ?>
                                                        
                                                        <?php 
                                                          
                                                          /**
                                                           * addon (category) format options 
                                                          **/
                                                          
                                                          if( $option_id_val == 7 ){ 
                                                            
                                                              $object_id = db::post_id_category_name( $post_id_val );
                                                        ?>
                                                              <div class="wp-builder-post-category"><span class="date-format">Category: <?php echo $object_id->name; ?></span></div> 
                                                        <?php
                                                          }
                                                        ?>
                                                        
                                                        <?php
                                                           
                                                           /**
                                                           * addon (category) format options 
                                                           * addon (author) format options 
                                                           **/
                                                           
                                                           if( $option_id_val == 8 ){
                                                               
                                                               $post_data   = get_postdata($post_id_val);
                                                               $author_id   = intval( $post_data['Author_ID'] );
                                                               $author_name = null;
                                                               
                                                               $field = array(  
                                                                                'user_login',
                                                                                'user_pass',
                                                                                'user_nicename',
                                                                                'user_email',
                                                                                'user_url',
                                                                                'user_registered',
                                                                                'user_activation_key',
                                                                                'user_status',
                                                                                'display_name',
                                                                                'nickname',
                                                                                'first_name',
                                                                                'last_name',
                                                                                'description',
                                                                                'jabber',
                                                                                'aim',
                                                                                'yim',
                                                                                'user_level',
                                                                                'user_firstname',
                                                                                'user_lastname',
                                                                                'rich_editing',
                                                                                'comment_shortcuts',
                                                                                'admin_color',
                                                                                'plugins_per_page',
                                                                                'plugins_last_view',
                                                                                'ID' 
                                                                             );
                                                               
                                                               $author_field = !empty( $options_values['author_post_field'.$post_id_val_filter][0] ) ? trim( $options_values['author_post_field'.$post_id_val_filter][0] ) : "user_nicename";  
                                                               
                                                               $author_field_expl = explode(',',$author_field);

                                                               if(!empty($author_field_expl)){
                                                                   
                                                                   if( is_array($author_field_expl)){
                                                                     
                                                                       foreach($author_field_expl as $author_field_expl_keys => $author_field_expl_vals ){
                                                                          if(!empty($author_field_expl_vals)){
                                                                             $field_val =  trim( $author_field_expl_vals );
                                                                            
                                                                             if( in_array($field_val, $field ) ){
                                                                                 $author_name .= get_the_author_meta( $field_val, $author_id ) . " ";
                                                                             }
                                                                          }
                                                                       }
                                                                   }
                                                                   
                                                               } else {
                                                                   $author_name .= 'Author Field (Error)';
                                                               }
                                                        ?>    
                                                               <div class="wp-builder-post-author"><span class="date-format">Author: <?php echo $author_name; ?></span></div>
                                                               
                                                        <?php       
                                                           } 
                                                           
                                                           /**
                                                           * addon (author) format options 
                                                           **/
                                                           
                                                        ?>
                                                   
                                                   </div> 
                                               <?php
                                                   
                                               }
                                         
                                         }
                                    }   
                                
                                }
                                
                                /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                  * Option post area
                                  * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                **/
                                
                                $post_id         = intval( $option_post_sort_val_res );
                                $is_post_checked = is_array( $post_checked ) ? $post_checked : array();
                                
                                if( in_array($post_id, $is_post_checked ) ) {
                                    
                                    if( !empty($post_options ) ){
    
                                         foreach($post_options as $post_options_keys => $post_options_vals ){
                                                 
                                               $post_options_id =  explode( '=', $post_options_vals );
                                               $post_id_val     = intval( $post_options_id[0] );
                                               $option_id_val   = intval( $post_options_id[1] );

                                               if( $post_id_val == $post_id ){
                                                   
                                                   $get_posts = get_post( $post_id_val );
                                    ?>    

                                                   <div class="wp-builder-content">
                                                        <?php
                                                          
                                                          /**
                                                           * title options 
                                                          **/
                                                          
                                                          if( $option_id_val == 1 ){
                                                              $show_title = !empty( $options_values['show_post_title'.$post_id_val][0] ) ? intval($options_values['show_post_title'.$post_id_val][0]) : null;
                                                              $limit_title = !empty( $options_values['limit_post_title'.$post_id_val][0] ) ? intval($options_values['limit_post_title'.$post_id_val][0]) : null;

                                                              if( $show_title == 1 ){
                                                        ?>
                                                              <h1><a href="<?php echo get_permalink($post_id_val); ?>"><?php echo substr( get_the_title( $post_id_val ), 0, $limit_title ); ?></a></h1>
                                                        <?php  
                                                              }    
                                                          }
                                                        ?>
                                                        
                                                        <?php
                                                          
                                                          /**
                                                           * content options 
                                                          **/
                                                          
                                                          if( $option_id_val == 2 ){
                                                              
                                                              $show_content = isset( $options_values['show_post_content'.$post_id_val][0] ) ? intval($options_values['show_post_content'.$post_id_val][0]) : null;
                                                              $limit_content = isset( $options_values['limit_post_content'.$post_id_val][0] ) ? intval($options_values['limit_post_content'.$post_id_val][0]) : null;
                                                              $size_content = isset( $options_values['font_size_content_text'.$post_id_val][0] ) ? intval($options_values['font_size_content_text'.$post_id_val][0]) : null;
                                                              $more_content = isset( $options_values['more_post_content_text'.$post_id_val][0] ) ? trim($options_values['more_post_content_text'.$post_id_val][0]) : null;
                                                              
                                                              $content_post = get_post($post_id_val);
                                                              $content = $content_post->post_content;
                                                              $content = apply_filters('the_content', $content);
                                                              $content = str_replace(']]>', ']]&gt;', $content);
                                                        ?>
                                                              <div class="wp-builder-post-content"><?php echo substr($content, 0, $limit_content ); ?><a href="<?php echo get_permalink($post_id_val); ?>" class="more-link"><?php echo $more_content; ?></a></div>
                                                        <?php      
                                                          }
                                                          
                                                        ?>
                                                        
                                                        <?php
                                                          
                                                          /**
                                                           * image options 
                                                          **/
                                                          
                                                          if( $option_id_val == 3 ){
                                                            
                                                              $show_image = isset( $options_values['show_post_featured'.$post_id_val][0] ) ? intval($options_values['show_post_featured'.$post_id_val][0]) : null;
                                                              $size_image = isset( $options_values['image_size_select'.$post_id_val][0] ) ? intval($options_values['image_size_select'.$post_id_val][0]) : null;
                                                              $position_image = isset( $options_values['image_align_select'.$post_id_val][0] ) ? intval($options_values['image_align_select'.$post_id_val][0]) : null;
                                                              
                                                              $all_sizes = get_intermediate_image_sizes(); 
                                                              
                                                              $url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id_val), $all_sizes[$size_image] );
                                                              
                                                              if( $position_image == 1){
                                                                  $pos_image = 'left';
                                                              } else {
                                                                  $pos_image = 'right';
                                                              }
                                                              
                                                              if( $show_image == 1 ){
                                                        ?>
                                                              <div class="wp-builder-post-featured" style="text-align:<?php echo $pos_image; ?>;"><?php if(!empty($url[0])): ?><img src="<?php echo $url[0]; ?>" longdesc="URL_2" alt="Text_2" width="<?php echo $url[1]; ?>" height="<?php echo $url[2]; ?>" /><?php else: ?><span><?php echo __('No featured image uploaded.'); ?></span><?php endif; ?></div>
                                                        <?php
                                                              }
                                                          }
                                                        ?>
                                                        
                                                        <?php
                                                          
                                                          /**
                                                           * gravatar options 
                                                          **/
                                                          
                                                          if( $option_id_val == 4 ){
                                                            
                                                              $show_gravatar = isset( $options_values['show_post_gravatar'.$post_id_val][0] ) ? intval($options_values['show_post_gravatar'.$post_id_val][0]) : null;
                                                              $post_data = get_postdata($post_id_val);
                                                              $author_id = intval( $post_data['Author_ID'] );
                                                              
                                                              $gravatar_size = isset($options_values['gravatar_size_select'.$post_id_val][0]) ? intval( $options_values['gravatar_size_select'.$post_id_val][0] ) : null;
                                                              $gravatar_align = isset($options_values['gravatar_align_select'.$post_id_val][0]) ? intval( $options_values['gravatar_align_select'.$post_id_val][0] ) : null;
                                                              
                                                              if( $gravatar_align == 1 ){
                                                                  $gra_align = 'left';
                                                              } else {
                                                                  $gra_align = 'right'; 
                                                              }
                                                              
                                                              if( $show_gravatar == 1 ){
                                                        ?>
                                                        
                                                              <div class="wp-builder-post-gravatar" style="text-align:<?php echo $gra_align; ?>;"><?php echo get_avatar( $author_id, $gravatar_size, 'Mystery Man', false ); ?></div>
                                                        
                                                        <?php
                                                              }
                                                          } 
                                                        ?>
                                                        
                                                        <?php
                                                          
                                                          /**
                                                           * slider options 
                                                          **/
                                                          
                                                          if( $option_id_val == 5 ){
                                                              
                                                              $post_sliders = is_array( $options_values['browse_text_values'.$post_id_val] ) ? $options_values['browse_text_values'.$post_id_val] : array();  
                                                        ?>
                                                        
                                                             <div class="WPBuilder-Slider">
                                                                      <div class="wrapper">
                                                                            <ul>
                                                                             <?php
                                                                                 if( !empty($post_sliders)){
                                                                                      foreach($post_sliders as $post_sliders_keys => $post_sliders_vals){
                                                                              ?>
                                                                                         <li><a href="<?php echo $post_sliders_vals; ?>" title=""><img src="<?php echo $post_sliders_vals; ?>" height="40" width="40" alt="" /></a></li>
                                                                              <?php           
                                                                                      }
                                                                                 }
                                                                              ?>
                                                                            </ul>      
                                                                       </div>
                                                                       <a href = "#" onclick = "toggle()" class="arrow back">Next</a>
                                                                       <a href = "#" onclick = "toggle()" class="arrow forward">Prev</a>
                                                                </div>

                                                        <?php
                                                          }
                                                        ?>
                                                        
                                                        <?php
                                                          
                                                          /**
                                                           * addon (date) format options 
                                                          **/
                                                          
                                                          if( $option_id_val == 6 ){ 
                                                            
                                                              $date_format = isset( $options_values['date_post_format'.$post_id_val][0] ) ? trim($options_values['date_post_format'.$post_id_val][0]) : null;
                                                              $postdate = get_the_date( $date_format, $post_id_val );
                                                        ?>
                                                              <div class="wp-builder-post-date"><span class="date-format">Date: <?php echo $postdate; ?></span></div>
                                                        <?php  
                                                          }
                                                        ?>
                                                        
                                                        <?php 
                                                          
                                                          /**
                                                           * addon (category) format options 
                                                          **/
                                                          
                                                          if( $option_id_val == 7 ){ 
                                                            
                                                              $object_id = db::post_id_category_name( $post_id_val );
                                                        ?>
                                                              <div class="wp-builder-post-category"><span class="date-format">Category: <?php echo $object_id->name; ?></span></div> 
                                                        <?php
                                                          }
                                                        ?>
                                                        
                                                        <?php
                                                           
                                                           /**
                                                           * addon (category) format options 
                                                           **/
                                                           
                                                           /**
                                                           * addon (author) format options 
                                                           **/
                                                           
                                                           if( $option_id_val == 8 ){
                                                               
                                                               $post_data   = get_postdata($post_id_val);
                                                               $author_id   = intval( $post_data['Author_ID'] );
                                                               $author_name = null;
                                                               
                                                               $field = array(  
                                                                                'user_login',
                                                                                'user_pass',
                                                                                'user_nicename',
                                                                                'user_email',
                                                                                'user_url',
                                                                                'user_registered',
                                                                                'user_activation_key',
                                                                                'user_status',
                                                                                'display_name',
                                                                                'nickname',
                                                                                'first_name',
                                                                                'last_name',
                                                                                'description',
                                                                                'jabber',
                                                                                'aim',
                                                                                'yim',
                                                                                'user_level',
                                                                                'user_firstname',
                                                                                'user_lastname',
                                                                                'rich_editing',
                                                                                'comment_shortcuts',
                                                                                'admin_color',
                                                                                'plugins_per_page',
                                                                                'plugins_last_view',
                                                                                'ID' 
                                                                             );
                                                               
                                                               $author_field = !empty( $options_values['author_post_field'.$post_id_val][0] ) ? trim( $options_values['author_post_field'.$post_id_val][0] ) : "user_nicename";  
                                                               
                                                               $author_field_expl = explode(',',$author_field);

                                                               if(!empty($author_field_expl)){
                                                                   
                                                                   if( is_array($author_field_expl)){
                                                                     
                                                                       foreach($author_field_expl as $author_field_expl_keys => $author_field_expl_vals ){
                                                                          if(!empty($author_field_expl_vals)){
                                                                             $field_val =  trim( $author_field_expl_vals );
                                                                            
                                                                             if( in_array($field_val, $field ) ){
                                                                                 $author_name .= get_the_author_meta( $field_val, $author_id ) . " ";
                                                                             }
                                                                          }
                                                                       }
                                                                   }
                                                                   
                                                               } else {
                                                                   $author_name .= 'Author Field (Error)';
                                                               }
                                                        ?>    
                                                               <div class="wp-builder-post-author"><span class="date-format">Author: <?php echo $author_name; ?></span></div>
                                                               
                                                        <?php       
                                                           } 
                                                           
                                                           /**
                                                           * addon (author) format options 
                                                           **/
                                                           
                                                        ?>
                                                   </div>
                                    <?php               
                                               }
                                                    
                                         } 
                                    }
                                    
                                }
                       } 
                  
                  }
                
            }
        
       }
    
   }    
    
?>