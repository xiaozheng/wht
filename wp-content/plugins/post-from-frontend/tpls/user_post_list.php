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
#user_post_list_paginate a{
    padding:3px 5px;
    font-size:10pt;
    background: #eee;
    margin: 2px;
    border: 1px solid #ccc;
    cursor: pointer;
}
#user_post_list_paginate a:hover{
    border: 1px solid #999;
}
.title.sorting_asc:after{
    content: "\25bc";
}
.title.sorting_desc:after{
    content: "\25b2";
}
.title{
    cursor: pointer;
    text-decoration: underline;
}
.entry-title{
display:none;
}
</style>
<div class="wrap"> 
<table class="post" id="user_post_list" border="0" width="100%" cellspacing="0" style="clear: both;">
 
<thead>
   <tr>
	
      <th class="title">
         Title
      </th>
      <th class="jq_Date">Date</th>
      <th class="nosort cat">
         Category  
      </th>
      <th class="nosort">
         Action  
      </th>
   </tr>
   </thead> 
   <tbody>
  <?php $i=0;?>
   <?php foreach($user_posts as $upost){?>
   <tr>
	
      <td>
      <!--<?php $edit_page = (int) get_option( 'wpuf_edit_page_url' );
	
	$url = wp_nonce_url( get_permalink( $edit_page ) . '?pid=' . $upost->ID, 'wpuf_edit' );?>
	 <!-- post_name.'/edit/'<a href="<?php the_permalink();?><?php echo $concat;?>task=edit&postid=<?php echo $upost->ID;?>"><?php echo $upost->post_title;?></a>
<a href="<?php echo esc_url( home_url( '/' ) );?><?php echo $upost->post_name.'/edit/';?>"><?php echo $upost->post_title;?></a>
<a href="<?php echo esc_url( home_url( '/' ) );?>wp-user-edit-post/?pid=<?php echo $upost->ID;?>"><?php echo $upost->post_title;?></a>
-->
     <a href="<?php echo esc_url( home_url( '/' ));?><?php echo edit_post;?>/?pid=<?php echo $upost->ID;?>"><?php echo $upost->post_title;?></a>
      </td>
      <td class="jq_Date"><?php echo date('Y-m-d', strtotime( $upost->post_date)); ?></td>
      <td class="cat">
          <?php  $category=get_the_category( $upost->ID ); echo $category[0]->cat_name;?>
      </td>
      <td>
      <a href="#" onclick="if(confirm('Are you sure?')){location.href='<?php the_permalink();?><?php echo $concat;?>task=delete&postid=<?php echo $upost->ID;?>'}" >Delete</a>
        
      </td>
   </tr><?php } ?>
   </tbody>
</table>
</div>
</div> <!-- ending div for wrapper-->  

<script language="JavaScript">
<!--
  jQuery(document).ready(function() {
    jQuery('#user_post_list').dataTable({
              
                    "sPaginationType": "full_numbers",
		"aaSorting": [[ 1, "desc" ]] 
                });
                
   jQuery('.nosort').unbind('click');
} );
//-->
</script>
