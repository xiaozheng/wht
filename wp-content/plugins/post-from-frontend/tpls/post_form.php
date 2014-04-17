
    
    <script type="text/javascript">
    var filenames="";
    </script>
<style>
.user-post{
    border: 1px solid #cccccc;
}
</style>
<div class="wrap">
<form action="" method="post" name="wppu" id="wppu" enctype="multipart/form-data" >
<input type="hidden" name="home" value="<?php the_permalink(); ?>" > 
<input type="hidden" name="action" value="wppu_save_post"> 
<input type="hidden" name="task" value="<?php echo $_REQUEST['task'];?>">
<input type="hidden" name="postid" id="postid" value="<?php if($thispost->ID) echo $thispost->ID; ?>">
 

<ul class="formstyle"> 
  
   <li> 
         <input placeholder="Enter title here" type="text" value="<?php if(!empty($thispost->post_title))echo $thispost->post_title;?>" name="user_post_title" id="user_post_title" >
      </li>
   <li> 
         <div style="clear: both;"></div>
         <!--<textarea name="user_post_desc" id="user_post_desc" style="width: 532px; height: 137px;"><?php if(!empty($thispost->post_content))echo $thispost->post_content;?></textarea>-->
         <?php wp_editor($thispost->post_content,'user_post_desc', false, false); ?>
      </li>
   <li>
    <div class="wrap">
        <div style="margin-top: 10px;"></div>
        
        <div id="poststuff" >
            <div class="postbox " id="quick-notice-options">
        
                <div title="Click to toggle" class="handlediv"><br></div>
                <h3 class="hndle"><span>Category :</span></h3>
                <div class="inside">
                    <div id="postcustomstuff">
   
         <?php 
    $term_list = wp_get_post_terms($thispost->ID, 'category', array("fields" => "all"));        
    //$term_list = get_the_category($thispost->ID);
    
    function wpup_product_types_checkboxed_tree($parent = 0, $selected = array()){        
        $categories = get_categories( array('hide_empty'=>0,'parent'=>$parent));           
        foreach($categories as $category){
            if($selected){
            foreach($selected as $ptype){
                if($ptype->term_id==$category->term_id){$checked="checked='checked'";break;}else $checked="";
            }
            }
            echo '<li><input type="checkbox" '.$checked.' name="cat[]" value="'.$category->term_id.'"> '.$category->name.' ';
            echo "<ul>";
            wpup_product_types_checkboxed_tree($category->term_id, $selected);    
            echo "</ul>";
            echo "</li>";
        }        
    }
    
    echo "<ul class='ptypes'>";
    wpup_product_types_checkboxed_tree(0, $term_list);
    echo "</ul>";
    ?>
    </div>
    </div>
    </div>
    </div>
    </div>
    
     </li>
    
       
     
     <?php //div for excerpt?> 
     
     <li>
      
     <div class="wrap">
        <div style="margin-top: 10px;"></div> 
        <div id="poststuff" >
            <div class="postbox " id="quick-notice-options">
            
                <div title="Click to toggle" class="handlediv"><br></div><h3 class="hndle"><span>Excerpt :</span></h3>
                 <div class="inside">
                        <div id="postcustomstuff">
                <div id="custom_box">
                
               <textarea name="user_post_excerpt" id="user_post_excerpt"  cols="8" rows="2"><?php if(!empty($user_post_excerpt[0]))echo $user_post_excerpt[0];?></textarea>
                </div>
                </div>
                </div>
                
            </div>  
        </div>
    </div>
     </li>
         
    
    
       <li>
       
       <div style="clear: both;"></div>
         <input type="submit"   name="user_post_submit" id="user_post_submit" value="Submit">
         <input type="reset" value="Cancel"  name="cancel" id="cancel" onclick="location.href='<?php the_permalink();?>'">
      </li>
 </ul>
</form> 
</div>
<script type="text/javascript">
    
   <?php $upload_dir = wp_upload_dir();
   $extensions=get_option('_wpup_extension');
   $extension=explode(",",$extensions);
   $exts="";
   for($j=0;$j<count($extension);$j++){
       $exts="*.".$extension[$j].";".$exts;
   }
   ?> 
           
    var filenames=new Array();
    
    </script>
<script language="JavaScript">
    
    jQuery('.delimg').live('click',function(){
        //alert(jQuery(this).attr('rel'));
            if(confirm('Are you sure?')){
                jQuery('#'+jQuery(this).attr('rel')).fadeOut().remove();
                jQuery.post('<?php echo the_permalink(). $concat."task=wpup-delete-media"; ?>',
                    {postid:jQuery(this).attr('rel')
                     
                    },
                    function(data){                    
                });
            }  
        });  
        
       //function for adding the custom field 
       jQuery('#addmesub').live('click',function(){
           var t=new Date().getTime();
           var field=jQuery('#field').val();
           var field_values= jQuery('#valu').val();
           //alert(field+field_values) ;
              jQuery('#list-table tr:last').after('<tr class="inside_'+t+'"><td class="left" id="list-tableleft"><input type="text" value="'+field+'" name="custom_fields[]" > <div class="submit"><input type="button"  value="Delete" class="delete_fields" rel="inside_'+t+'"  style="cursor:pointer"  title="Delete this field" /></div></td><td><textarea name="custom_values[]" >'+field_values+'</textarea></td><td></td></tr>');
           });
           
        jQuery('.delete_fields').live('click',function(){
            if(confirm("Are you sure you want to delete?")){
            
            jQuery("."+jQuery(this).attr('rel')).slideUp(function(){jQuery(this).remove();});
         
    }
        }); 
        
         //function for adding tag values into div
        jQuery('#tagadd').live('click',function(){
            if(jQuery('#taginput').val()!= ""){ 
                var t=new Date().getTime();           
                jQuery("#tagdiv").append('<div class="tagdivc" id="tagdiv_'+t+'"><input type="hidden" name="user_post_tag[]" value="'+jQuery('#taginput').val()+'"><img rel="tagdiv_'+t+'" class="xit" src="<?php echo plugins_url('/post-from-frontend/images/xit.gif')?>">'+jQuery('#taginput').val()+'</div>');                 
                jQuery('#taginput').val("");
            }
        }); 
        
        jQuery('.xit').live('click',function(){
           jQuery("#"+jQuery(this).attr('rel')).remove();  
        });  
    
    </script>
</div> <!-- ending div for wrapper-->  