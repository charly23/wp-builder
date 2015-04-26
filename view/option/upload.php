

<script type="text/javascript">
jQuery(function(){
            
     var tgm_media_frame;
              
     jQuery('div#post-option-upload-browse').on('click', 'span', function(e) {
     e.preventDefault();
                  
      if ( tgm_media_frame ) {
            tgm_media_frame.open();
            return;
      }
    
      tgm_media_frame = wp.media.frames.tgm_media_frame = wp.media({
            multiple: true,
            library: {
              type: 'image'
            },
      });
                
      tgm_media_frame.on('select', function(){
        
            var selection = tgm_media_frame.state().get('selection');
            
            selection.map( function( attachment ) {
                
                  attachment = attachment.toJSON();

                  console.log(attachment);
                  
                  var src_name = attachment.url.split('/');
                  var file     = src_name[src_name.length - 1];
                  
                  // Do something with attachment.id and/or attachment.url here

                  jQuery( "table#form_list tr.sort" ).last().after("<tr class='sort action'><td class='result title'><label>"+file+"</label></td><td class='result image'><div style='display:block;'><img src="+attachment.url+"><input type='hidden' value="+attachment.url+" name='post_upload_image[]'></div></td><td class='result action'><span class='edit-post-image'></span></td></tr>");       
                  
                  //jQuery("div#post-option-upload-display").append("<div style='display:block;'><img src="+attachment.url+"><input type='hidden' value="+attachment.url+" name='post_upload_image[]'><span class=''></span></div>");
            
            });
            
      });
                
      tgm_media_frame.open();
                
    });  
});
</script>

<div id="post-option-upload-form">
     <div id="post-option-upload-browse">
         <?php $posts_sql = db::posts(input::get_is_object()->pid, 'desc'); ?> 
         <span class="post-data-action-label option-label-upload-icon"><?php echo $posts_sql->post_title; ?></span>
         <span class="post-data-action-upload">Browse</span>
         <div class="clear"></div>
     </div>
     <div class="clear"></div>
     <div id="post-option-upload-display">
         
         <?php
               $upload_tab1_array = array( 'Title', 'Image', 'Action' );
               
               $upload_tab2_array = array();
         ?>
         <?php
               if( isset(input::get_is_object()->oid)){
                   
                   if( isset(input::get_is_object()->pid)){
                       
                       $oid = intval( input::get_is_object()->oid );
                       $oid_string = "WHERE oid={$oid}";
                       
                   }
                   
               } else {
                   $oid_string = '';
               }
                
               if( isset(input::get_is_object()->pid)){
                   
                   if( isset(input::get_is_object()->oid ) ){
                       
                       $pid = intval( input::get_is_object()->pid );
                       $pid_string = "AND pid={$pid}";
                       
                   } else {
                    
                       $pid = intval( input::get_is_object()->pid );
                       $pid_string = "WHERE pid={$pid}";
                   
                   }
                   
               } else {
                   $pid_string = '';
               } 
         ?>

         <?php $upload_sql = db::querys_injection("builder_upload", "$oid_string $pid_string", 'desc');  
               if( !empty($upload_sql) ){
                    foreach($upload_sql as $upload_sql_keys => $upload_sql_vals ){
                        
                    $url_name = substr( $upload_sql_vals->images, strrpos( $upload_sql_vals->images, '/' )+1 );    
         ?>
         <?php          $images = '<div style="display:block;">
                                        <img src="' . $upload_sql_vals->images . ' " />
                                    </div>';

                            $upload_tab2_array[] = array(
                                                           'title' => $url_name,
                                                           'image' => $images,
                                                           'action' => '<span class="edit-post-image"></span>'
                                                        );
                            
                        ?>
         <?php
                    }
               } else {
                    
                    $upload_tab2_array[] = array(
                                                   'title' => '',
                                                   'image' => '',
                                                   'action' => ''
                                                );
                    
               }
               
               
               echo html::table_list( array( 'id' => 'form_list', 'class' => 'upload_form_list' ), $upload_tab1_array, $upload_tab2_array ); 
               
         ?>
     </div>
     <div class="clear"></div>
</div>