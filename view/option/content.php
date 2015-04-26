<?php $oid = isset(input::get_is_object()->oid) ? intval( input::get_is_object()->oid ) : null; ?>
<?php
   if( intval($oid)){
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
          <?php if( isset($option_value['show_post_content'])){ ?>
                    <?php if( intval($option_value['show_post_content']) == 1 ): $checked = 'checked'; endif ?>
          <?php } else { ?>
                    <?php $checked = ''; ?>
          <?php } ?>
          <?php $show_post_content = array( 
                                             'name' => 'show_post_content', 
                                             'value' => !empty( input::post_is_object()->show_post_content ) ? intval( input::post_is_object()->show_post_content ) : !empty($option_value['show_post_content']) ? intval($option_value['show_post_content']) : 1,
                                             'id' => 'show_post_title_id',
                                             'class' => 'show_post_title_class',
                                             'checked' => $checked,
                                         );
                        
                echo input::checkbox( $show_post_content );  
           ?>
           <?php echo html::label(array( 'text' => ' Show Post Content', 'for' => 'description' )); ?>
       </td>
   </tr>
   <tr class="label">
       <td>
           <?php echo html::label(array( 'text' => 'Limit Content to ', 'for' => 'description' )); ?>
           <?php
                 if( isset( input::post_is_object()->limit_post_content ) ){
                     if( !empty(input::post_is_object()->limit_post_content) ):
                          $limit_post_content_var = intval( input::post_is_object()->limit_post_content);
                     else:
                          $limit_post_content_var = '';
                     endif;
                 } else {
                     if( !empty($option_value['limit_post_content']) ):
                          $limit_post_content_var = intval( $option_value['limit_post_content']);
                     else:
                          $limit_post_content_var = 100;
                     endif;
                 }
           ?> 
           <?php $limit_post_content = array( 
                                         'name' => 'limit_post_content', 
                                         'value' => $limit_post_content_var,
                                         'id' => 'limit_post_title_id',
                                         'class' => 'limit_post_title_class',
                                         'maxlength' => 50,
                                     );
                        
                 echo input::text( $limit_post_content );  
           ?>
           <?php echo html::label(array( 'text' => ' Characters', 'for' => 'description' )); ?>
       </td>
   </tr>
   <tr class="label">
       <td>
       
           <?php echo html::label(array( 'text' => 'Font Size ', 'for' => 'description' )); ?>
           <?php
                 if( isset( input::post_is_object()->font_size_content_text ) ){
                     if( !empty(input::post_is_object()->font_size_content_text) ):
                          $font_size_content_text_var = trim(input::post_is_object()->font_size_content_text);
                     else:
                          $font_size_content_text_var = '';
                     endif;
                 } else {
                     if( !empty($option_value['font_size_content_text']) ):
                         $font_size_content_text_var = trim( $option_value['font_size_content_text'] );
                     else:
                         $font_size_content_text_var = '12px';
                     endif;
                 } 
           ?> 
           <?php $font_size_content_text = array( 
                                                 'name' => 'font_size_content_text', 
                                                 'value' => $font_size_content_text_var,
                                                 'id' => 'font_size_content_text_id',
                                                 'class' => 'font_size_content_text_class',
                                                 'maxlength' => 50,
                                             );
                        
                echo input::text( $font_size_content_text );  
          ?>
          
          <?php echo html::label(array( 'text' => 'More Text', 'for' => 'description' )); ?>
          <?php
                 if( isset( input::post_is_object()->more_post_content_text ) ){
                     if( !empty(input::post_is_object()->more_post_content_text) ):
                          $more_post_content_text_var = trim(input::post_is_object()->more_post_content_text);
                     else:
                          $more_post_content_text_var = '';
                     endif;
                 } else {
                     if( !empty($option_value['more_post_content_text']) ):
                         $more_post_content_text_var = trim( $option_value['more_post_content_text'] );
                     else:
                         $more_post_content_text_var = '12px';
                     endif;
                 } 
           ?> 
          <?php $more_post_content_text = array( 
                                                 'name' => 'more_post_content_text', 
                                                 'value' => $more_post_content_text_var,
                                                 'id' => 'more_post_content_text_id',
                                                 'class' => 'more_post_content_text_class',
                                                 'maxlength' => 50,
                                             );
                        
                echo input::text( $more_post_content_text );  
           ?>
           
       </td>
   </tr>

   <tr> 
       <td></td> 
   </tr>

</table>