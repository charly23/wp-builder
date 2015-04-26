jQuery(function(){
    
        jQuery("span#tab2").click(function(){
                
                var ajaxurl = ajax_script.ajax_url;
                var clear   = '';
                
                jQuery.ajax ({
                                  data: { action  : 'ajax_search_all', },
                                  type   : 'POST',
                                  url    : ajaxurl,
                                  beforeSend: function() {
                                       jQuery("span.search-filter-status").css({'display':'inline-block'});
                                  },
                                  error: function(xhr, status, err) {
                                       // Handle errors
                                  },
                                  success: function(html, data) {
                                       jQuery("div.post-data-wrap").html( html );
                                  }
                            }).done(function( html, data ) {
                                  jQuery("span.search-filter-status").fadeOut();
                                  jQuery("input#search_filter_input").val( clear );
                            });

        });
        
        jQuery("input#search_filter_input").keyup(function(){
                
                var val     = jQuery(this).val();
                var ajaxurl = ajax_script.ajax_url;
                
                if( val ){
                    
                    jQuery.ajax ({
                                      data: { action  : 'ajax_search_action',
                                              keyval  : val,
                                      },
                                      type   : 'POST',
                                      url    : ajaxurl,
                                      beforeSend: function() {
                                           jQuery("span.search-filter-status").css({'display':'inline-block'});
                                      },
                                      error: function(xhr, status, err) {
                                           // Handle errors
                                      },
                                      success: function(html, data) {
                                           jQuery("div.post-data-wrap").html( html );
                                      }
                                }).done(function( html, data ) {
                                      jQuery("span.search-filter-status").fadeOut();
                                });
                } 
        });
        
        jQuery("select#post_category_id").change(function(){
                
                var value   = jQuery(this).val();
                var ajaxurl = ajax_script.ajax_url;
                
                if( value ){
                    
                    jQuery.ajax ({
                                      data: { action  : 'ajax_category_search_action',
                                              keyval  : value,
                                      },
                                      type   : 'POST',
                                      url    : ajaxurl,
                                      beforeSend: function() {
                                           jQuery("span.search-filter-status").css({'display':'inline-block'});
                                      },
                                      error: function(xhr, status, err) {
                                           // Handle errors
                                      },
                                      success: function(html, data) {
                                           jQuery("div.post-data-wrap").html( html );
                                      }
                                }).done(function( html, data ) {
                                      jQuery("span.search-filter-status").fadeOut();
                                });
                } 
                 
        });
        
    
});