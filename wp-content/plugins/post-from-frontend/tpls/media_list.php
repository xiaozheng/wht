<script language="JavaScript" src="<?php echo plugins_url('post-from-frontend/js/jquery.dataTables.min.js'); ?>"></script>
<?php $concat= get_option("permalink_structure")?"?":"&";    ?> 
<style type="text/css">
.dataTables_length{
    float: left;
    margin-bottom: 10px;
}
.dataTables_filter{
    float: right;
    margin-bottom: 10px;
}
#user_media_list_paginate a{
    padding:3px 5px;
    font-size:10pt;
    background: #eee;
    margin: 2px;
    border: 1px solid #ccc;
    cursor: pointer;
}
#user_media_list_paginate a:hover{
    border: 1px solid #999;
}
.title{
    cursor: pointer;
    text-decoration: underline;   
}
.title.sorting_asc:after{
    content: "\25bc";
}
.title.sorting_desc:after{
    content: "\25b2";
}
</style>
    <script type="text/javascript">
     function getcode(filelocation){
         window.open("<?php echo plugins_url('/post-from-frontend/tpls/embedcode.php?fl=');?>"+filelocation,"_blank","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=400, height=300");
     }
    </script>

<table id="user_media_list" cellpadding="0" cellspacing="0" border="0" class="post" style="clear: both;">
<thead>
   <tr>
                <th class="nosort">Preview</th>
                <th class="title">File Name</th>
                <th class="nosort">Embed Code</th>
                <th>Author</th>
                <th class="nosort">Action</th>
            </tr>
   </thead>
   <tbody>
   <?php foreach($attachments as $attachment){
       
       $file_name=basename($attachment->guid);
        $fextension=get_file_extension($file_name);
        if($fextension!='png' && $fextension!='gif' && $fextension!='jpg' && $fextension!='jpeg' && $fextension!='tif' && $fextension!='bmp' && $fextension!='tiff'){
             $fltype= array("js","aac","ai","aiff","avi","c","cpp","css","dat","dmg","doc","docx","dotx","dwg","dxf","eps","exe","flv","h","hpp","html","ics","iso","java","key","mid","mp3","mp4","mpg","mpeg","odf","ods","odt","otp","ots","ott","pdf","php","ppt","psd","py","qt","rar","rb","rtf","sql","tga","tgz","txt","wav","xls","xlsx","xml","yml","zip"); 
             for($i=0;$i<count($fltype);$i++){
                 if($fextension==$fltype[$i]){
                   $imgsrc =plugins_url('/post-from-frontend/images/file-type-icons/').$fltype[$i].".png";
                   break; 
                 }else
                    $imgsrc =plugins_url('/post-from-frontend/images/file.png');
             }
        }else{  
              $imgsrc=plugins_url('/post-from-frontend/timthumb.php?w=48&h=20&zc=1&src='.urlencode($attachment->guid));    
          }
       ?>
   <tr>
        <td valign="middle" width="48">         
         <img src="<?php echo $imgsrc;?>" >
      </td>
      <td valign="middle">
        <a href="<?php echo the_permalink(). $concat."task=media&duty=edit&mediaid=".$attachment->ID;?>"><?php echo $attachment->post_title;?></a>
      </td>
      <td valign="middle">
         <a href="#" onclick="javascript: getcode('<?php echo base64_encode($attachment->guid);?>')"> Get code </a>
      </td>
      <td valign="middle">
         <?php the_author($attachment->ID);?>
      </td>
      <td valign="middle">
         <a href="<?php echo the_permalink().$concat."task=media&duty=delete&mediaid=".$attachment->ID;?>">Delete</a>
      </td>
   </tr>
   
   <?php } ?>
   </tbody>
</table>

</div>
 <!-- ending div for wrapper-->  
<script language="JavaScript">
<!--
  jQuery(document).ready(function() {
    jQuery('#user_media_list').dataTable({
              
                    "sPaginationType": "full_numbers"
                });
                
   jQuery('.nosort').unbind('click');
} );
//-->
</script>