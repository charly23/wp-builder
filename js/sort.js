jQuery(function(){ 
                        
     var fixHelper = function(e,ui){
         ui.children().each(function() {
            jQuery(this).width(jQuery(this).width());
         });
         return ui;
     };
     
     /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
       * Post Items Function
       * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     **/
     
     function postItemsBuild(){
        
           html_var = '';
           
           /**
             * Post items loop
           **/
           
           html_var += '<div id="post-option-items-label-sort-area" id="post-option-items-label-sort-area"><h1>Post Sortable Items</h1></div>';
           
           var PostOptionArray = new Array();
           
           PostOptionArray[1] = 'Header Title';
           PostOptionArray[2] = 'HTML Content';
           PostOptionArray[3] = 'Images';
           PostOptionArray[4] = 'Gravatar';
           PostOptionArray[5] = 'Slider';
           
           var PostOptionLength = PostOptionArray.length;
           for (var iz = 1; iz < PostOptionLength; iz++) {
                 html_var += '<div id="post-option-form" class="post-option-content"><div id="post-option-form-label" class="post-option-form-label">';
                 html_var += '<span class="post-option-label post-option-label-sort-icon"><label for="description">'+PostOptionArray[iz]+'</label></span>';
                 html_var += '<input id="post_field_option_id" class="post_field_option_id" type="hidden" value="'+iz+'" name="post_field_option_id[]">';
                 html_var += '</div>';
                 html_var += '<div id="post-option-form-field" class="post-option-form-field"></div>';
                 html_var += '</div>';
           }
           
           /**
             * Post addon loop
           **/
           
           html_var += '<div id="post-option-items-label-sort-area"><h1>Post Addons Items</h1></div>';
           
           var AddonOptionArray = new Array();
           
           AddonOptionArray[6] = 'Date';
           AddonOptionArray[7] = 'Category';
           AddonOptionArray[8] = 'Author Name';
           
           var AddonOptionLength = AddonOptionArray.length;
           for (var ix = 6; ix < AddonOptionLength; ix++) {
            
                html_var += '<div id="post-option-form" class="post-option-content"><div id="post-option-form-label" class="post-option-form-label">';
                html_var += '<span class="post-option-label post-option-label-sort-icon"><label for="description">'+AddonOptionArray[ix]+'</label></span>';
                html_var += '<input id="post_field_option_id" class="post_field_option_id" type="hidden" value="'+ix+'" name="post_field_option_id[]">';
                html_var += '</div>';
                html_var += '<div id="post-option-form-field" class="post-option-form-field"></div>';
                html_var += '</div>';
                
           }
           
           jQuery('div.post-option-form-content').html( html_var );
     }
     
     /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
       * Sticky Items Function
       * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     **/
     
     function stickyItemsBuild(){
           
           html_var = '';
           
           /**
             * Post sticky loop
           **/
           
           var PostStickyArray = new Array();
           
           PostStickyArray[0] = 'Sticky Post';
           
           var PostStickyLength = PostStickyArray.length;
           for (var ik = 0; ik < PostStickyLength; ik++) {
                 html_var += '<div id="post-stick-form" class="post-stick-content option-form-sort">';
                 html_var += '<div id="post-stick-form-label" class="post-stick-form-label option-form-label">';
                 html_var += '<span class="post-stick-label post-stick-label-sort-icon"><label for="description">'+PostStickyArray[ik]+'</label></span>';
                 html_var += '<input id="post_field_option_id" class="post_field_option_id" type="hidden" value="'+ik+'" name="post_field_option_id[]">';
                 html_var += '</div>';
                 html_var += '<div id="post-stick-form-field" class="option-form-field post-stick-form-field"></div>';
                 html_var += '</div>'; 
           }
           
           jQuery('div.stick-post-option-content').html( html_var );
           
     }
     
     /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
       * Post sort action script 1
       * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     **/ 
     
     jQuery('div.option-form-field').sortable({
         connectWith:'div.post-option-form-content',
         items: 'div.post-option-content',
         appendTo: document.body,
         helper: fixHelper,
         revert: 100,
         placeholder:'ui-state-highlight',
         stop: function(event, ui){
               
               jQuery("div.option-form-field").find('input.post_field_option_id').attr("name", "post_field_option_id_val[]");    
               
               jQuery("div.option-form-field").find('input.post_field_option_id').attr("class", "post_field_option_id_val");  
               
               var option_id = []; 
               jQuery('input.post_field_option_id_val').each( function(key, value) {
                   if( jQuery(this).parent().find("span.post-option-arrow").length == 0 ){
                       jQuery(this).after("<span class='post-remove-icon post-remove-icon-selected'></span><span class='post-option-arrow post-optin-arrow-selected'></span>");
                   }
               });
               
               jQuery('input.post_field_option_id_val').each( function(key, value) {
                   if( jQuery(this)){
                       
                       var post_id = jQuery(this).parent().parent().parent().parent().find("input.post_field_option_id").attr("value");
                       var post_option_items = jQuery(this).parent().parent();
                       
                       var val = jQuery(this).attr("value");
                       
                       if( val.length == 1 ){
                           jQuery(this).attr( "value", post_id+"="+val );
                       }
                       
                       var PostItem = [];
                       
                       /**
                         * Title option generated form item
                       **/
                       
                       html_title = '';
                       html_title += '<table id="option-form-field-table">';
                       html_title += '<tbody>';
                       html_title += '<tr class="label">';
                       html_title += '<td>';
                       html_title += '<input id="show_post_title_id" class="show_post_title_class" type="checkbox" value="1" name="show_post_title">';
                       html_title += '<label for="description"> Show Post Title</label>';
                       html_title += '</td>';
                       html_title += '</tr>';
                       html_title += '<tr class="label">';
                       html_title += '<td>';
                       html_title += '<label for="description">Limit Content to </label>';
                       html_title += '<input id="limit_post_title_id" class="limit_post_title_class" type="text" maxlength="50" value="100" name="limit_post_title">';
                       html_title += '<label for="description"> Characters</label>';
                       html_title += '</td>';
                       html_title += '</tr>';
                       html_title += '<tr class="label">';
                       html_title += '<td>';
                       html_title += '<label for="description">Font Size </label>';
                       html_title += '<input id="font_size_text_title_id" class="font_size_text_title_class" type="text" maxlength="50" value="12px" name="font_size_text_title[]">';
                       html_title += '<label for="description">More Text</label>';
                       html_title += '<input id="more_post_text_content_id" class="more_post_text_content_class" type="text" maxlength="50" value="More Text" name="more_post_text_content[]">';
                       html_title += '</td>';
                       html_title += '</tr>';
                       html_title += '<tr>';
                       html_title += '<td></td>';
                       html_title += '</tr>';
                       html_title += '</tbody>';
                       html_title += '</table>';
                       
                       PostItem[1] = html_title;
                       
                       html_content = '';
                       html_content += '<table id="option-form-field-table">';
                       html_content += '<tbody>';
                       html_content += '<tr class="label">';
                       html_content += '<td>';
                       html_content += '<input id="show_post_content_id" class="show_post_content_class" type="checkbox" value="1" name="show_post_content[]">';
                       html_content += '<label for="description"> Show Post Content</label>';
                       html_content += '</td>';
                       html_content += '</tr>';
                       html_content += '<tr class="label">';
                       html_content += '<td>';
                       html_content += '<label for="description">Limit Content to </label>';
                       html_content += '<input id="limit_post_content_id" class="limit_post_content_class" type="text" maxlength="50" value="100" name="limit_post_content[]">';
                       html_content += '<label for="description"> Characters</label>';
                       html_content += '</td>';
                       html_content += '</tr>';
                       html_content += '<tr class="label">';
                       html_content += '<td>';
                       html_content += '<label for="description">Font Size </label>';
                       html_content += '<input id="font_size_content_text_id" class="font_size_content_text_class" type="text" maxlength="50" value="12px" name="font_size_content_text[]">';
                       html_content += '<label for="description">More Text</label>';
                       html_content += '<input id="more_post_content_text_id" class="more_post_content_text_class" type="text" maxlength="50" value="More Text" name="more_post_content_text[]">';
                       html_content += '</td>';
                       html_content += '</tr>';
                       html_content += '<tr>';
                       html_content += '<td></td>';
                       html_content += '</tr>';
                       html_content += '</tbody>';
                       html_content += '</table>';
                       
                       PostItem[2] = html_content;
                       
                       html_image = '';
                       html_image += '<table id="option-form-field-table">';
                       html_image += '<tbody>';
                       html_image += '<tr class="label">';
                       html_image += '<td>';
                       html_image += '<input id="show_post_featured_id" class="show_post_featured_class" type="checkbox" value="1" name="show_post_featured[]">';
                       html_image += '<label for="description"> Show Post Featured</label>';
                       html_image += '</td>';
                       html_image += '</tr>';
                       html_image += '<tr class="label">';
                       html_image += '<td>';
                       html_image += '<label for="description">Image Size </label>';
                       html_image += '<select id="image_size_select_id" name="image_size_select[]" class="image_size_select_class">';
                       html_image += '<option>Select Size</option>';
                       html_image += '<option selected="" value="0">thumbnail</option>';
                       html_image += '<option value="1">medium</option>';
                       html_image += '<option value="2">large</option>';
                       html_image += '<option value="3">post-thumbnail</option>';
                       html_image += '</select>';
                       html_image += '</td>';
                       html_image += '<td> </td>';
                       html_image += '</tr>';
                       html_image += '<tr>';
                       html_image += '<td>';
                       html_image += '<label for="description">Image Alignment </label>';
                       html_image += '<select id="image_align_select_id" name="image_align_select[]" class="image_align_select_class">';
                       html_image += '<option>Select Align</option>';
                       html_image += '<option value="1">Left</option>';
                       html_image += '<option value="2">Right</option>';
                       html_image += '</select>';
                       html_image += '</td>';
                       html_image += '</tr>';
                       html_image += '</tbody>';
                       html_image += '</table>';
                       
                       PostItem[3] = html_image;

                       html_gravatar = '';
                       html_gravatar += '<table id="option-form-field-table">';
                       html_gravatar += '<tbody>';
                       html_gravatar += '<tr class="label">';
                       html_gravatar += '<td>';
                       html_gravatar += '<input id="show_post_gravatar_id" class="show_post_gravatar_class" type="checkbox" value="1" name="show_post_gravatar[]">';
                       html_gravatar += '<label for="description"> Show Post Gravatar</label>';
                       html_gravatar += '</td>';
                       html_gravatar += '</tr>';
                       html_gravatar += '<tr class="label">';
                       html_gravatar += '<td>';
                       html_gravatar += '<label for="description">Gravatar Size </label>';
                       html_gravatar += '<select id="gravatar_size_select_id" name="gravatar_size_select[]" class="gravatar_size_select_class">';
                       html_gravatar += '<option>Select Size</option>';
                       html_gravatar += '<option value="45">Small (45px)</option>';
                       html_gravatar += '<option value="65">Medium (65px)</option>';
                       html_gravatar += '<option value="85">Large (85px)</option>';
                       html_gravatar += '<option value="125">Extra Large (125px)</option>';
                       html_gravatar += '</select>';
                       html_gravatar += '</td>';
                       html_gravatar += '<td> </td>';
                       html_gravatar += '</tr>';
                       html_gravatar += '<tr>';
                       html_gravatar += '<td>';
                       html_gravatar += '<label for="description">Gravatar Alignment </label>';
                       html_gravatar += '<select id="gravatar_align_select_id" name="gravatar_align_select[]" class="gravatar_align_select_class">';
                       html_gravatar += '<option>Select Align</option>';
                       html_gravatar += '<option value="1">Left</option>';
                       html_gravatar += '<option value="2">Right</option>';
                       html_gravatar += '</select>';
                       html_gravatar += '</td>';
                       html_gravatar += '</tr>';
                       html_gravatar += '</tbody>';
                       html_gravatar += '</table>';
                       
                       PostItem[4] = html_gravatar;
                       
                       html_slid = '';
                       html_slid += '<table id="option-form-field-table">';
                       html_slid += '<tbody>';
                       html_slid += '<tr class="label">';
                       html_slid += '<td>';
                       html_slid += '<label for="description"></label>';
                       html_slid += '<input id="browse_post_data_id" class="browse_post_data_class button media-button button-primary button-large media-button-select" type="text" name="browse_post_data[]" value="Browse..."/>';
                       html_slid += '<div class="browse_post_data_display"><div style="clear:both;"></div></div>';
                       html_slid += '</td>';
                       html_slid += '</tr>';
                       html_slid += '<tr class="label">';
                       html_slid += '</tr>';
                       html_slid += '</tbody>';
                       html_slid += '</table>';
                       
                       PostItem[5] = html_slid;
                       
                       html_date = '';
                       html_date += '<table id="option-form-field-table">';
                       html_date += '<tbody>';
                       html_date += '<tr class="label">';
                       html_date += '<td>';
                       html_date += '<label for="description">Date </label>';
                       html_date += '<input id="date_post_format_id" class="date_post_format_class" type="submit" name="date_post_format[]" value="d M Y"/>';
                       html_date += '<label for="description"> Post Format</label>';
                       html_date += '</td>';
                       html_date += '</tr>';
                       html_date += '<tr class="label">';
                       html_date += '</tr>';
                       html_date += '</tbody>';
                       html_date += '</table>';
                       
                       PostItem[6] = html_date;
                       
                       html_cat = '';
                       html_cat += '<table id="option-form-field-table">';
                       html_cat += '<tbody>';
                       html_cat += '<tr class="label">';
                       html_cat += '<td>';
                       html_cat += '<label for="description">Category selected</label>';
                       html_cat += '</td>';
                       html_cat += '</tr>';
                       html_cat += '<tr class="label">';
                       html_cat += '</tr>';
                       html_cat += '</tbody>';
                       html_cat += '</table>';
                       
                       PostItem[7] = html_cat;
                       
                       html_aut = '';
                       html_aut += '<table id="option-form-field-table">';
                       html_aut += '<tbody>';
                       html_aut += '<tr class="label">';
                       html_aut += '<td>';
                       html_aut += '<label for="description"></label>';
                       html_aut += '<label for="description">Author Meta:</label>';
                       html_aut += '<input id="date_post_format_id" class="author_post_field_class " type="text" name="author_post_field[]" value="user_nicename" />';
                       html_aut += '<code>(m1,m2)</code>';
                       html_aut += '<a href="javascript:void(0);" class="help-link"> Help?</a>';
                       html_aut += '</td>';
                       html_aut += '</tr>';
                       html_aut += '<tr class="label">';
                       html_aut += '</tr>';
                       html_aut += '</tbody>';
                       html_aut += '</table>';
                       
                       PostItem[8] = html_aut;
                       
                       var post_item_html = PostItem[val];
                       
                       jQuery(this).parent().parent().find("div.post-option-form-field").html( post_item_html );
                       
                       if( val.length == 1 ){
                           
                           /**
                            * Title values
                           **/ 
                        
                           post_option_items.find('input.show_post_title_class').addClass( post_id );
                           post_option_items.find('input.show_post_title_class').attr( "name", 'show_post_title'+post_id+'[]' );
                           
                           post_option_items.find('input.limit_post_title_class').addClass( post_id );
                           post_option_items.find('input.limit_post_title_class').attr( "name", 'limit_post_title'+post_id+'[]' );
                           
                           post_option_items.find('input.font_size_text_title_class').addClass( post_id );
                           post_option_items.find('input.font_size_text_title_class').attr( "name", 'font_size_text_title'+post_id+'[]' );
                           
                           post_option_items.find('input.more_post_text_content_class').addClass( post_id );
                           post_option_items.find('input.more_post_text_content_class').attr( "name", 'more_post_text_content'+post_id+'[]' );
                           
                           /**
                            * Content values
                           **/
                           
                           post_option_items.find('input.show_post_content_class').addClass( post_id );
                           post_option_items.find('input.show_post_content_class').attr( "name", 'show_post_content'+post_id+'[]' );
                           
                           post_option_items.find('input.limit_post_content_class').addClass( post_id );
                           post_option_items.find('input.limit_post_content_class').attr( "name", 'limit_post_content'+post_id+'[]' );
                           
                           post_option_items.find('input.font_size_content_text_class').addClass( post_id );
                           post_option_items.find('input.font_size_content_text_class').attr( "name", 'font_size_content_text'+post_id+'[]' );
                           
                           post_option_items.find('input.more_post_content_text_class').addClass( post_id );
                           post_option_items.find('input.more_post_content_text_class').attr( "name", 'more_post_content_text'+post_id+'[]' );
                           
                           /**
                            * Images values
                           **/
                           
                           post_option_items.find('input.show_post_featured_class').addClass( post_id );
                           post_option_items.find('input.show_post_featured_class').attr( "name", 'show_post_featured'+post_id+'[]' );
                           
                           post_option_items.find('select.image_size_select_class').addClass( post_id );
                           post_option_items.find('select.image_size_select_class').attr( "name", 'image_size_select'+post_id+'[]' );
                           
                           post_option_items.find('select.image_align_select_class').addClass( post_id );
                           post_option_items.find('select.image_align_select_class').attr( "name", 'image_align_select'+post_id+'[]' );
                           
                           /**
                            * gravatar values
                           **/
                           
                           post_option_items.find('input.show_post_gravatar_class').addClass( post_id );
                           post_option_items.find('input.show_post_gravatar_class').attr( "name", 'show_post_gravatar'+post_id+'[]' );
                           
                           post_option_items.find('select.gravatar_size_select_class').addClass( post_id );
                           post_option_items.find('select.gravatar_size_select_class').attr( "name", 'gravatar_size_select'+post_id+'[]' );
                           
                           post_option_items.find('inselectput.gravatar_align_select_class').addClass( post_id );
                           post_option_items.find('select.gravatar_align_select_class').attr( "name", 'gravatar_align_select'+post_id+'[]' );
                           
                           /**
                            * addons (date) values
                           **/
                           
                           post_option_items.find('input.date_post_format_class').addClass( post_id );
                           post_option_items.find('input.date_post_format_class').attr( "name", 'date_post_format'+post_id+'[]' );
                           
                           /**
                            * addons (author) values
                           **/
                           
                           post_option_items.find('input.author_post_field_class').addClass( post_id );
                           post_option_items.find('input.author_post_field_class').attr( "name", 'author_post_field'+post_id+'[]' );
                             
                       } 
                       
                   }
               });
               
               console.log( ui.item ); //ui.item.context
               
               postItemsBuild();
               
         }
     });
     
     /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
       * Post sort action script 2
       * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     **/ 
           
     jQuery('div.post-option-form-content').sortable({
         connectWith:'div.option-form-field',
         items: 'div.post-option-content',
         appendTo: document.body,
         helper: fixHelper,
         revert: 100,
         placeholder:'ui-state-highlight',
         stop: function(event, ui){
               
               jQuery("div.option-form-field").find('input.post_field_option_id').attr("name", "post_field_option_id_val[]");   
               
               jQuery("div.option-form-field").find('input.post_field_option_id').attr("class", "post_field_option_id_val");    
               
               var option_id = []; 
               jQuery('input.post_field_option_id_val').each( function(key, value) {
                   if( jQuery(this).parent().find("span.post-option-arrow").length == 0 ){
                       jQuery(this).after("<span class='post-remove-icon post-remove-icon-selected'></span><span class='post-option-arrow post-optin-arrow-selected'></span>");
                   }
               });
               
               jQuery('input.post_field_option_id_val').each( function(key, value) {
                   if( jQuery(this)){
                       
                       var post_id = jQuery(this).parent().parent().parent().parent().find("input.post_field_option_id").attr("value");
                       var post_option_items = jQuery(this).parent().parent();
                       
                       var val = jQuery(this).attr("value");

                       if( val.length == 1 ){
                           jQuery(this).attr( "value", post_id+"="+val );
                       }

                       var PostItem = [];
                       
                       /**
                         * Title option generated form item
                       **/
                       
                       html_title = '';
                       html_title += '<table id="option-form-field-table">';
                       html_title += '<tbody>';
                       html_title += '<tr class="label">';
                       html_title += '<td>';
                       html_title += '<input id="show_post_title_id" class="show_post_title_class" type="checkbox" value="1" name="show_post_title">';
                       html_title += '<label for="description"> Show Post Title</label>';
                       html_title += '</td>';
                       html_title += '</tr>';
                       html_title += '<tr class="label">';
                       html_title += '<td>';
                       html_title += '<label for="description">Limit Content to </label>';
                       html_title += '<input id="limit_post_title_id" class="limit_post_title_class" type="text" maxlength="50" value="100" name="limit_post_title">';
                       html_title += '<label for="description"> Characters</label>';
                       html_title += '</td>';
                       html_title += '</tr>';
                       html_title += '<tr class="label">';
                       html_title += '<td>';
                       html_title += '<label for="description">Font Size </label>';
                       html_title += '<input id="font_size_text_title_id" class="font_size_text_title_class" type="text" maxlength="50" value="12px" name="font_size_text_title[]">';
                       html_title += '<label for="description">More Text</label>';
                       html_title += '<input id="more_post_text_content_id" class="more_post_text_content_class" type="text" maxlength="50" value="More Text" name="more_post_text_content[]">';
                       html_title += '</td>';
                       html_title += '</tr>';
                       html_title += '<tr>';
                       html_title += '<td></td>';
                       html_title += '</tr>';
                       html_title += '</tbody>';
                       html_title += '</table>';
                       
                       PostItem[1] = html_title;
                       
                       html_content = '';
                       html_content += '<table id="option-form-field-table">';
                       html_content += '<tbody>';
                       html_content += '<tr class="label">';
                       html_content += '<td>';
                       html_content += '<input id="show_post_content_id" class="show_post_content_class" type="checkbox" value="1" name="show_post_content[]">';
                       html_content += '<label for="description"> Show Post Content</label>';
                       html_content += '</td>';
                       html_content += '</tr>';
                       html_content += '<tr class="label">';
                       html_content += '<td>';
                       html_content += '<label for="description">Limit Content to </label>';
                       html_content += '<input id="limit_post_content_id" class="limit_post_content_class" type="text" maxlength="50" value="100" name="limit_post_content[]">';
                       html_content += '<label for="description"> Characters</label>';
                       html_content += '</td>';
                       html_content += '</tr>';
                       html_content += '<tr class="label">';
                       html_content += '<td>';
                       html_content += '<label for="description">Font Size </label>';
                       html_content += '<input id="font_size_content_text_id" class="font_size_content_text_class" type="text" maxlength="50" value="12px" name="font_size_content_text[]">';
                       html_content += '<label for="description">More Text</label>';
                       html_content += '<input id="more_post_content_text_id" class="more_post_content_text_class" type="text" maxlength="50" value="More Text" name="more_post_content_text[]">';
                       html_content += '</td>';
                       html_content += '</tr>';
                       html_content += '<tr>';
                       html_content += '<td></td>';
                       html_content += '</tr>';
                       html_content += '</tbody>';
                       html_content += '</table>';
                       
                       PostItem[2] = html_content;
                       
                       html_image = '';
                       html_image += '<table id="option-form-field-table">';
                       html_image += '<tbody>';
                       html_image += '<tr class="label">';
                       html_image += '<td>';
                       html_image += '<input id="show_post_featured_id" class="show_post_featured_class" type="checkbox" value="1" name="show_post_featured[]">';
                       html_image += '<label for="description"> Show Post Featured</label>';
                       html_image += '</td>';
                       html_image += '</tr>';
                       html_image += '<tr class="label">';
                       html_image += '<td>';
                       html_image += '<label for="description">Image Size </label>';
                       html_image += '<select id="image_size_select_id" name="image_size_select[]" class="image_size_select_class">';
                       html_image += '<option>Select Size</option>';
                       html_image += '<option selected="" value="0">thumbnail</option>';
                       html_image += '<option value="1">medium</option>';
                       html_image += '<option value="2">large</option>';
                       html_image += '<option value="3">post-thumbnail</option>';
                       html_image += '</select>';
                       html_image += '</td>';
                       html_image += '<td> </td>';
                       html_image += '</tr>';
                       html_image += '<tr>';
                       html_image += '<td>';
                       html_image += '<label for="description">Image Alignment </label>';
                       html_image += '<select id="image_align_select_id" name="image_align_select[]" class="image_align_select_class">';
                       html_image += '<option>Select Align</option>';
                       html_image += '<option value="1">Left</option>';
                       html_image += '<option value="2">Right</option>';
                       html_image += '</select>';
                       html_image += '</td>';
                       html_image += '</tr>';
                       html_image += '</tbody>';
                       html_image += '</table>';
                       
                       PostItem[3] = html_image;

                       html_gravatar = '';
                       html_gravatar += '<table id="option-form-field-table">';
                       html_gravatar += '<tbody>';
                       html_gravatar += '<tr class="label">';
                       html_gravatar += '<td>';
                       html_gravatar += '<input id="show_post_gravatar_id" class="show_post_gravatar_class" type="checkbox" value="1" name="show_post_gravatar[]">';
                       html_gravatar += '<label for="description"> Show Post Gravatar</label>';
                       html_gravatar += '</td>';
                       html_gravatar += '</tr>';
                       html_gravatar += '<tr class="label">';
                       html_gravatar += '<td>';
                       html_gravatar += '<label for="description">Gravatar Size </label>';
                       html_gravatar += '<select id="gravatar_size_select_id" name="gravatar_size_select[]" class="gravatar_size_select_class">';
                       html_gravatar += '<option>Select Size</option>';
                       html_gravatar += '<option value="45">Small (45px)</option>';
                       html_gravatar += '<option value="65">Medium (65px)</option>';
                       html_gravatar += '<option value="85">Large (85px)</option>';
                       html_gravatar += '<option value="125">Extra Large (125px)</option>';
                       html_gravatar += '</select>';
                       html_gravatar += '</td>';
                       html_gravatar += '<td> </td>';
                       html_gravatar += '</tr>';
                       html_gravatar += '<tr>';
                       html_gravatar += '<td>';
                       html_gravatar += '<label for="description">Gravatar Alignment </label>';
                       html_gravatar += '<select id="gravatar_align_select_id" name="gravatar_align_select[]" class="gravatar_align_select_class">';
                       html_gravatar += '<option>Select Align</option>';
                       html_gravatar += '<option value="1">Left</option>';
                       html_gravatar += '<option value="2">Right</option>';
                       html_gravatar += '</select>';
                       html_gravatar += '</td>';
                       html_gravatar += '</tr>';
                       html_gravatar += '</tbody>';
                       html_gravatar += '</table>';
                       
                       PostItem[4] = html_gravatar;
                       
                       html_slid = '';
                       html_slid += '<table id="option-form-field-table">';
                       html_slid += '<tbody>';
                       html_slid += '<tr class="label">';
                       html_slid += '<td>';
                       html_slid += '<label for="description"></label>';
                       html_slid += '<input id="browse_post_data_id" class="browse_post_data_class button media-button button-primary button-large media-button-select" type="submit" name="browse_post_data[]" value="Browse..."/>';
                       html_slid += '<div class="browse_post_data_display"><div style="clear:both;"></div></div>';
                       html_slid += '</td>';
                       html_slid += '</tr>';
                       html_slid += '<tr class="label">';
                       html_slid += '</tr>';
                       html_slid += '</tbody>';
                       html_slid += '</table>';
                       
                       PostItem[5] = html_slid;
                       
                       html_date = '';
                       html_date += '<table id="option-form-field-table">';
                       html_date += '<tbody>';
                       html_date += '<tr class="label">';
                       html_date += '<td>';
                       html_date += '<label for="description">Date </label>';
                       html_date += '<input id="date_post_format_id" class="date_post_format_class " type="text" name="date_post_format[]" value="d M Y"/>';
                       html_date += '<label for="description"> Post Format</label>';
                       html_date += '</td>';
                       html_date += '</tr>';
                       html_date += '<tr class="label">';
                       html_date += '</tr>';
                       html_date += '</tbody>';
                       html_date += '</table>';
                       
                       PostItem[6] = html_date;
                       
                       html_cat = '';
                       html_cat += '<table id="option-form-field-table">';
                       html_cat += '<tbody>';
                       html_cat += '<tr class="label">';
                       html_cat += '<td>';
                       html_cat += '<label for="description">Category selected</label>';
                       html_cat += '</td>';
                       html_cat += '</tr>';
                       html_cat += '<tr class="label">';
                       html_cat += '</tr>';
                       html_cat += '</tbody>';
                       html_cat += '</table>';
                       
                       PostItem[7] = html_cat;
                       
                       html_aut = '';
                       html_aut += '<table id="option-form-field-table">';
                       html_aut += '<tbody>';
                       html_aut += '<tr class="label">';
                       html_aut += '<td>';
                       html_aut += '<label for="description">Author Meta:</label>';
                       html_aut += '<input id="date_post_format_id" class="author_post_field_class " type="text" name="author_post_field[]" value="user_nicename" />';
                       html_aut += '<code>(m1,m2)</code>';
                       html_aut += '<a href="javascript:void(0);" class="help-link"> Help?</a>';
                       html_aut += '</td>';
                       html_aut += '</tr>';
                       html_aut += '<tr class="label">';
                       html_aut += '</tr>';
                       html_aut += '</tbody>';
                       html_aut += '</table>';
                       
                       PostItem[8] = html_aut;      
                       
                       var post_item_html = PostItem[val];
                       
                       jQuery(this).parent().parent().find("div.post-option-form-field").html( post_item_html );
                       
                       if( val.length == 1 ){
                        
                           /**
                            * Title values
                           **/ 
                        
                           post_option_items.find('input.show_post_title_class').addClass( post_id );
                           post_option_items.find('input.show_post_title_class').attr( "name", 'show_post_title'+post_id+'[]' );
                           
                           post_option_items.find('input.limit_post_title_class').addClass( post_id );
                           post_option_items.find('input.limit_post_title_class').attr( "name", 'limit_post_title'+post_id+'[]' );
                           
                           post_option_items.find('input.font_size_text_title_class').addClass( post_id );
                           post_option_items.find('input.font_size_text_title_class').attr( "name", 'font_size_text_title'+post_id+'[]' );
                           
                           post_option_items.find('input.more_post_text_content_class').addClass( post_id );
                           post_option_items.find('input.more_post_text_content_class').attr( "name", 'more_post_text_content'+post_id+'[]' );
                           
                           /**
                            * Content values
                           **/
                           
                           post_option_items.find('input.show_post_content_class').addClass( post_id );
                           post_option_items.find('input.show_post_content_class').attr( "name", 'show_post_content'+post_id+'[]' );
                           
                           post_option_items.find('input.limit_post_content_class').addClass( post_id );
                           post_option_items.find('input.limit_post_content_class').attr( "name", 'limit_post_content'+post_id+'[]' );
                           
                           post_option_items.find('input.font_size_content_text_class').addClass( post_id );
                           post_option_items.find('input.font_size_content_text_class').attr( "name", 'font_size_content_text'+post_id+'[]' );
                           
                           post_option_items.find('input.more_post_content_text_class').addClass( post_id );
                           post_option_items.find('input.more_post_content_text_class').attr( "name", 'more_post_content_text'+post_id+'[]' );
                           
                           /**
                            * Images values
                           **/
                           
                           post_option_items.find('input.show_post_featured_class').addClass( post_id );
                           post_option_items.find('input.show_post_featured_class').attr( "name", 'show_post_featured'+post_id+'[]' );
                           
                           post_option_items.find('select.image_size_select_class').addClass( post_id );
                           post_option_items.find('select.image_size_select_class').attr( "name", 'image_size_select'+post_id+'[]' );
                           
                           post_option_items.find('select.image_align_select_class').addClass( post_id );
                           post_option_items.find('select.image_align_select_class').attr( "name", 'image_align_select'+post_id+'[]' );
                           
                           /**
                            * gravatar values
                           **/
                           
                           post_option_items.find('input.show_post_gravatar_class').addClass( post_id );
                           post_option_items.find('input.show_post_gravatar_class').attr( "name", 'show_post_gravatar'+post_id+'[]' );
                           
                           post_option_items.find('select.gravatar_size_select_class').addClass( post_id );
                           post_option_items.find('select.gravatar_size_select_class').attr( "name", 'gravatar_size_select'+post_id+'[]' );
                           
                           post_option_items.find('select.gravatar_align_select_class').addClass( post_id );
                           post_option_items.find('select.gravatar_align_select_class').attr( "name", 'gravatar_align_select'+post_id+'[]' );
                           
                           /**
                            * addons (date) values
                           **/
                           
                           post_option_items.find('input.date_post_format_class').addClass( post_id );
                           post_option_items.find('input.date_post_format_class').attr( "name", 'date_post_format'+post_id+'[]' );
                           
                           /**
                            * addons (author) values
                           **/
                           
                           post_option_items.find('input.author_post_field_class').addClass( post_id );
                           post_option_items.find('input.author_post_field_class').attr( "name", 'author_post_field'+post_id+'[]' );
                           
                       } 
                   }
               });
               
               console.log( ui.item ); //ui.item.context
               
               postItemsBuild();

         }
     }); 
     
     /** xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
       * Sticky post area sortable script
       * xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     **/
     
     jQuery('div#stick-post-option-content').sortable({
         connectWith:'div.option-form-content',
         items: 'div#post-stick-form',
         appendTo: document.body,
         helper: fixHelper,
         revert: 100,
         placeholder:'ui-state-highlight',
         stop: function(event, ui){

              jQuery('div.post-stick-form-label').each( function(key, value) {
                  var active_true = jQuery(this).find(".option-luck");
                  if( active_true.length == 0 ){
                      jQuery(this).find(".post-stick-label").after('<span class="option-luck optin-luck-icon"></span><span class="option-arrow"><input id="post_field_option_id" class="post_field_option_id" type="hidden" value="" name="option_post_sort_id[]"></span>');
                  }
              });
              
              jQuery("div.post-stick-form-field").each(function(key, value){
                  var exists = jQuery(this).find(".post-select-filter");
                  if( exists.length == 0 ){
                      var postSelect = jQuery("div.post-filter-list").html();    
                      jQuery(this).prepend( '<div id="post-select-filter" class="post-select-filter">' + postSelect + '</div>' );
                  }
              });
               
              console.log( ui.item ); //ui.item.context
              
              stickyItemsBuild();
              
         }
     });
     

     jQuery(".switch-container").on("click", ".switch", function  (e) {
          var method = jQuery(this).hasClass("active") ? "disable" : "enable";
          
          jQuery(this).hasClass("active") ? jQuery(this).removeClass("active") : jQuery(this).addClass("active");

          jQuery(e.delegateTarget).parent().next().find("div.option-form-content").sortable(method);
     });
     
});  