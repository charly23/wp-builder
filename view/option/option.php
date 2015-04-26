
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
       <td><?php echo html::label(array( 'text' => 'Title ', 'for' => 'description' )); ?></td>
   </tr>
   <tr>
       <td>
       <?php $option_title = array( 
                                      'name' => 'option_title', 
                                      'value' => isset( input::post_is_object()->option_title ) ? intval( input::post_is_object()->option_title ) : !empty($option_value['option_title']) ? $option_value['option_title'] : null,
                                      'id' => 'option_title_id',
                                      'class' => 'option_title_class',
                                      'maxlength' => 50,
                                  );
                                    
          echo input::text( $option_title );
       ?>
       <?php if( isset( input::post_is_object()->option_title ) ){ if( empty(input::post_is_object()->option_title)){ 
                 if( strlen( input::post_is_object()->option_title ) >=0 ){ ?>
                     <?php if( is_string(input::post_is_object()->option_title) AND !is_null(input::post_is_object()->option_title)): ?> <span class="required"> * Required Field</span><?php endif; ?>
       <?php } } } ?>
       </td>
   </tr>
   <tr class="label">
       <td><?php echo html::label(array( 'text' => 'Description ', 'for' => 'description' )); ?></td>
   </tr>
   <tr>
       <td>
       <?php $option_descr = array( 
                                      'name' => 'option_descr', 
                                      'text' => isset( input::post_is_object()->option_descr ) ? trim( input::post_is_object()->option_descr ) : !empty($option_value['option_descr']) ? $option_value['option_descr'] : null,
                                      'id' => 'option_descr_id',
                                      'class' => 'option_descr_class',
                                  );
                                    
          echo html::textarea( $option_descr );
       ?>
       </td>
   </tr>
   <tr class="label">
       <td><?php echo html::label(array( 'text' => 'Width ', 'for' => 'description' )); ?></td>
   </tr>
   <tr>
       <td>
       <?php $option_width = array( 
                                      'name' => 'option_width', 
                                      'value' => isset( input::post_is_object()->option_width ) ? intval( input::post_is_object()->option_width ) : !empty($option_value['option_width']) ? $option_value['option_width'] : null,
                                      'id' => 'option_width_id',
                                      'class' => 'option_width_class',
                                      'maxlength' => 50,
                                  );
                                    
          echo input::text( $option_width );
       ?>
       </td>
   </tr>
</table>


<?php
      
?>