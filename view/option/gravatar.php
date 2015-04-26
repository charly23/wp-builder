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
          <?php if( isset($option_value['show_post_gravatar'])){ ?>
                    <?php if( intval($option_value['show_post_gravatar']) == 1 ): $checked = 'checked'; endif ?>
          <?php } else { ?>
                    <?php $checked = ''; ?>
          <?php } ?>
          <?php $show_post_gravatar = array( 
                                             'name' => 'show_post_gravatar', 
                                             'value' => isset( input::post_is_object()->show_post_gravatar ) ? intval( input::post_is_object()->show_post_gravatar ) : 1,
                                             'id' => 'show_post_gravatar_id',
                                             'class' => 'show_post_gravatar_class',
                                             'checked' => $checked,
                                         );
                        
                echo input::checkbox( $show_post_gravatar );  
           ?>
           <?php echo html::label(array( 'text' => ' Show Post Gravatar', 'for' => 'description' )); ?>
           
       </td>
   </tr>
   <tr class="label">
       <td>
       
           <?php echo html::label(array( 'text' => 'Gravatar Size ', 'for' => 'description' )); ?>
           <?php $gravatar_size = isset($option_value['gravatar_size_select']) ? $option_value['gravatar_size_select'] : null; ?>
           <?php echo html::select( array('name' => 'gravatar_size_select', 'id' => 'gravatar_size_select_id'), array( 45 => 'Small (45px)', 65 => 'Medium (65px)', 85 => 'Large (85px)', 125 => 'Extra Large (125px)' ), $gravatar_size,  'Size' ); ?>
       <td>
   </tr>
   <tr>
      <td>    
          <?php echo html::label(array( 'text' => 'Gravatar Alignment ', 'for' => 'description' )); ?>
          <?php $gravatar_align = isset($option_value['gravatar_align_select']) ? $option_value['gravatar_align_select'] : null; ?>
          <?php echo html::select( array('name' => 'gravatar_align_select', 'id' => 'gravatar_align_select_id'), array( 1 => 'Left', 2 => 'Right' ), $gravatar_align,  'Align' ); ?> 
       </td>
   </tr>

</table>