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
<?php
   $cat = db::terms();
   if(!empty($cat)){
       foreach( $cat as $cat_key => $cat_val ){
            if( !empty($cat_val)){
                 $cat_array[$cat_val->term_id] = $cat_val->name;   
            }
       }
   }
?>
<table id="option-form-field-table">
   <tr class="label">
       <td>
           <?php echo html::label(array( 'text' => 'Category ', 'for' => 'description' )); ?>
       </td>
   </tr>
   <tr>    
       <td>
           <?php $post_category = isset($option_value['post_category']) ? $option_value['post_category'] : null; ?>
           <?php echo html::select( array('name' => 'post_category', 'id' => 'post_category_id'), $cat_array, $post_category,  'All' ); ?>
           
           <?php echo html::label(array( 'text' => 'Number of Posts to Show ', 'for' => 'description' )); ?>
           <?php $number_of_post = isset($option_value['number_of_post']) ? $option_value['number_of_post'] : 1; ?>
           <?php $num_of_post = array( 
                                         'name' => 'number_of_post', 
                                         'value' => isset( input::post_is_object()->number_of_post ) ? intval( input::post_is_object()->number_of_post ) : $number_of_post,
                                         'id' => 'number_of_post_id',
                                         'class' => 'number_of_post_class',
                                         'maxlength' => 50,
                                     );
                        
                 echo input::text( $num_of_post );  
           ?>
           <script type="text/javascript">
             jQuery(function(){
                   
                    jQuery("a#load-post-content-id").click(function(){
                              
                              var num_post = jQuery("input#number_of_post_id").val();
                              
                              var html_val = '';
                              
                              for( var i=1; i < parseInt(num_post)+1; i++){
                                   
                                   html_val += '<div id="option-form" class="option-form option-form-sort post-sort-area post-selected-item post-id'+i+'" style="display: block;">';
                                   html_val += '<div id="option-form-label" class="option-form-label">';
                                   html_val += '<span class="option-label option-label-sort-icon"><label for="description">Untitle Post '+i+'</label></span>';
                                   html_val += '<span class="option-luck optin-luck-icon"></span>';
                                   html_val += '<span class="option-arrow"><input id="post_field_option_id" class="post_field_option_id" type="hidden" value="'+i+'" name="option_post_sort_id[]"></span>';
                                   html_val += '</div>';
                                   html_val += '<div id="option-form-field" class="option-form-field ui-sortable" style=""></div>';
                                   html_val += '</div>';
                                        
                              }
                              
                              jQuery("div#option-form-post-manager div.option-form-content").html( html_val );
                              
                              return false;
                               
                    });
                   
             });   
           </script>
           <a href="#" class="load-post-content" id="load-post-content-id"></a>
       </td> 
   </tr>
   <tr class="label">
       <td><?php echo html::label(array( 'text' => 'Sort By ', 'for' => 'description' )); ?></td>
   </tr>
   <tr> 
       <td>
          <?php $post_sort = isset($option_value['post_sort']) ? $option_value['post_sort'] : null; ?>
          <?php echo html::select( array('name' => 'post_sort', 'id' => 'post_sort_id'), array( 'DESC' => 'Descending (3, 2, 1)', 'ASC' => 'Ascending (1, 2, 3)'), $post_sort,  'Sort' ); ?>
       </td> 
   </tr>

</table>