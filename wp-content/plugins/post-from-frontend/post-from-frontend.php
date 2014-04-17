<?php
/*
Plugin Name: Post From Frontend
Plugin URI: http://wpeden.com/product/frontend-post-manager-lite/
Description: WordPress Post From Frontend Plugin is to allow user to create and manage posts, edit profiles info from front-end
Author: Shaon
Version: 1.0.0
Author URI: http://wpeden.com/
*/

session_start();

global $sap;
 
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);

if(function_exists('get_option')){
if ( get_option('permalink_structure') != '' ) $sap = '?';
else $sap = "&";
}
 
    

 
function  wpup_user_post_list(){
    global $current_user;
    $user_posts=get_posts('author='.$current_user->ID.'&post_status=publish,draft&numberposts=-1');
    include_once("tpls/user_post_list.php");
}  


function wpup_posting_form_submit(){
    global $current_user;
    if(isset($_POST['action'])&&$_POST['action']=="wppu_save_post"){
        
            if($_POST['user_post_title']){
            $post_status = get_option('_wppu_fstatus','publish');                 
            $my_post = array(
                 'post_title' => $_POST['user_post_title'],
                 'post_content' => $_POST['user_post_desc'],
                 'post_status' => $post_status,
                 'post_author' => $current_user->ID,
                 'post_category' => $_POST['cat']
              );
              if($_REQUEST['task']=="new"){
                // Insert the post into the database
                $postid=wp_insert_post( $my_post );
              }
              if($_REQUEST['task']=="edit"){
              // update the post into the database   
              $my_post['ID']=$_REQUEST['postid'];
              wp_update_post( $my_post );
               $postid= $_REQUEST['postid'];  
            }
            $upload_dir = wp_upload_dir();
           $filenames= $_POST['filename'];

            if(is_array($filenames)){
          foreach($filenames as $value){ 
       
              $wp_filetype = wp_check_filetype(basename($value), null );
              $attachment = array(
                 'post_mime_type' => $wp_filetype['type'],
                 'post_title' => preg_replace('/\.[^.]+$/', ' ', basename($value)),
                 'post_content' => '',
                 'guid' => $upload_dir['url']."/".$value,
                 'post_status' => 'inherit'
              );
              $attach_id = wp_insert_attachment( $attachment, $value, $postid );
              
              set_post_thumbnail( $postid, $attach_id );
              
          }
            }    
            
            if($_POST['custom_fields']){
               update_post_meta($postid,'custom_fields',$_POST['custom_fields']);
               update_post_meta($postid,'custom_values',$_POST['custom_values']); 
           } 
           update_post_meta($postid,'user_post_tag',$_POST['user_post_tag']);
           update_post_meta($postid,'user_post_excerpt',$_POST['user_post_excerpt']);
    }
    
    header("location: ".$_POST['home']);
    die();
        
    }
}

function wpup_user_post_form(){
    $concat= get_option("permalink_structure")?"?":"&"; 
     
        
      if($_REQUEST['task']=="edit"){
        $thispost=get_post($_REQUEST['postid']);
         $meta_fields = get_post_meta($thispost->ID, "custom_fields", $single);
         $meta_values = get_post_meta($thispost->ID, "custom_values", $single);
         $post_tag = get_post_meta($thispost->ID, "user_post_tag", $single);
         $user_post_excerpt = get_post_meta($thispost->ID, "user_post_excerpt", $single);
         
        }
     else $_REQUEST['task']="new";
     
    include_once("tpls/post_form.php");
} 
 
function get_file_extension($file_name){
          return substr(strrchr($file_name,'.'),1);
}
  

function wpup_user_menu(){
    
    $concat= get_option("permalink_structure")?"?":"&";
    include("tpls/user-menu.php");
}

function wpup_user_posts(){    
     global $wp_roles;
     global $current_user;
     $userrole= get_option('_wpup_user_role');       
     ob_start();
    
    
        if(is_user_logged_in()){  
            
            
            
           if(!(is_single()||is_page())) return;
           
            wpup_user_menu();
            
            switch($_GET['task']){
                
                case 'new':
                case 'edit':
                    wpup_user_post_form();
                    break;
                case 'delete':
                    wpup_delete_post();
                    wpup_user_post_list();
                    break;
                    
                case '':
                default:
                    wpup_user_post_list();
                    break;
            } 
        }  
        else {
        
            if(!is_user_logged_in())
            include("tpls/members.php");
            else
            echo stripslashes(get_option('_wpup_noaccess'));
        }
        
        $data = ob_get_contents();
        ob_clean();
        return $data;
    
    }

function wpup_delete_post(){
    if($_REQUEST['task']=="delete"){
       if($_REQUEST['postid']){
           
           //delete post attachment
           $posts=get_posts("post_type=attachment&post_parent=".$_REQUEST['postid']);
           //print_r($posts);
           if(count($posts)>0){
               foreach($posts as $pst){
                   wp_delete_post($pst->ID);
               }
           }
           //delete post
            wp_delete_post($_REQUEST['postid']);
            
        } 
    }
}
   
 
 

function wpup_save_settings(){
    if(isset($_POST['action'])&&$_POST['action']=="wpup_save_settings"){
    //print_r($_POST['user_role']);
       update_option('_wpup_user_role',$_POST['user_role']);
       update_option('_wpup_extension', $_POST['extension']);
       update_option('_wpup_excerpt', $_POST['excerpt']);
       update_option('_wpup_tags', $_POST['tags']);  
       update_option('_wppu_fstatus', $_POST['fstatus']);  
       update_option('_wpup_noaccess', $_POST['_wpup_noaccess']);  
       header("location: ".$_SERVER['HTTP_REFERER']);
    }
    
}

function wpup_user_custom_field($param){
     global $post;
     $fieldname=$param['name'];
     $meta_fields = get_post_meta($post->ID, "custom_fields", true);
     $meta_values = get_post_meta($post->ID, "custom_values", true);
     for($i=0;$i<count($meta_fields);$i++){
         if($fieldname==$meta_fields[$i]){
             return stripslashes($meta_values[$i]);
         }
     }
}

function wpup_custom_code(){
    ?>
    <script language="JavaScript">
    <!--
      jQuery(function(){
         jQuery('#post-from-frontend').after("<tr><td colspan=3><div style='border:1px solid #B43FEA;front-weight:bold;color:#008800;padding:5px 10px;background:#F7E5FF;border-radius:3px;margin-bottom:5px;'><a style='font-weight:bold;color:#8811BF' href='http://wpeden.com/product/frontend-post-and-media-manager/'>Get Front-end Post and Media Manager Pro</a></div></td></tr>"); 
      });
    //-->
    </script>
    <?php
}

add_action('admin_footer','wpup_custom_code');

function wpup_enqueue_scripts(){
wp_enqueue_script("jquery");
wp_enqueue_script('jquery-form');  
wp_enqueue_style('postbyusers',plugins_url('/post-from-frontend/css/front.css'));
} 

add_action("wp_enqueue_scripts","wpup_enqueue_scripts");  
add_action("init","wpup_posting_form_submit"); 
add_action("init","wpup_delete_post");  



 add_shortcode("wpeden_post_from_frontend",'wpup_user_posts');
 //short code for the user custom field  [user_custom_field name=fieldname]
 add_shortcode("user_custom_field",'wpup_user_custom_field'); 
 
?>
