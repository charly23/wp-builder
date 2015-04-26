<?php $oid = isset(input::get_is_object()->oid) ? intval( input::get_is_object()->oid ) : null; ?>
<?php
   if(intval($oid)){
      $sql_row = db::query_rows('bulder_option', "WHERE id=$oid", 'desc');
      if(!empty($sql_row)){
          $option_value = unserialize($sql_row->options);
      }
   } else {
      $option_value = array();
   }
?>
<?php
if( isset(input::get_is_object()->oid ) ){
    
   $icon_title = "Edit Option";
   $icon_label = "Update a option and display them to this site."; 
   
} else { 
   if ( isset(input::get_is_object()->pid ) ){
    
       $icon_title = "Add Post Images";
       $icon_label = "Upload a brand new images and add them to this site.";
       
   } else { 
       $icon_title = "Add New Option";
       $icon_label = "Create a brand new option and add them to this site.";
   }
}
?>

<?php echo html::icon_logo( $icon_title, $icon_label, true ); ?>

<?php echo input::form_open(array( 'method' => 'post')); ?>

<?php if ( !isset(input::get_is_object()->pid ) ){ ?>

<script type="text/javascript">
jQuery(function(){ 
                        
     var fixHelper = function(e,ui){
         ui.children().each(function() {
            jQuery(this).width(jQuery(this).width());
         });
         return ui;
     };
           
     jQuery('div.option-form-content').sortable({
         items: 'div.option-form-sort',
         helper: fixHelper,
         placeholder:'ui-state-highlight',
         stop: function(event, ui){ }
     }); 
});     
</script>

<div id="option-form-content">
    
    <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx option field start xxxxxxxxxxxxxxxxxxxxxxxx -->
    
    <div id="post-form-content">
    
        <div id="option-form" class="option-form">
            <div id="option-form-label" class="option-form-label"> 
                <span class="option-label option-label-edit-icon"><?php echo html::label(array( 'text' => 'Option', 'for' => 'description' )); ?></span>
                <span class="option-arrow"></span>
            </div>
            <div id="option-form-field" class="option-form-field"><?php load::view('option/option'); ?></div>
        </div>
        
        <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx option field end xxxxxxxxxxxxxxxxxxxxxxxx -->
        
        <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx post field start xxxxxxxxxxxxxxxxxxxxxxxx -->
         
        <div id="option-form" class="option-form">
            <div id="option-form-label" class="option-form-label"> 
                    <span class="option-label option-label-edit-icon"><?php echo html::label(array( 'text' => 'Post', 'for' => 'description' )); ?></span>
                    <span class="option-arrow"></span>
            </div>
            <div id="option-form-field" class="option-form-field"><?php load::view('option/post'); ?></div>
        </div>
    
    </div>

    <div style="clear: both;"></div>
    
    <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx post field end xxxxxxxxxxxxxxxxxxxxxxxx -->
    
    <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx posts data field start xxxxxxxxxxxxxxxxxxxxxxxx -->
    
    
    <div id="option-form-label-sort-area" id="option-form-label-sort-area">
        <h1>Post Sortable Area</h1>
        <div class="switch-container">
            <div class="switch active" data-toggle="switch" data-on="ON" data-off="OFF">
                <span class="switch-track"></span>
                <span class="switch-thumb" data-on="ON" data-off="OFF"></span>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
    
    <div id="option-form-post-manager"><?php load::view('option/form'); ?></div>
    
    <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx posts data field end xxxxxxxxxxxxxxxxxxxxxxxx -->
    
</div>

<?php } else { ?>

<div id="option-form-content">
    <div id="option-form-upload"><?php load::view('option/upload'); ?></div>
</div> 

<?php } ?>

<div id="option-form-submit">
    <?php
       
       if( isset(input::get_is_object()->oid ) ){

           $update_option = array( 
                                   'name' => 'update_option', 
                                   'value' => 'Update Option',
                                   'id' => 'update_option_id',
                                   'class' => 'update_option_class',
                                );
        
           echo input::submit( $update_option );
       
       } else {
           
           if ( isset(input::get_is_object()->pid ) ){
                
                
               $save_images = array( 
                                       'name' => 'save_images', 
                                       'value' => 'Save Images',
                                       'id' => 'save_images_id',
                                       'class' => 'save_images_class',
                                    );
            
               echo input::submit( $save_images ); 
           
           } else {
           
               $save_option = array( 
                                       'name' => 'save_option', 
                                       'value' => 'Save Option',
                                       'id' => 'save_option_id',
                                       'class' => 'save_option_class',
                                    );
            
               echo input::submit( $save_option );
               
          }  
       
       }    
       
    ?> 
</div>    

<?php echo input::form_close(); ?>