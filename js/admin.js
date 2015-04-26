jQuery(function(){ 

      jQuery("div.option-form-label").live('click',function(){
             if( jQuery(this).next().is(":visible") == true ){
                
                 jQuery(this).next().hide();
                 jQuery(this).find('span.option-arrow').removeClass('optin-arrow-selected');
                 
             } else {
                
                 jQuery(this).next().show();
                 jQuery(this).find('span.option-arrow').addClass('optin-arrow-selected');
                 
             }
      });
      
      jQuery('#titleslide').slider({ 
            max: 1000,
            min: 0,
            value: 500,
            slide: function(e,ui) {
              jQuery('#titleslideval').html(ui.value);
            }
      });
      
      jQuery('#contentslide').slider({ 
            max: 1000,
            min: 0,
            value: 500,
            slide: function(e,ui) {
              jQuery('#contentslideval').html(ui.value);
            }
      });
      
      jQuery("div.option_form_quick_action").click(function(){
              
              var field = jQuery(this).parent().parent().parent().next().find("div.option_form_quick_field");
              
             if( field.is(":visible") == true ){
                
                 field.hide();
                 jQuery(this).find('span.option-arrow').removeClass('optin-arrow-selected');
                 
             } else {
                
                 field.show();
                 jQuery(this).find('span.option-arrow').addClass('optin-arrow-selected');
                 
             }
      });
      
      jQuery("input#delete_option_val").click(function(){
        
        if( jQuery(this).is(':checked') ){  

                jQuery('input.delete_option_checked').attr('checked', true);
                
                var num_check = jQuery('input.delete_option_checked:checked').length; 
                
                jQuery('input#del_option_id').attr('value', 'Delete - ' + num_check ); 

        } else {
            
            jQuery('input.delete_option_checked').attr('checked', false); 
            
            var num_check = jQuery('input.delete_option_checked:checked').length; 
            
            if( num_check != 0 ){
                jQuery('input#del_option_id').attr('value', 'Delete - ' + num_check );
                
            } else {
                jQuery('input#del_option_id').attr('value', 'Delete' );
            }
            
        }   
    });
    
    jQuery('input.delete_option_checked').click(function(){
        
        var number_of_checked = jQuery('input.delete_option_checked:checked').length;
        
        if( number_of_checked !=0 ){
            jQuery('input#del_option_id').attr('value', 'Delete - ' + number_of_checked );
        } else {
            jQuery('input#del_option_id').attr('value', 'Delete' ); 
        }  
        
    });
    
    jQuery("span.edit-plus-icon").click(function(){
              
              var field = jQuery(this).parent().parent().next().find("div.post-list-form");
              
             if( field.is(":visible") == true ){
                
                 field.hide();
                 jQuery(this).removeClass('cat-arrow-selected');
                 
             } else {
                
                 field.show();
                 jQuery(this).addClass('cat-arrow-selected');
                 
             }
      });
      
      jQuery("div.post-option-form-label").live('click',function(){
        
             if( jQuery(this).next().is(":visible") == true ){
                
                 jQuery(this).next().hide();
                 jQuery(this).find('span.post-option-arrow').removeClass('post-optin-arrow-selected');
                 
             } else {
                
                 jQuery(this).next().show();
                 jQuery(this).find('span.post-option-arrow').addClass('post-optin-arrow-selected');
                 
             }
      });
      
      jQuery("input.show_post_val_class").live('click',function(){
             
             var val = jQuery(this).attr('value');

             if( jQuery(this).is(':checked') ){
                 
                 jQuery("div.post-id"+val).show();
                 
             } else {
                
                 jQuery("div.post-id"+val).hide();
             }        
      });
      
      jQuery("span.post-remove-icon").live('click', function(){
             var removed_parent = jQuery(this).parent().parent();
             removed_parent.remove();          
      });
      
      jQuery("span.option-luck").live('click',function(){
             //jQuery(this).parent().parent().removeClass('option-form-sort').addClass('option-form-sort-icon-luck-selected');
      });
      
      jQuery("select#post_category_id").change(function(){
              
              var val_select = jQuery(this).val();
              
      });
      
      jQuery("a#load-post-content-id").click(function(){

             
      });
      
      jQuery("input.browse_post_data_class").live('click',function(e){
          
          var tgm_media_frame;
          var gen     = jQuery(this).parent();
          var post_id = jQuery(this).parent().parent().parent().parent().parent().parent().parent().prev().find("input.post_field_option_id").attr("value");
           
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

                      gen.find("div.browse_post_data_display").prepend( "<div class='browse_text_id_thumbnail' style='display:block;'><img id='browse_text_id_img' src="+attachment.url+"><input type='hidden' value="+attachment.url+" name='browse_text_values"+post_id+"[]'><span class='browse-removed'>x</span></div>" );
                });
                
          });
        
          tgm_media_frame.open();
          
          return false;
      });
      
      
      jQuery("div.browse_text_id_thumbnail").hover(function(){
         
           var hover_parent = jQuery(this);
           
           hover_parent.find("span.browse-removed").show();
         
      }, function(){
         
           var hover_parent = jQuery(this);
           
           hover_parent.find("span.browse-removed").hide();
         
      });
      
      jQuery("span.browse-removed").live('click',function(){
         
           jQuery(this).parent().remove();

      });
      
      jQuery("span.option-luck").live("click",function(){
          
               jQuery(this).toggleClass( "selecled" );
               jQuery(this).parent().parent().toggleClass("ui-state-disabled");
               /** jQuery(this).parent().parent().toggleClass("option-form-sort");
               jQuery(this).parent().parent().parent().sortable("option", "items", "div:not(.option-form-sort)"); **/
           
      });
      
      jQuery("a.help-link").live("click",function(e){
              
             window.open('admin.php?page=help_wp_builder', '_blank', 'width=300,height=400,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0'); 
             
             return false; 
      });
      
      jQuery("select.post-select-filter").live('change', function() {
             var stick_val = 0;  
             var text_val = jQuery(this).find('option:selected').text();
             if( text_val == "Select..." ){
                 jQuery(this).parent().parent().prev().find("span.post-stick-label label").text( "Sticky Post" );
             } else {
                 jQuery(this).parent().parent().prev().find("span.post-stick-label label").text( text_val );
             }
             
             var id_val = jQuery(this).find('option:selected').val();
             jQuery(this).parent().parent().prev().find("span.option-arrow input").attr("value", stick_val+'='+id_val );
              
             jQuery(this).each(function(){
                  jQuery(this).parent().parent().find('.post-option-content').remove(); 
             });
             
      });
      
});