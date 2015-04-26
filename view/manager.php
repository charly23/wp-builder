<?php
$icon_title = "Option Manager";
$icon_label = "";
?>

<?php echo html::icon_logo( $icon_title, $icon_label, false ); ?>

<?php echo input::form_open(array( 'method' => 'post')); ?>

<script type="text/javascript">
jQuery(function(){ 
         
     jQuery("input.quick_update_option_class").click(function(e){
             e.preventDefault();
             
             var field = jQuery(this).parent().prev().html();
             
             alert( field );
             
     });
          
});
</script>

<div id="form-action">
<?php
   $add = array( 'name' => 'add_option', 'value' => 'Add New Options', 'id' => 'add_option_id', 'class' => 'add_option_class' );                  
   echo input::submit( $add );
       
   $del = array( 'name' => 'delete_option', 'value' => 'Delete', 'id' => 'del_option_id', 'class' => 'del_option_class' );                  
   echo input::submit( $del );
?>
</div>

<?php

 $tab1_array = array( input::checkbox( array( 'name' => 'delete_option_val[]', 'class' => 'delete_option_val', 'id' => 'delete_option_val' ) ), 'Name', 'Description', 'Options', 'Action' );
            
 $field_array = array();
 
 $quick_array = array();
 
 $sql = db::querys('builder_option', 'desc' );
 
 $quick_update_option = array( 'name' => 'quick_update_option', 'value' => 'Update', 'id' => 'quick_update_option_id', 'class' => 'quick_update_option_class' );   
 
 $cat = db::terms();
 if(!empty($cat)){
    foreach( $cat as $cat_key => $cat_val ){
        if( !empty($cat_val)){
             $cat_array[$cat_val->term_id] = $cat_val->name;   
        }
    }
 }
 
 if( !empty($sql) ){
      
      foreach($sql as $sql_key => $sql_val){
           
           $option_id = intval( $sql_val->id );
           
           $options = unserialize( $sql_val->options );
           if(!empty($options)){
               $options_var = $options;
           }
           
           /** $quick_array[] = '<div class="option_form_quick_field">
                                    <div class="option_form_quick_input">
                                         <div class="option_form_post"> 
                                             <table id="option-form-field-table">
                                               <tr class="label">
                                                   <td>'.html::label(array( 'text' => 'Category ', 'for' => 'description' )).'</td>
                                                   <td>'.html::select(array('name' => 'post_category', 'id' => 'post_category_id'), $cat_array, $options_var['post_category'],  'All' ).'</td>
                                               </tr>
                                               <tr class="label">
                                                   <td>'.html::label(array( 'text' => 'Number of Posts to Show ', 'for' => 'description' )).'</td>   
                                                   <td>'.input::text(array( 'name' => 'number_of_post', 'value' => $options_var['number_of_post'], 'id' => 'number_of_post_id', 'class' => 'number_of_post_class', 'maxlength' => 50 ) ).'</td>
                                               </tr>
                                               <tr class="label">
                                                   <td>'.html::label(array( 'text' => 'Sort By ', 'for' => 'description' )).'</td> 
                                                   <td>'.html::select(array('name' => 'post_sort', 'id' => 'post_sort_id'), array( 'DESC' => 'Descending (3, 2, 1)', 'ASC' => 'Ascending (1, 2, 3)'),  $options_var['post_sort'],  '' ).'</td>
                                               </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="option_form_quick_submit">'.input::custom_submit( $quick_update_option ).'</div>
                                 </div>'; **/
           
           $quick_array[] = '<div class="option_form_quick_field"><div class="option_form_quick_input"><div class="option_form_post"></div></div></div>';
           
           $option_html = '<div class="option_form_quick_content">
                                 <div class="option_form_quick_action">
                                      <span>Quick Edit</span><span class="option-arrow"></span>
                                 </div>
                           </div>';
           
           $field_array[] = array( 'delete' => input::checkbox( array( 'value' => $option_id, 'name' => 'delete_option_checked[]', 'class' => 'delete_option_checked', 'id' => 'delete_option_checked' ) ),
                                   'name' => '<a href="admin.php?page=add_new_option_wp_builder&oid='.$option_id.'">'.$sql_val->title.'</a>', 
                                   'description' => $sql_val->description,  
                                   'option' => $option_html, 
                                   'edit' => '<a href="admin.php?page=add_new_option_wp_builder&&oid='.$option_id.'" class="option-action-edit"></a>' );
      }
      
 }
 
 $tab2_array = $field_array;
        
 echo html::table_list( array( 'id' => 'form_list' ), $tab1_array, $tab2_array, $quick_array );       
       
?>       

<?php echo input::form_close(); ?>