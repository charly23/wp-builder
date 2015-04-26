<?php $oid = isset(input::get_is_object()->oid) ? intval( input::get_is_object()->oid ) : null; ?>
<?php
      if( intval($oid)){
        
          $sql_row = db::query_rows('bulder_option', "WHERE id=$oid", 'desc');
          if(!empty($sql_row)){
                  $option_value = unserialize($sql_row->options);
                  $post_value = unserialize($sql_row->post_options);
                  $post_checked = unserialize($sql_row->post_checked);
          }
          
      } else {
        
          $option_value = array();
          $post_value = array();
          
          $post_checked = array();
          
          /** $posts_sql_default = db::posts_execute('desc');
          if(!empty($posts_sql_default)){
              foreach($posts_sql_default as $posts_sql_default_keys => $posts_sql_default_vals){
                   if( intval($posts_sql_default_vals->ID)){
                       $post_checked[] = intval($posts_sql_default_vals->ID);
                   }
              }
          } **/
          
      }
?>

<div class="option-form-content">

<?php $posts_sql = db::posts_execute('desc'); ?>

<?php
     $option_post_sort_val = isset( $option_value['option_post_sort_id'] ) ? $option_value['option_post_sort_id'] : array();
     
     if( empty( $oid ) ){
        
     if( !empty($posts_sql)){

           foreach($posts_sql as $posts_sql_keys => $posts_sql_res ){
            
            if( intval($posts_sql_res->ID) ){ 
?>
            <div id="option-form" class="option-form option-form-sort post-sort-area post-selected-item post-id<?php echo $posts_sql_res->ID; ?>">
                <div id="option-form-label" class="option-form-label"> 
                    <span class="option-label option-label-sort-icon"><?php echo html::label(array( 'text' => get_the_title( $posts_sql_res->ID  ), 'for' => 'description' )); ?></span>
                    <span class="option-luck optin-luck-icon"></span>
                    <span class="option-arrow">
                    <?php $option_post_sort_id = array( 'name' => 'option_post_sort_id[]', 'value' => intval($posts_sql_res->ID), 'id' => 'post_field_option_id', 'class' => 'post_field_option_id' );          
                        echo input::hidden( $option_post_sort_id ); ?>
                    </span>
                </div>
                <div id="option-form-field" class="option-form-field"></div>
            </div>     
<?php       }    
         }          
     }
?>

<?php } else { ?>

<?php if( !empty( $option_post_sort_val ) ){
    
    foreach( $option_post_sort_val as $option_post_sort_val_key => $option_post_sort_val_res ){
    
    /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
      * Sticky post area
      * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
    **/
    
    $post_sort_val = explode( "=", $option_post_sort_val_res );
    
    if( is_array($post_sort_val)){
        
        if( $post_sort_val[0] == 0 ){

    ?>
            <div id="post-stick-form" class="option-form-sort post-stick-content">
                <div id="post-stick-form-label" class="post-stick-form-label option-form-label">
                    <?php $posts_title = is_object( db::posts( intval($post_sort_val[1] ) ) ) ? db::posts( intval($post_sort_val[1] ) )->post_title : 'Sticky Post'; ?>
                    <span class="post-stick-label post-stick-label-sort-icon"><?php echo html::label(array( 'text' => $posts_title, 'for' => 'description' )); ?></span>
                    <span class="option-luck optin-luck-icon"></span>
                    <span class="option-arrow"><input id="post_field_option_id" class="post_field_option_id" type="hidden" name="option_post_sort_id[]" value="<?php echo $post_sort_val[0]; ?>=<?php echo intval($post_sort_val[1]); ?>"/></span> 
                    <?php $post_field_sticky_id = array( 'name' => 'post_field_stick_id[]', 'value' => '0', 'id' => 'post_field_stick_id', 'class' => 'post_field_stick_id' );          
                         echo input::hidden( $post_field_sticky_id );  
                    ?>
                </div>
                <div id="post-stick-form-field" class="option-form-field post-stick-form-field">
                    <div id="post-select-filter" class="post-select-filter">  
                        <?php echo html::label(array( 'text' => 'Posts', 'for' => 'description' )); ?>
                        <select class="post-select-filter" name="post_select[]" id="post-select-filter">
                             <option>Select...</option>
                             <?php
                                  $posts_sql_filter = db::posts_execute('desc');
                                  if(!empty($posts_sql_filter)){
                                      foreach($posts_sql_filter as $posts_sql_filter_keys => $posts_sql_filter_vals ){
                                        
                                            $posts_id = intval($posts_sql_filter_vals->ID);
                                            $posts_is_selected = $posts_id == intval($post_sort_val[1]) ? 'selected="selected"' : null;
                                  ?>           
                                            <option value="<?php echo $posts_id; ?>" <?php echo $posts_is_selected; ?> ><?php echo get_the_title($posts_id); ?></option>
                                  <?php         
                                      }
                                  }
                             ?>
                        </select>  
                        <?php echo html::label(array( 'text' => 'Select a post filter', 'for' => 'description' )); ?>
                    </div>
                    <?php
                         
                         if(!empty($post_value)){
                             foreach($post_value as $post_value_keys => $post_value_res){
                                
                                  $post_val = explode("=",$post_value_res);
                                  $post_val1 = intval( $post_val[1] );
                                  $post_val2 = intval( $post_val[2] );
                                  
                                  if( $post_val1 == $post_sort_val[1] ){
                                     
                                  if( $post_val[0] == 0 ){
                                      
                                      $post_val3 = ( $post_val[0]."=".$post_val1);
                                      
                                      if( $post_val2 == 1 ){

                                      ?>
                                          
                                          <div id="post-option-form" class="post-option-content" style="">
                                            <div id="post-option-form-label" class="post-option-form-label" style="width: 268px;">
                                                <span class="post-option-label post-option-label-sort-icon"><label for="description"><?php echo __('Header Title'); ?></label></span>
                                                <input id="post_field_option_id" class="post_field_option_id_val" type="hidden" value="<?php echo $post_val[0]; ?>=<?php echo $post_val1; ?>=1" name="post_field_option_id_val[]"/>
                                                <span class="post-remove-icon post-remove-icon-selected"></span>
                                                <span class="post-option-arrow post-optin-arrow-selected"></span>
                                            </div>
                                            <div id="post-option-form-field" class="post-option-form-field" style="width: 290px;">
                                                <table id="option-form-field-table">
                                                    <tbody>
                                                        <tr class="label">
                                                            <td>
                                                               <?php
                                                               $title_show_is_checked = isset( $option_value['show_post_title'.$post_val3][0] ) ? intval( $option_value['show_post_title'.$post_val3][0] ) == 1 ? "checked=''" : "" : null;  
                                                               ?>
                                                               <input id="show_post_title_id" class="show_post_title_class<?php echo $post_val3; ?>" type="checkbox" <?php echo $title_show_is_checked; ?>  name="show_post_title<?php echo $post_val3; ?>[]" value="1"/>
                                                               <label for="description"> <?php echo __('Show Post Title'); ?></label>
                                                            </td>
                                                        </tr>
                                                        <tr class="label">
                                                            <td>
                                                                <label for="description"><?php echo __('Limit Content to '); ?></label>
                                                                <?php
                                                                $post_limit = isset( $option_value['limit_post_title'.$post_val3][0] ) ? trim($option_value['limit_post_title'.$post_val3][0] ) : null;  
                                                                ?>
                                                                <input id="limit_post_title_id" class="limit_post_title_class<?php echo $post_val3; ?>" type="text" name="limit_post_title<?php echo $post_val3; ?>[]" value="<?php echo $post_limit; ?>" maxlength="50"/>
                                                                <label for="description"> <?php echo __('Characters'); ?></label>
                                                            </td>
                                                        </tr>
                                                        <tr class="label">
                                                            <td>
                                                                <label for="description"><?php echo __('Font Size '); ?></label>
                                                                <?php
                                                                $post_size = isset( $option_value['font_size_text_title'.$post_val3][0] ) ? trim($option_value['font_size_text_title'.$post_val3][0] ) : null;  
                                                                ?>
                                                                <input id="font_size_text_title_id" class="font_size_text_title_class<?php echo $post_val3; ?>" type="text" name="font_size_text_title<?php echo $post_val3; ?>[]" value="<?php echo $post_size; ?>" maxlength="50"/>
                                                                <label for="description"><?php echo __('More Text'); ?></label>
                                                                <?php
                                                                $post_more = isset( $option_value['more_post_text_content'.$post_val3][0] ) ? trim($option_value['more_post_text_content'.$post_val3][0] ) : null;  
                                                                ?>
                                                                <input id="more_post_text_content_id" class="more_post_text_content_class<?php echo $post_val3; ?>" type="text" name="more_post_text_content<?php echo $post_val3; ?>[]" value="<?php echo $post_more; ?>" maxlength="50"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                        <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                         
                                      <?php
                                      }
                                      
                                      if( $post_val2 == 2 ){
                                      ?>
                                         
                                         <div id="post-option-form" class="post-option-content" style="">
                                            <div id="post-option-form-label" class="post-option-form-label" style="width: 268px;">
                                                <span class="post-option-label post-option-label-sort-icon"><label for="description"><?php echo __('HTML Content'); ?></label></span>
                                                <input id="post_field_option_id" class="post_field_option_id_val" type="hidden" name="post_field_option_id_val[]" value="<?php echo $post_val[0]; ?>=<?php echo $post_val1; ?>=2"/>
                                                <span class="post-remove-icon post-remove-icon-selected"></span>
                                                <span class="post-option-arrow post-optin-arrow-selected"></span>
                                            </div>
                                            <div id="post-option-form-field" class="post-option-form-field" style="width: 290px;">
                                                <table id="option-form-field-table">
                                                <tbody>
                                                    <tr class="label">
                                                        <td>
                                                            <?php
                                                            $content_show_is_checked = isset( $option_value['show_post_content'.$post_val3][0] ) ? intval( $option_value['show_post_content'.$post_val3][0] ) == 1 ? "checked=''" : "" : null;  
                                                            ?>
                                                            <input id="show_post_content_id" class="show_post_content_class<?php echo $post_val1; ?>" type="checkbox" <?php echo $content_show_is_checked; ?>  name="show_post_content<?php echo $post_val3; ?>[]" value="1"/>
                                                            <label for="description"> <?php echo __('Show Post Content'); ?></label>
                                                        </td>
                                                    </tr>
                                                    <tr class="label">
                                                        <td>
                                                            <label for="description"><?php echo __('Limit Content to '); ?></label>
                                                            <?php
                                                            $content_limit = isset( $option_value['limit_post_content'.$post_val3][0] ) ? trim($option_value['limit_post_content'.$post_val3][0] ) : null;  
                                                            ?>
                                                            <input id="limit_post_content_id" class="limit_post_content_class<?php echo $post_val3; ?>" type="text"  name="limit_post_content<?php echo $post_val3; ?>[]" value="<?php echo $content_limit; ?>" maxlength="50"/>
                                                            <label for="description"> <?php echo __('Characters'); ?></label>
                                                        </td>
                                                    </tr>
                                                    <tr class="label">
                                                        <td>
                                                            <label for="description"><?php echo __('Font Size '); ?></label>
                                                            <?php
                                                             $content_size = isset( $option_value['font_size_content_text'.$post_val3][0] ) ? trim($option_value['font_size_content_text'.$post_val3][0] ) : null;  
                                                            ?>
                                                            <input id="font_size_content_text_id" class="font_size_content_text_class<?php echo $post_val3; ?>" type="text" name="font_size_content_text<?php echo $post_val3; ?>[]" value="<?php echo $content_size; ?>" maxlength="50"/>
                                                            <label for="description"><?php echo __('More Text'); ?></label>
                                                            <?php
                                                            $content_more = isset( $option_value['more_post_content_text'.$post_val3][0] ) ? trim($option_value['more_post_content_text'.$post_val3][0] ) : null;  
                                                            ?>
                                                            <input id="more_post_content_text_id" class="more_post_content_text_class<?php echo $post_val3; ?>" type="text" name="more_post_content_text<?php echo $post_val3; ?>[]" value="<?php echo $content_more; ?>" maxlength="50"/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                       <td></td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </div>
                                         </div>       
                                            
                                      <?php  
                                      }
                                      
                                      if( $post_val2 == 3 ){
                                      ?>  
                                          
                                          <div id="post-option-form" class="post-option-content" style="">
                                                <div id="post-option-form-label" class="post-option-form-label" style="width: 270px;">
                                                    <span class="post-option-label post-option-label-sort-icon"><label for="description"><?php echo __('Images'); ?></label></span>
                                                    <input id="post_field_option_id" class="post_field_option_id_val" type="hidden" value="<?php echo $post_val[0]; ?>=<?php echo $post_val1; ?>=3" name="post_field_option_id_val[]"/>
                                                    <span class="post-remove-icon post-remove-icon-selected"></span>
                                                    <span class="post-option-arrow post-optin-arrow-selected"></span>
                                                </div>
                                                <div id="post-option-form-field" class="post-option-form-field" style="width: 292px;">
                                                    <table id="option-form-field-table">
                                                        <tbody>
                                                            <tr class="label">
                                                                <td>
                                                                    <?php
                                                                    $featured_show_is_checked = isset( $option_value['show_post_featured'.$post_val3][0] ) ? intval( $option_value['show_post_featured'.$post_val3][0] ) == 1 ? "checked=''" : "" : null;  
                                                                    ?>
                                                                    <input id="show_post_featured_id" class="show_post_featured_class<?php echo $post_val3; ?>" type="checkbox" <?php echo $featured_show_is_checked; ?>  name="show_post_featured<?php echo $post_val3; ?>[]" value="1"/>
                                                                    <label for="description"> <?php echo __('Show Post Featured'); ?></label>
                                                                </td>
                                                            </tr>
                                                            <tr class="label">
                                                                <td>
                                                                    <?php
                                                                    $featured_size = isset( $option_value['image_size_select'.$post_val3][0] ) ? trim($option_value['image_size_select'.$post_val3][0] ) : null;  
                                                                    ?>
                                                                    <label for="description">Image Size </label>
                                                                    <select id="image_size_select_id" name="image_size_select<?php echo $post_val3; ?>[]" class="image_size_select_class<?php echo $post_val3; ?>">
                                                                        <option>Select Size</option>
                                                                        <?php
                                                                          $all_sizes = get_intermediate_image_sizes(); 
                                                                        ?>
                                                                        <?php if( !empty($all_sizes)){ 
                                                                                  foreach($all_sizes as $all_sizes_keys => $all_sizes_vals){
                                                                                    
                                                                                  $featured_size_checked = $all_sizes_keys == $featured_size ? "selected=''" : null; 
                                                                        ?>
                                                                                  <option value="<?php echo intval($all_sizes_keys); ?>" <?php echo $featured_size_checked; ?> ><?php echo $all_sizes_vals; ?></option>
                                                                        <?php } 
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <?php
                                                                    $featured_align = isset( $option_value['image_align_select'.$post_val3][0] ) ? trim($option_value['image_align_select'.$post_val3][0] ) : null;  
                                                                    ?>
                                                                    <label for="description"><?php echo __('Image Alignment '); ?></label>
                                                                    <select id="image_align_select_id" name="image_align_select<?php echo $post_val3; ?>[]" class="image_align_select_class<?php echo $post_val3; ?>">
                                                                    <option>Select Align</option>
                                                                    <?php
                                                                       $featured_align_array = array( 1 => 'Left', 2 => 'Right' );
                                                                    ?>
                                                                    <?php
                                                                       foreach($featured_align_array as $featured_align_array_keys => $featured_align_array_vals ){
                                                                              
                                                                          $featured_align_is_checked = $featured_align_array_keys == $featured_align ? "selected=''" : null;   
                                                                    ?>
                                                                          <option value="<?php echo intval($featured_align_array_keys); ?>" <?php echo $featured_align_is_checked; ?> ><?php echo $featured_align_array_vals; ?></option>
                                                                    <?php       
                                                                       }
                                                                    ?>  
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                              </div>
                                           
                                      <?php
                                      }
                                      
                                      if( $post_val2 == 4 ){
                                      ?>
                                              
                                              <div id="post-option-form" class="post-option-content" style="">
                                                    <div id="post-option-form-label" class="post-option-form-label" style="width: 430px;">
                                                        <span class="post-option-label post-option-label-sort-icon"><label for="description"><?php echo __('Gravatar'); ?></label></span>
                                                        <input id="post_field_option_id" class="post_field_option_id_val" type="hidden" value="<?php echo $post_val[0]; ?>=<?php echo $post_val1; ?>=4" name="post_field_option_id_val[]"/>
                                                        <span class="post-remove-icon post-remove-icon-selected"></span>
                                                        <span class="post-option-arrow post-optin-arrow-selected"></span>
                                                    </div>
                                                    <div id="post-option-form-field" class="post-option-form-field" style="width: 430px;">
                                                        <table id="option-form-field-table">
                                                        <tbody>
                                                        <tr class="label">
                                                            <td>
                                                                <?php
                                                                $gravatar_show_is_checked = isset( $option_value['show_post_gravatar'.$post_val3][0] ) ? intval( $option_value['show_post_gravatar'.$post_val3][0] ) == 1 ? "checked=''" : "" : null;  
                                                                ?>
                                                                <input id="show_post_gravatar_id" class="show_post_gravatar_class <?php echo $post_val3; ?>" type="checkbox" <?php echo $gravatar_show_is_checked; ?> name="show_post_gravatar<?php echo $post_val3; ?>[]" value="1"/>
                                                                <label for="description"> <?php echo __('Show Post Gravatar'); ?></label>
                                                            </td>
                                                        </tr>
                                                        <tr class="label">
                                                            <td>
                                                                <label for="description"><?php echo __('Gravatar Size '); ?></label>
                                                                <?php
                                                                $gravatar_size_val = isset( $option_value['gravatar_size_select'.$post_val3][0] ) ? intval( $option_value['gravatar_size_select'.$post_val3][0] ) : null;  
                                                                ?>
                                                                <select id="gravatar_size_select_id" class="gravatar_size_select_class <?php echo $post_val3; ?>" name="gravatar_size_select<?php echo $post_val3; ?>[]">
                                                                    <option><?php echo __('Select Size'); ?></option>
                                                                    <?php
                                                                    $gravatar_size_array = array( 45 => 'Small (45px)', 65 => 'Medium (65px)', 85 => 'Large (85px)', 125 => 'Extra Large (125px)' );
                                                                    ?>
                                                                    <?php foreach($gravatar_size_array as $gravatar_size_array_keys => $gravatar_size_array_res ){ 
                                                                            
                                                                            $gravatar_size_is_selected = $gravatar_size_array_keys == $gravatar_size_val ? "selected=''" : null;
                                                                    ?>
                                                                            <option value="<?php echo intval($gravatar_size_array_keys); ?>" <?php echo $gravatar_size_is_selected; ?> ><?php echo $gravatar_size_array_res; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label for="description"><?php echo __('Gravatar Alignment '); ?></label>
                                                                <?php
                                                                $gravatar_align_val = isset( $option_value['gravatar_align_select'.$post_val3][0] ) ? intval( $option_value['gravatar_align_select'.$post_val3][0] ) : null;  
                                                                ?>
                                                                <select id="gravatar_align_select_id" class="gravatar_align_select_class <?php echo $post_val3; ?>" name="gravatar_align_select<?php echo $post_val3; ?>[]">
                                                                    <option><?php echo __('Select Align'); ?></option>
                                                                    <?php
                                                                    $gravatar_align = array( 1 => 'Left', 2 => 'Right' );
                                                                    ?>
                                                                    <?php foreach($gravatar_align as $gravatar_align_keys => $gravatar_align_vals ){
                                                                          
                                                                          $gravatar_align_is_selected = $gravatar_align_keys == $gravatar_align_val ? "selected=''" : null;
                                                                    ?>
                                                                          <option value="<?php echo intval( $gravatar_align_keys ); ?>" <?php echo $gravatar_align_is_selected; ?> ><?php echo $gravatar_align_vals; ?></option>
                                                                    <?php
                                                                          }
                                                                    ?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                        </table>
                                                    </div>
                                                  </div>
                                              
                                      <?php  
                                      }
                                      
                                      if( $post_val2 == 5 ){
                                      ?>
                                          
                                          <div id="post-option-form" class="post-option-content" style="">
                                            <div id="post-option-form-label" class="post-option-form-label" style="width: 270px;">
                                                <span class="post-option-label post-option-label-sort-icon"><label for="description">Slider</label></span>
                                                <input id="post_field_option_id" class="post_field_option_id_val" type="hidden" value="<?php echo $post_val3; ?>=5" name="post_field_option_id_val[]" />
                                                <span class="post-remove-icon post-remove-icon-selected"></span>
                                                <span class="post-option-arrow post-optin-arrow-selected"></span>
                                            </div>
                                            <div id="post-option-form-field" class="post-option-form-field" style="width: 292px;">
                                                <table id="option-form-field-table">
                                                <tbody>
                                                    <tr class="label">
                                                        <td>
                                                            <?php
                                                            $post_sliders = is_array( $option_value['browse_text_values'.$post_val3] ) ? $option_value['browse_text_values'.$post_val3] : array();  
                                                            ?>
                                                            <label for="description"></label>
                                                            <input id="browse_post_data_id" class="browse_post_data_class button media-button button-primary button-large media-button-select <?php echo $post_val3; ?>" type="submit" name="browse_post_data<?php echo $post_val3; ?>[]" value="Browse..."/>
                                                            <div class="browse_post_data_display">
                                                                <?php
                                                                    if( !empty($post_sliders)){
                                                                        foreach($post_sliders as $post_sliders_keys => $post_sliders_vals ){
                                                                ?>
                                                                             <div class='browse_text_id_thumbnail' style='display:block;'>
                                                                                <?php if( !empty($post_sliders_vals)){ ?>
                                                                                   <img id='browse_text_id_img' src="<?php echo $post_sliders_vals; ?>" />
                                                                                   <input type='hidden' value="<?php echo $post_sliders_vals; ?>" name='browse_text_values<?php echo $post_val3; ?>[]' />
                                                                                   <span class='browse-removed'>x</span>
                                                                                <?php } ?>
                                                                             </div>
                                                                <?php
                                                                        }
                                                                    }
                                                                     
                                                                ?>
                                                                <div style="clear:both;"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="label"> 
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </div>
                                          </div>
                                            
                                      <?php  
                                      }
                                      
                                      if( $post_val2 == 6 ){
                                      ?>
                                          
                                          <div id="post-option-form" class="post-option-content" style="">
                                            <div id="post-option-form-label" class="post-option-form-label" style="width: 270px;">
                                                <span class="post-option-label post-option-label-sort-icon"><label for="description">Date</label></span>
                                                <input id="post_field_option_id" class="post_field_option_id_val" type="hidden" value="<?php echo $post_val3; ?>=6" name="post_field_option_id_val[]" />
                                                <span class="post-remove-icon post-remove-icon-selected"></span>
                                                <span class="post-option-arrow post-optin-arrow-selected"></span>
                                            </div>
                                            <div id="post-option-form-field" class="post-option-form-field" style="width: 292px;">
                                                <table id="option-form-field-table">
                                                <tbody>
                                                    <tr class="label">
                                                        <td>
                                                            <?php
                                                            $post_format = isset( $option_value['date_post_format'.$post_val3][0] ) ? trim( $option_value['date_post_format'.$post_val3][0] ) ? "d M Y" : "" : "d M Y";  
                                                            ?>
                                                            <label for="description"> <?php echo __('Date '); ?></label>
                                                            <input id="date_post_format_id" class="date_post_format_class <?php echo $post_val3; ?>" type="text" name="date_post_format<?php echo $post_val3; ?>[]" value="<?php echo $post_format; ?>"/>
                                                            <label for="description"> <?php echo __(' Post Format'); ?></label>
                                                        </td>
                                                    </tr>
                                                    <tr class="label"> 
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </div>
                                          </div>
                                          
                                      <?php
                                      }
                                      
                                      if( $post_val2 == 7 ){
                                      ?>
                                          
                                          <div id="post-option-form" class="post-option-content" style="">
                                            <div id="post-option-form-label" class="post-option-form-label" style="width: 270px;">
                                                <span class="post-option-label post-option-label-sort-icon"><label for="description">Category</label></span>
                                                <input id="post_field_option_id" class="post_field_option_id_val" type="hidden" value="<?php echo $post_val3; ?>=7" name="post_field_option_id_val[]" />
                                                <span class="post-remove-icon post-remove-icon-selected"></span>
                                                <span class="post-option-arrow post-optin-arrow-selected"></span>
                                            </div>
                                            <div id="post-option-form-field" class="post-option-form-field" style="width: 292px;">
                                                <table id="option-form-field-table">
                                                    <tbody>
                                                    <tr class="label">
                                                        <td><label for="description">Category selected</label></td>
                                                    </tr>
                                                        <tr class="label"></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                          </div>
                                          
                                      <?php  
                                      }
                                      
                                      if( $post_val2 == 8 ){
                                      ?>
                                          
                                          <div id="post-option-form" class="post-option-content" style="">
                                            <div id="post-option-form-label" class="post-option-form-label" style="width: 270px;">
                                                <span class="post-option-label post-option-label-sort-icon"><label for="description">Author</label></span>
                                                <input id="post_field_option_id" class="post_field_option_id_val" type="hidden" value="<?php echo $post_val3; ?>=8" name="post_field_option_id_val[]" />
                                                <span class="post-remove-icon post-remove-icon-selected"></span>
                                                <span class="post-option-arrow post-optin-arrow-selected"></span>
                                            </div>
                                            <div id="post-option-form-field" class="post-option-form-field" style="width: 292px;">
                                                <table id="option-form-field-table">
                                                    <tbody>
                                                    <tr class="label">
                                                        <td>
                                                              <?php
                                                              $author_field = !empty( $option_value['author_post_field'.$post_val3][0] ) ? trim( $option_value['author_post_field'.$post_val3][0] ) : "user_nicename";  
                                                              ?>
                                                              <label for="description">Author Meta: </label>
                                                              <input id="date_post_format_id" class="author_post_field_class <?php echo $post_val3; ?>" type="text" name="author_post_field<?php echo $post_val3; ?>[]" value="<?php echo $author_field; ?>" /><code>(m1,m2)</code>
                                                              <a class="help-link" href="javascript:void(0);">Help?</a>
                                                        </td>
                                                    </tr>
                                                        <tr class="label"></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                          </div>
                                           
                                      <?php  
                                      }
                                
                                  }  
                             
                              }
                             
                            } 
                         
                         }
                         
                    ?>
                </div>
           </div>   
    <?php         
        }
         
    }
    
    /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
      * Option post area
      * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
    **/
    
    if( in_array( intval($option_post_sort_val_res), $post_checked ) ){
?>
        <div id="option-form" class="option-form option-form-sort post-sort-area post-selected-item post-id<?php echo intval($option_post_sort_val_res); ?>" style="display:block;">
        <div id="option-form-label" class="option-form-label"> 
            <span class="option-label option-label-sort-icon"><?php echo html::label(array( 'text' => get_the_title( $option_post_sort_val_res  ), 'for' => 'description' )); ?></span>
            <span class="option-luck optin-luck-icon"></span>
            <span class="option-arrow">
            <?php $option_post_sort_id = array( 'name' => 'option_post_sort_id[]', 'value' => intval($option_post_sort_val_res), 'id' => 'post_field_option_id', 'class' => 'post_field_option_id' );          
                echo input::hidden( $option_post_sort_id ); ?>
            </span>
        </div>
            
        <div id="option-form-field" class="option-form-field">
        <?php
         if(!empty($post_value)){
             foreach($post_value as $post_value_keys => $post_value_res){
                
               $post_val = explode("=",$post_value_res);
                     
               $post_val1 = intval( $post_val[0] );
               $post_val2 = intval( $post_val[1] );
                     
               if( $post_val1 == $option_post_sort_val_res ){
                         
                   /** title values string form **/
                   
                   if( $post_val2 == 1 ){
                             
               ?>  
                   <div id="post-option-form" class="post-option-content" style="">
                        <div id="post-option-form-label" class="post-option-form-label" style="width: 268px;">
                            <span class="post-option-label post-option-label-sort-icon"><label for="description"><?php echo __('Header Title'); ?></label></span>
                            <input id="post_field_option_id" class="post_field_option_id_val" type="hidden" value="<?php echo $post_val1; ?>=1" name="post_field_option_id_val[]"/>
                            <span class="post-remove-icon post-remove-icon-selected"></span>
                            <span class="post-option-arrow post-optin-arrow-selected"></span>
                        </div>
                        <div id="post-option-form-field" class="post-option-form-field" style="width: 290px;">
                            <table id="option-form-field-table">
                                <tbody>
                                    <tr class="label">
                                        <td>
                                           <?php
                                           $title_show_is_checked = isset( $option_value['show_post_title'.$post_val1][0] ) ? intval( $option_value['show_post_title'.$post_val1][0] ) == 1 ? "checked=''" : "" : null;  
                                           ?>
                                           <input id="show_post_title_id" class="show_post_title_class<?php echo $post_val1; ?>" type="checkbox" <?php echo $title_show_is_checked; ?>  name="show_post_title<?php echo $post_val1; ?>[]" value="1"/>
                                           <label for="description"> <?php echo __('Show Post Title'); ?></label>
                                        </td>
                                    </tr>
                                    <tr class="label">
                                        <td>
                                            <label for="description"><?php echo __('Limit Content to '); ?></label>
                                            <?php
                                            $post_limit = isset( $option_value['limit_post_title'.$post_val1][0] ) ? trim($option_value['limit_post_title'.$post_val1][0] ) : null;  
                                            ?>
                                            <input id="limit_post_title_id" class="limit_post_title_class<?php echo $post_val1; ?>" type="text" name="limit_post_title<?php echo $post_val1; ?>[]" value="<?php echo $post_limit; ?>" maxlength="50"/>
                                            <label for="description"> <?php echo __('Characters'); ?></label>
                                        </td>
                                    </tr>
                                    <tr class="label">
                                        <td>
                                            <label for="description"><?php echo __('Font Size '); ?></label>
                                            <?php
                                            $post_size = isset( $option_value['font_size_text_title'.$post_val1][0] ) ? trim($option_value['font_size_text_title'.$post_val1][0] ) : null;  
                                            ?>
                                            <input id="font_size_text_title_id" class="font_size_text_title_class<?php echo $post_val1; ?>" type="text" name="font_size_text_title<?php echo $post_val1; ?>[]" value="<?php echo $post_size; ?>" maxlength="50"/>
                                            <label for="description"><?php echo __('More Text'); ?></label>
                                            <?php
                                            $post_more = isset( $option_value['more_post_text_content'.$post_val1][0] ) ? trim($option_value['more_post_text_content'.$post_val1][0] ) : null;  
                                            ?>
                                            <input id="more_post_text_content_id" class="more_post_text_content_class<?php echo $post_val1; ?>" type="text" name="more_post_text_content<?php echo $post_val1; ?>[]" value="<?php echo $post_more; ?>" maxlength="50"/>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>     
                 <?php
                         
                 } 
                 
                 /** title values string form **/
                     
                 /** content values string form **/
                      
                 if( $post_val2 == 2 ){
                     
                 ?>            
                 
                     <div id="post-option-form" class="post-option-content" style="">
                        <div id="post-option-form-label" class="post-option-form-label" style="width: 268px;">
                            <span class="post-option-label post-option-label-sort-icon"><label for="description"><?php echo __('HTML Content'); ?></label></span>
                            <input id="post_field_option_id" class="post_field_option_id_val" type="hidden" name="post_field_option_id_val[]" value="<?php echo $post_val1; ?>=2"/>
                            <span class="post-remove-icon post-remove-icon-selected"></span>
                            <span class="post-option-arrow post-optin-arrow-selected"></span>
                        </div>
                        <div id="post-option-form-field" class="post-option-form-field" style="width: 290px;">
                            <table id="option-form-field-table">
                            <tbody>
                                <tr class="label">
                                    <td>
                                        <?php
                                        $content_show_is_checked = isset( $option_value['show_post_content'.$post_val1][0] ) ? intval( $option_value['show_post_content'.$post_val1][0] ) == 1 ? "checked=''" : "" : null;  
                                        ?>
                                        <input id="show_post_content_id" class="show_post_content_class<?php echo $post_val1; ?>" type="checkbox" <?php echo $content_show_is_checked; ?>  name="show_post_content<?php echo $post_val1; ?>[]" value="1"/>
                                        <label for="description"> <?php echo __('Show Post Content'); ?></label>
                                    </td>
                                </tr>
                                <tr class="label">
                                    <td>
                                        <label for="description"><?php echo __('Limit Content to '); ?></label>
                                        <?php
                                        $content_limit = isset( $option_value['limit_post_content'.$post_val1][0] ) ? trim($option_value['limit_post_content'.$post_val1][0] ) : null;  
                                        ?>
                                        <input id="limit_post_content_id" class="limit_post_content_class<?php echo $post_val1; ?>" type="text"  name="limit_post_content<?php echo $post_val1; ?>[]" value="<?php echo $content_limit; ?>" maxlength="50"/>
                                        <label for="description"> <?php echo __('Characters'); ?></label>
                                    </td>
                                </tr>
                                <tr class="label">
                                    <td>
                                        <label for="description"><?php echo __('Font Size '); ?></label>
                                        <?php
                                         $content_size = isset( $option_value['font_size_content_text'.$post_val1][0] ) ? trim($option_value['font_size_content_text'.$post_val1][0] ) : null;  
                                        ?>
                                        <input id="font_size_content_text_id" class="font_size_content_text_class<?php echo $post_val1; ?>" type="text" name="font_size_content_text<?php echo $post_val1; ?>[]" value="<?php echo $content_size; ?>" maxlength="50"/>
                                        <label for="description"><?php echo __('More Text'); ?></label>
                                        <?php
                                        $content_more = isset( $option_value['more_post_content_text'.$post_val1][0] ) ? trim($option_value['more_post_content_text'.$post_val1][0] ) : null;  
                                        ?>
                                        <input id="more_post_content_text_id" class="more_post_content_text_class<?php echo $post_val1; ?>" type="text" name="more_post_content_text<?php echo $post_val1; ?>[]" value="<?php echo $content_more; ?>" maxlength="50"/>
                                    </td>
                                </tr>
                                <tr>
                                   <td></td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                     </div>       
                 
                  <?php
                  }
                  
                  /** content values string form **/
                  
                  /** image values string form **/
                  
                  if( $post_val2 == 3 ){
                  ?>
                      <div id="post-option-form" class="post-option-content" style="">
                        <div id="post-option-form-label" class="post-option-form-label" style="width: 270px;">
                            <span class="post-option-label post-option-label-sort-icon"><label for="description"><?php echo __('Images'); ?></label></span>
                            <input id="post_field_option_id" class="post_field_option_id_val" type="hidden" value="<?php echo $post_val1; ?>=3" name="post_field_option_id_val[]"/>
                            <span class="post-remove-icon post-remove-icon-selected"></span>
                            <span class="post-option-arrow post-optin-arrow-selected"></span>
                        </div>
                        <div id="post-option-form-field" class="post-option-form-field" style="width: 292px;">
                            <table id="option-form-field-table">
                                <tbody>
                                    <tr class="label">
                                        <td>
                                            <?php
                                            $featured_show_is_checked = isset( $option_value['show_post_featured'.$post_val1][0] ) ? intval( $option_value['show_post_featured'.$post_val1][0] ) == 1 ? "checked=''" : "" : null;  
                                            ?>
                                            <input id="show_post_featured_id" class="show_post_featured_class<?php echo $post_val1; ?>" type="checkbox" <?php echo $featured_show_is_checked; ?>  name="show_post_featured<?php echo $post_val1; ?>[]" value="1"/>
                                            <label for="description"> <?php echo __('Show Post Featured'); ?></label>
                                        </td>
                                    </tr>
                                    <tr class="label">
                                        <td>
                                            <?php
                                            $featured_size = isset( $option_value['image_size_select'.$post_val1][0] ) ? trim($option_value['image_size_select'.$post_val1][0] ) : null;  
                                            ?>
                                            <label for="description">Image Size </label>
                                            <select id="image_size_select_id" name="image_size_select<?php echo $post_val1; ?>[]" class="image_size_select_class<?php echo $post_val1; ?>">
                                                <option>Select Size</option>
                                                <?php
                                                  $all_sizes = get_intermediate_image_sizes(); 
                                                ?>
                                                <?php if( !empty($all_sizes)){ 
                                                          foreach($all_sizes as $all_sizes_keys => $all_sizes_vals){
                                                            
                                                          $featured_size_checked = $all_sizes_keys == $featured_size ? "selected=''" : null; 
                                                ?>
                                                          <option value="<?php echo intval($all_sizes_keys); ?>" <?php echo $featured_size_checked; ?> ><?php echo $all_sizes_vals; ?></option>
                                                <?php } 
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php
                                            $featured_align = isset( $option_value['image_align_select'.$post_val1][0] ) ? trim($option_value['image_align_select'.$post_val1][0] ) : null;  
                                            ?>
                                            <label for="description"><?php echo __('Image Alignment '); ?></label>
                                            <select id="image_align_select_id" name="image_align_select<?php echo $post_val1; ?>[]" class="image_align_select_class<?php echo $post_val1; ?>">
                                            <option>Select Align</option>
                                            <?php
                                               $featured_align_array = array( 1 => 'Left', 2 => 'Right' );
                                            ?>
                                            <?php
                                               foreach($featured_align_array as $featured_align_array_keys => $featured_align_array_vals ){
                                                      
                                                  $featured_align_is_checked = $featured_align_array_keys == $featured_align ? "selected=''" : null;   
                                            ?>
                                                  <option value="<?php echo intval($featured_align_array_keys); ?>" <?php echo $featured_align_is_checked; ?> ><?php echo $featured_align_array_vals; ?></option>
                                            <?php       
                                               }
                                            ?>  
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                      </div>
                  <?php    
                  }
                  
                  /** image values string form **/
                  
                  /** gravatar values string form **/
                  
                  if( $post_val2 == 4 ){
                  ?>
                      
                      <div id="post-option-form" class="post-option-content" style="">
                        <div id="post-option-form-label" class="post-option-form-label" style="width: 430px;">
                            <span class="post-option-label post-option-label-sort-icon"><label for="description"><?php echo __('Gravatar'); ?></label></span>
                            <input id="post_field_option_id" class="post_field_option_id_val" type="hidden" value="<?php echo $post_val1; ?>=4" name="post_field_option_id_val[]"/>
                            <span class="post-remove-icon post-remove-icon-selected"></span>
                            <span class="post-option-arrow post-optin-arrow-selected"></span>
                        </div>
                        <div id="post-option-form-field" class="post-option-form-field" style="width: 430px;">
                            <table id="option-form-field-table">
                            <tbody>
                            <tr class="label">
                                <td>
                                    <?php
                                    $gravatar_show_is_checked = isset( $option_value['show_post_gravatar'.$post_val1][0] ) ? intval( $option_value['show_post_gravatar'.$post_val1][0] ) == 1 ? "checked=''" : "" : null;  
                                    ?>
                                    <input id="show_post_gravatar_id" class="show_post_gravatar_class <?php echo $post_val1; ?>" type="checkbox" <?php echo $gravatar_show_is_checked; ?> name="show_post_gravatar<?php echo $post_val1; ?>[]" value="1"/>
                                    <label for="description"> <?php echo __('Show Post Gravatar'); ?></label>
                                </td>
                            </tr>
                            <tr class="label">
                                <td>
                                    <label for="description"><?php echo __('Gravatar Size '); ?></label>
                                    <?php
                                    $gravatar_size_val = isset( $option_value['gravatar_size_select'.$post_val1][0] ) ? intval( $option_value['gravatar_size_select'.$post_val1][0] ) : null;  
                                    ?>
                                    <select id="gravatar_size_select_id" class="gravatar_size_select_class <?php echo $post_val1; ?>" name="gravatar_size_select<?php echo $post_val1; ?>[]">
                                        <option><?php echo __('Select Size'); ?></option>
                                        <?php
                                        $gravatar_size_array = array( 45 => 'Small (45px)', 65 => 'Medium (65px)', 85 => 'Large (85px)', 125 => 'Extra Large (125px)' );
                                        ?>
                                        <?php foreach($gravatar_size_array as $gravatar_size_array_keys => $gravatar_size_array_res ){ 
                                                
                                                $gravatar_size_is_selected = $gravatar_size_array_keys == $gravatar_size_val ? "selected=''" : null;
                                        ?>
                                                <option value="<?php echo intval($gravatar_size_array_keys); ?>" <?php echo $gravatar_size_is_selected; ?> ><?php echo $gravatar_size_array_res; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="description"><?php echo __('Gravatar Alignment '); ?></label>
                                    <?php
                                    $gravatar_align_val = isset( $option_value['gravatar_align_select'.$post_val1][0] ) ? intval( $option_value['gravatar_align_select'.$post_val1][0] ) : null;  
                                    ?>
                                    <select id="gravatar_align_select_id" class="gravatar_align_select_class <?php echo $post_val1; ?>" name="gravatar_align_select<?php echo $post_val1; ?>[]">
                                        <option><?php echo __('Select Align'); ?></option>
                                        <?php
                                        $gravatar_align = array( 1 => 'Left', 2 => 'Right' );
                                        ?>
                                        <?php foreach($gravatar_align as $gravatar_align_keys => $gravatar_align_vals ){
                                              
                                              $gravatar_align_is_selected = $gravatar_align_keys == $gravatar_align_val ? "selected=''" : null;
                                        ?>
                                              <option value="<?php echo intval( $gravatar_align_keys ); ?>" <?php echo $gravatar_align_is_selected; ?> ><?php echo $gravatar_align_vals; ?></option>
                                        <?php
                                              }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                            </table>
                        </div>
                      </div>
                      
                  <?php     
                  }
                   
                  /** gravatar values string form **/
                  
                  /** slider values string form **/
                  
                  if( $post_val2 == 5 ){
                  
                  ?>
                      
                      <div id="post-option-form" class="post-option-content" style="">
                        <div id="post-option-form-label" class="post-option-form-label" style="width: 270px;">
                            <span class="post-option-label post-option-label-sort-icon"><label for="description">Slider</label></span>
                            <input id="post_field_option_id" class="post_field_option_id_val" type="hidden" value="<?php echo $post_val1; ?>=5" name="post_field_option_id_val[]" />
                            <span class="post-remove-icon post-remove-icon-selected"></span>
                            <span class="post-option-arrow post-optin-arrow-selected"></span>
                        </div>
                        <div id="post-option-form-field" class="post-option-form-field" style="width: 292px;">
                            <table id="option-form-field-table">
                            <tbody>
                                <tr class="label">
                                    <td>
                                        <?php
                                        $post_sliders = is_array( $option_value['browse_text_values'.$post_val1] ) ? $option_value['browse_text_values'.$post_val1] : array();  
                                        ?>
                                        <label for="description"></label>
                                        <input id="browse_post_data_id" class="browse_post_data_class button media-button button-primary button-large media-button-select <?php echo $post_val1; ?>" type="submit" name="browse_post_data<?php echo $post_val1; ?>[]" value="Browse..."/>
                                        <div class="browse_post_data_display">
                                            <?php
                                                if( !empty($post_sliders)){
                                                    foreach($post_sliders as $post_sliders_keys => $post_sliders_vals ){
                                            ?>
                                                         <div class='browse_text_id_thumbnail' style='display:block;'>
                                                            <?php if( !empty($post_sliders_vals)){ ?>
                                                               <img id='browse_text_id_img' src="<?php echo $post_sliders_vals; ?>" />
                                                               <input type='hidden' value="<?php echo $post_sliders_vals; ?>" name='browse_text_values<?php echo $post_val1; ?>[]' />
                                                               <span class='browse-removed'>x</span>
                                                            <?php } ?>
                                                         </div>
                                            <?php
                                                    }
                                                }
                                                 
                                            ?>
                                            <div style="clear:both;"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="label"> 
                                </tr>
                            </tbody>
                            </table>
                        </div>
                      </div>

                  <?php 
                  
                  }
                  
                  /** slider values string form **/
                  
                  /** addons (date) values string form **/
                  
                  if( $post_val2 == 6 ){
                  ?>  
                      
                      <div id="post-option-form" class="post-option-content" style="">
                        <div id="post-option-form-label" class="post-option-form-label" style="width: 270px;">
                            <span class="post-option-label post-option-label-sort-icon"><label for="description">Date</label></span>
                            <input id="post_field_option_id" class="post_field_option_id_val" type="hidden" value="<?php echo $post_val1; ?>=6" name="post_field_option_id_val[]" />
                            <span class="post-remove-icon post-remove-icon-selected"></span>
                            <span class="post-option-arrow post-optin-arrow-selected"></span>
                        </div>
                        <div id="post-option-form-field" class="post-option-form-field" style="width: 292px;">
                            <table id="option-form-field-table">
                            <tbody>
                                <tr class="label">
                                    <td>
                                        <?php
                                        $post_format = isset( $option_value['date_post_format'.$post_val1][0] ) ? trim( $option_value['date_post_format'.$post_val1][0] ) ? "d M Y" : "" : "d M Y";  
                                        ?>
                                        <label for="description"> <?php echo __('Date '); ?></label>
                                        <input id="date_post_format_id" class="date_post_format_class <?php echo $post_val1; ?>" type="text" name="date_post_format<?php echo $post_val1; ?>[]" value="<?php echo $post_format; ?>"/>
                                        <label for="description"> <?php echo __(' Post Format'); ?></label>
                                    </td>
                                </tr>
                                <tr class="label"> 
                                </tr>
                            </tbody>
                            </table>
                        </div>
                      </div>
                       
                  <?php  
                  }
                  
                  /** addons (date) values string form **/
                  
                  /** addons (category) values string form **/
                  
                  if( $post_val2 == 7 ){
                  ?>  
                      
                      <div id="post-option-form" class="post-option-content" style="">
                        <div id="post-option-form-label" class="post-option-form-label" style="width: 270px;">
                            <span class="post-option-label post-option-label-sort-icon"><label for="description">Category</label></span>
                            <input id="post_field_option_id" class="post_field_option_id_val" type="hidden" value="<?php echo $post_val1; ?>=7" name="post_field_option_id_val[]" />
                            <span class="post-remove-icon post-remove-icon-selected"></span>
                            <span class="post-option-arrow post-optin-arrow-selected"></span>
                        </div>
                        <div id="post-option-form-field" class="post-option-form-field" style="width: 292px;">
                            <table id="option-form-field-table">
                                <tbody>
                                <tr class="label">
                                    <td><label for="description">Category selected</label></td>
                                </tr>
                                    <tr class="label"></tr>
                                </tbody>
                            </table>
                        </div>
                      </div>
                      
                  <?php
                  }
                  
                  /** addons (category) values string form **/
                   
                  /** addons (author) values string form **/ 
                      
                  if( $post_val2 == 8 ){    
                      
                  ?>
                      
                      <div id="post-option-form" class="post-option-content" style="">
                        <div id="post-option-form-label" class="post-option-form-label" style="width: 270px;">
                            <span class="post-option-label post-option-label-sort-icon"><label for="description">Author</label></span>
                            <input id="post_field_option_id" class="post_field_option_id_val" type="hidden" value="<?php echo $post_val1; ?>=8" name="post_field_option_id_val[]" />
                            <span class="post-remove-icon post-remove-icon-selected"></span>
                            <span class="post-option-arrow post-optin-arrow-selected"></span>
                        </div>
                        <div id="post-option-form-field" class="post-option-form-field" style="width: 292px;">
                            <table id="option-form-field-table">
                                <tbody>
                                <tr class="label">
                                    <td>
                                          <?php
                                          $author_field = !empty( $option_value['author_post_field'.$post_val1][0] ) ? trim( $option_value['author_post_field'.$post_val1][0] ) : "user_nicename";  
                                          ?>
                                          <label for="description">Author Meta: </label>
                                          <input id="date_post_format_id" class="author_post_field_class <?php echo $post_val1; ?>" type="text" name="author_post_field<?php echo $post_val1; ?>[]" value="<?php echo $author_field; ?>" /><code>(m1,m2)</code>
                                          <a class="help-link" href="javascript:void(0);">Help?</a>
                                    </td>
                                </tr>
                                    <tr class="label"></tr>
                                </tbody>
                            </table>
                        </div>
                      </div>
                      
                  <?php
                  }
                  
                  /** addons (author) values string form **/ 
                  
                }
             }       
           }
        ?>
    </div>
</div>   
<?php
     }
   }
 }
?>
   
<?php
if( !empty($posts_sql)){
           
     foreach($posts_sql as $posts_sql_keys => $posts_sql_res ){  
            
           if( !in_array( intval($posts_sql_res->ID), $post_checked ) ){   
?>
                <div id="option-form" class="option-form option-form-sort post-sort-area post-selected-item post-id<?php echo intval($posts_sql_res->ID); ?>" style="display:none;">
                    <div id="option-form-label" class="option-form-label"> 
                        <span class="option-label option-label-sort-icon"><?php echo html::label(array( 'text' => get_the_title($posts_sql_res->ID), 'for' => 'description' )); ?></span>
                        <span class="option-luck optin-luck-icon"></span>
                        <span class="option-arrow">
                            <?php $option_post_sort_id = array( 'name' => 'option_post_sort_id[]', 'value' => intval($posts_sql_res->ID), 'id' => 'post_field_option_id', 'class' => 'post_field_option_id' );          
                                echo input::hidden( $option_post_sort_id );  
                            ?>
                        </span>
                    </div>
                    <div id="option-form-field" class="option-form-field"></div>
                </div>
<?php  
           }
       }
   } 
   
   /** end of oid **/
} 
?>
</div>

<div id="post-data-content">

    <?php
       load::view("option/posts", $post_checked );
    ?>
    
    <div id="post-option-items-label-sort-area" id="post-option-items-label-sort-area"><h1>Sticky Post</h1></div>
    
    <div id="stick-post-option-content" class="stick-post-option-content">
    
    <?php
         $post_sticky = array( 0 => 'Sticky Post' ); 
         $post_sticky_key = key( $post_sticky );
    ?>
         <div id="post-stick-form" class="option-form-sort post-stick-content">
                <div id="post-stick-form-label" class="post-stick-form-label option-form-label">
                   <span class="post-stick-label post-stick-label-sort-icon"><?php echo html::label(array( 'text' => $post_sticky[0], 'for' => 'description' )); ?></span> 
                       <?php $post_field_sticky_id = array( 'name' => 'post_field_stick_id[]', 'value' => intval( $post_sticky_key ), 'id' => 'post_field_stick_id', 'class' => 'post_field_stick_id' );          
                             echo input::hidden( $post_field_sticky_id );  
                       ?>
                </div>
                <div id="post-stick-form-field" class="option-form-field post-stick-form-field"></div>
           </div> 
    
    </div>
    
    <div class="post-filter-list">
        <?php echo html::label(array( 'text' => 'Posts', 'for' => 'description' )); ?>
        <select class="post-select-filter" name="post_select[]" id="post-select-filter">
             <option>Select...</option>
             <?php
                  $posts_sql_filter = db::posts_execute('desc');
                  if(!empty($posts_sql_filter)){
                      foreach($posts_sql_filter as $posts_sql_filter_keys => $posts_sql_filter_vals ){
                        
                            $posts_id = intval($posts_sql_filter_vals->ID);
                  ?>           
                            <option value="<?php echo $posts_id; ?>"><?php echo get_the_title($posts_id); ?></option>
                  <?php         
                      }
                  }
             ?>
        </select>  
        <?php echo html::label(array( 'text' => 'Select a post filter', 'for' => 'description' )); ?>
    </div>
      
    <div id="post-option-form-content" class="post-option-form-content">

    <div id="post-option-items-label-sort-area" id="post-option-items-label-sort-area"><h1>Post Sortable Items</h1></div>
    
    <?php
         $post_option = array( 1 => 'Header Title', 2 => 'HTML Content', 3 => 'Images', 4 => 'Gravatar', 5 => 'Slider' );
         
         foreach($post_option as $post_option_keys => $post_option_vals ){
              
    ?>
               <div id="post-option-form" class="post-option-content">
                    <div id="post-option-form-label" class="post-option-form-label">
                       <span class="post-option-label post-option-label-sort-icon"><?php echo html::label(array( 'text' => $post_option[$post_option_keys], 'for' => 'description' )); ?></span> 
                           <?php $post_field_option_id = array( 'name' => 'post_field_option_id[]', 'value' => intval($post_option_keys), 'id' => 'post_field_option_id', 'class' => 'post_field_option_id' );          
                                 echo input::hidden( $post_field_option_id );  
                           ?>
                    </div>
                    <div id="post-option-form-field" class="post-option-form-field"></div>
               </div> 
              
    <?php          
         }
         
    ?>
    
    <div id="post-option-items-label-sort-area" id="post-option-items-label-sort-area"><h1>Post Addons Items</h1></div>
    
    <?php
         $post_addons = array( 6 => 'Date', 7 => 'Category', 8 => 'Author Name' );
         
         foreach($post_addons as $post_addons_keys => $post_addons_res ){
     ?>
                 <div id="post-option-form" class="post-option-content">
                    <div id="post-option-form-label" class="post-option-form-label">
                       <span class="post-option-label post-option-label-sort-icon"><?php echo html::label(array( 'text' => $post_addons[$post_addons_keys], 'for' => 'description' )); ?></span> 
                           <?php $post_field_addon_id = array( 'name' => 'post_field_option_id[]', 'value' => intval($post_addons_keys), 'id' => 'post_field_option_id', 'class' => 'post_field_option_id' );          
                                 echo input::hidden( $post_field_addon_id );  
                           ?>
                    </div>
                    <div id="post-option-form-field" class="post-option-form-field"></div>
               </div> 
     <?php  
         }   
     ?>
    
    </div>
    
</div>

<div class="clear"></div>
