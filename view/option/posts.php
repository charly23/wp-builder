<?php $oid = isset(input::get_is_object()->oid) ? intval( input::get_is_object()->oid ) : null; ?>
<?php
      if( intval($oid)){
        
          $sql_row = db::query_rows('bulder_option', "WHERE id=$oid", 'desc');
          if(!empty($sql_row)){
               $post_checked = unserialize($sql_row->post_checked);
          }
      } else {
          $post_checked = array();
      }
?>
<div class="search-filter-wrap">
    <div class="search-filter-tab"><span class="tab1" id="tab1">Search</span></div>
    <div class="search-filter-action">
        <div class="tab1-content">
            <input type="text" name="search_filter" id="search_filter_input" class="search_filter_input" />
            <span class="search-filter-status"></span>
            <span class="tab2" id="tab2">All</span>    
        </div>
    </div>  
</div>
<div class="post-data-wrap">
  <?php
   
   $posts_sql = db::posts_execute('desc');
   if( !empty($posts_sql)){
       foreach($posts_sql as $posts_sql_keys => $posts_sql_res ){
        
        if( in_array( intval( $posts_sql_res->ID), $post_checked ) ){
   ?>
              <div class="post-data-label">
                  <span class="post-sort-icon"><input id="show_post_val_id" class="show_post_val_class" checked="" type="checkbox" name="show_post_val[]" value="<?php echo intval($posts_sql_res->ID); ?>"/><?php echo get_the_title($posts_sql_res->ID); ?></span>
              </div>
   <?php         
        } else {    
   ?>
              <div class="post-data-label">
                  <span class="post-sort-icon"><input id="show_post_val_id" class="show_post_val_class" type="checkbox" name="show_post_val[]" value="<?php echo intval($posts_sql_res->ID); ?>"/><?php echo get_the_title($posts_sql_res->ID); ?></span>
              </div>
   <?php     
          }     
       }         
   }
   ?>
</div>