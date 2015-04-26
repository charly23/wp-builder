
<?php global $_wp_additional_image_sizes; ?>

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
          <?php if( isset($option_value['show_post_featured'])){ ?>
                    <?php if( intval($option_value['show_post_featured']) == 1 ): $checked = 'checked'; endif ?>
          <?php } else { ?>
                    <?php $checked = ''; ?>
          <?php } ?>
          <?php $show_post_featured = array( 
                                             'name' => 'show_post_featured', 
                                             'value' => isset( input::post_is_object()->show_post_featured ) ? intval( input::post_is_object()->show_post_featured ) : 1,
                                             'id' => 'show_post_featured_id',
                                             'class' => 'show_post_featured_class',
                                             'checked' => $checked,
                                         );
                        
                echo input::checkbox( $show_post_featured );  
           ?>
           <?php echo html::label(array( 'text' => ' Show Post Featured', 'for' => 'description' )); ?>
       </td>
   </tr>
   <tr class="label">
       <td>
           <?php
              $all_sizes = get_intermediate_image_sizes(); 
           ?>  
           <?php echo html::label(array( 'text' => 'Image Size ', 'for' => 'description' )); ?>
           <?php $image_size = isset($option_value['image_size_select']) ? $option_value['image_size_select'] : null; ?>
           <?php echo html::select( array('name' => 'image_size_select', 'id' => 'image_size_select_id'), $all_sizes, $image_size,  'Size' ); ?>
       <td>
   </tr>
   <tr>
      <td>   
          <?php echo html::label(array( 'text' => 'Image Alignment ', 'for' => 'description' )); ?>
          <?php $image_align = isset($option_value['image_align_select']) ? intval($option_value['image_align_select']) : null; ?>
          <?php echo html::select( array('name' => 'image_align_select', 'id' => 'image_align_select_id'), array( 1 => 'Left', 2 => 'Right' ), $image_align,  'Align' ); ?> 
       </td>
   </tr>
</table>