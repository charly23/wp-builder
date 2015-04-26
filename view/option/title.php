<?php $oid = isset(input::get_is_object()->oid) ? intval( input::get_is_object()->oid ) : null; ?>
<?php
   if(intval($oid)){
      $sql_row = db::query_rows('bulder_option', "WHERE id=$oid", 'desc');
      if(!empty($sql_row)){
          $option_value = unserialize($sql_row->options);
      }
   } else {
      $option_value = array();
   }
?>
<table id="option-form-field-table">
   <tr class="label">
       <td>
          <?php if( isset($option_value['show_post_title'])){ ?>
                    <?php if( intval($option_value['show_post_title']) == 1 ): $checked = 'checked'; endif ?>
          <?php } else { ?>
                    <?php $checked = ''; ?>
          <?php } ?>
          <?php $show_post_title = array( 
                                             'name' => 'show_post_title', 
                                             'value' => isset( input::post_is_object()->show_post_title ) ? intval(input::post_is_object()->show_post_title) : !empty($option_value['show_post_title']) ? intval($option_value['show_post_title']) : 1,
                                             'id' => 'show_post_title_id',
                                             'class' => 'show_post_title_class',
                                             'checked' => $checked,
                                         );
                        
                echo input::checkbox( $show_post_title );  
           ?>
           <?php echo html::label(array( 'text' => ' Show Post Title', 'for' => 'description' )); ?>
           
       </td>
   </tr>
   <tr class="label">
       <td>
           <?php echo html::label(array( 'text' => 'Limit Content to ', 'for' => 'description' )); ?>
           
           <?php
                if( isset( input::post_is_object()->limit_post_title ) ) {
                    if(!empty(input::post_is_object()->limit_post_title)):
                        $limit_post_title_var = intval( input::post_is_object()->limit_post_title );
                    else:
                        $limit_post_title_var = 0;
                    endif;
                } else {
                    if( !empty($option_value['limit_post_title']) ):
                        $limit_post_title_var = intval($option_value['limit_post_title']);
                    else:
                        $limit_post_title_var = 100; 
                    endif;
                }      
                      
           ?>
           <?php $limit_post_title = array( 
                                             'name' => 'limit_post_title', 
                                             'value' => $limit_post_title_var,
                                             'id' => 'limit_post_title_id',
                                             'class' => 'limit_post_title_class',
                                             'maxlength' => 50,
                                         );
                        
                 echo input::text( $limit_post_title );  
           ?>
           <?php echo html::label(array( 'text' => ' Characters', 'for' => 'description' )); ?>
           
       </td>
   </tr>
   <tr class="label">
       <td>
       
          <?php echo html::label(array( 'text' => 'Font Size ', 'for' => 'description' )); ?>
          <?php
               if( isset( input::post_is_object()->font_size_text_title ) ){
                   if( !empty( input::post_is_object()->font_size_text_title ) ):
                       $font_size_text_title_var = trim( input::post_is_object()->font_size_text_title );
                   else:
                       $font_size_text_title_var = '';
                   endif;
               } else {
                   if( !empty($option_value['font_size_text_title']) ):
                       $font_size_text_title_var = trim($option_value['font_size_text_title']);
                   else:
                       $font_size_text_title_var = '12px';
                   endif;
               }  
          ?>
          <?php $font_size_text_title = array( 
                                                 'name' => 'font_size_text_title', 
                                                 'value' => $font_size_text_title_var,
                                                 'id' => 'font_size_text_title_id',
                                                 'class' => 'font_size_text_title_class',
                                                 'maxlength' => 50,
                                             );
                        
                echo input::text( $font_size_text_title );  
          ?>
          
          <?php echo html::label(array( 'text' => 'More Text', 'for' => 'description' )); ?>
          <?php
                if( isset( input::post_is_object()->more_post_text_content ) ){
                    if(!empty(input::post_is_object()->more_post_text_content)):
                       $more_post_text_content_var = trim( input::post_is_object()->more_post_text_content );
                    else:
                       $more_post_text_content_var = ''; 
                    endif;
                } else {
                    if( !empty($option_value['more_post_text_content']) ):
                        $more_post_text_content_var = trim($option_value['more_post_text_content']);
                    else:
                        $more_post_text_content_var = 'More Text';
                    endif;
                } 
          ?>
          <?php $more_post_text_content = array( 
                                                 'name' => 'more_post_text_content', 
                                                 'value' => $more_post_text_content_var,
                                                 'id' => 'more_post_text_content_id',
                                                 'class' => 'more_post_text_content_class',
                                                 'maxlength' => 50,
                                             );
                        
                echo input::text( $more_post_text_content );  
           ?>
           
       </td>
   </tr>
   <tr> 
       <td></td> 
   </tr>

</table>