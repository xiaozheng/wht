<?php
// Form submitted, check the data
if (isset($_POST['frm_gCF_display']) && $_POST['frm_gCF_display'] == 'yes')
{
	$did = isset($_GET['did']) ? $_GET['did'] : '0';
	$chk_delete = isset($_POST['chk_delete']) ? $_POST['chk_delete'] : '';
	
	$gCF_success = '';
	$gCF_success_msg = FALSE;
	
	if(empty($chk_delete))
	{
		// First check if ID exist with requested ID
		$sSql = $wpdb->prepare(
			"SELECT COUNT(*) AS `count` FROM ".$gCF_table."
			WHERE `gCF_id` = %d",
			array($did)
		);
		$result = '0';
		$result = $wpdb->get_var($sSql);
		
		if ($result != '1')
		{
			?><div class="error fade"><p><strong>Oops, selected details doesn't exist (1).</strong></p></div><?php
		}
		else
		{
			// Form submitted, check the action
			if (isset($_GET['ac']) && $_GET['ac'] == 'del' && isset($_GET['did']) && $_GET['did'] != '')
			{
				//	Just security thingy that wordpress offers us
				check_admin_referer('gCF_form_show');
				
				//	Delete selected record from the table
				$sSql = $wpdb->prepare("DELETE FROM `".$gCF_table."`
						WHERE `gCF_id` = %d
						LIMIT 1", $did);
				$wpdb->query($sSql);
				
				//	Set success message
				$gCF_success_msg = TRUE;
				$gCF_success = __('Selected record was successfully deleted.', gCF_UNIQUE_NAME);
			}
		}
	}
	else
	{
		
		//	Just security thingy that wordpress offers us
		check_admin_referer('gCF_form_show');
		
		$count = count($chk_delete);
		for($i=0; $i<$count; $i++)
		{
			$del_id = $chk_delete[$i];
			$sSql = $wpdb->prepare("DELETE FROM `".$gCF_table."`
						WHERE `gCF_id` = %d
						LIMIT 1", $del_id);
			$wpdb->query($sSql);
			//	Set success message
			$gCF_success_msg = TRUE;
			$gCF_success = __('Selected record(s) was successfully deleted.', gCF_UNIQUE_NAME);
		}
	}
	
	if ($gCF_success_msg == TRUE)
	{
		?><div class="updated fade"><p><strong><?php echo $gCF_success; ?></strong></p></div><?php
	}
}
?>
<script language="javascript" type="text/javascript">
	function _gCF_delete(id, pagenum)
	{
		if(confirm("Do you want to delete this record?"))
		{
			document.frm_gCF_display.action="options-general.php?page=simple-contact-form&pagenum="+pagenum+"&ac=del&did="+id;
			document.frm_gCF_display.submit();
		}
	}	
	
	function _multipledelete(pagenum)
	{
		if(confirm("Do you want to delete all the selected record(s)?"))
		{
			document.frm_gCF_display.action="options-general.php?page=simple-contact-form&pagenum="+pagenum;
			document.frm_gCF_display.submit();
		}
	}
</script>
<div class="wrap">
  <div id="icon-edit" class="icon32 icon32-posts-post"></div>
    <h2>Simple contact form</h2>
    <div class="tool-box">
	<div style="height:5px;"></div>
	<?php
		$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
		$limit = 15;
		$offset = ($pagenum - 1) * $limit;
		$sSql = "SELECT COUNT(gCF_id) AS `count` FROM ".$gCF_table;
		$total = 0;
		$total = $wpdb->get_var($sSql);
		$total = ceil( $total / $limit );
	
		$sSql = "SELECT * FROM `". $gCF_table ."` order by gCF_id desc LIMIT $offset, $limit";		
		$myData = array();
		$myData = $wpdb->get_results($sSql, ARRAY_A);
		?>
	  <form name="frm_gCF_display" method="post">
	  <table width="100%" class="widefat" id="straymanage">
		<thead>
		  <tr>
			<th class="check-column" scope="col"><input type="checkbox" /></th>
			<th scope="col">Name</th>
			<th scope="col">Email</th>
			<th scope="col">Message</th>
			<th scope="col">Date</th>
			<th scope="col">IP</th>
		  </tr>
		</thead>
		<tfoot>
		  <tr>
			<th class="check-column" scope="col"><input type="checkbox" /></th>
			<th scope="col">Name</th>
			<th scope="col">Email</th>
			<th scope="col">Message</th>
			<th scope="col">Date</th>
			<th scope="col">IP</th>
		  </tr>
		</tfoot>
		<tbody>
			<?php 
			$i = 0;
			if(count($myData) > 0 )
			{
				foreach ($myData as $data)
				{
					?>
					<tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
						<td align="left"><input name="chk_delete[]" id="chk_delete[]" type="checkbox" value="<?php echo $data['gCF_id']; ?>"></td>
						<td><?php echo $data['gCF_name']; ?>
						<div class="row-actions">
							<span class="trash"><a onClick="javascript:_gCF_delete('<?php echo $data['gCF_id']; ?>', <?php echo $pagenum; ?>)" href="javascript:void(0);">Delete</a></span> 
						</div>
						</td>
						<td><?php echo $data['gCF_email']; ?></td>
						<td><?php echo stripslashes($data['gCF_message']); ?></td>
						<td><?php echo $data['gCF_date']; ?></td>
						<td><?php echo $data['gCF_ip']; ?></td>
					</tr>
					<?php 
					$i = $i+1; 
				} 	
			}
			else
			{
				?><tr><td colspan="6" align="center">No records available.</td></tr><?php 
			}
			?>
		</tbody>
        </table>
		<?php wp_nonce_field('gCF_form_show'); ?>
		<input type="hidden" name="frm_gCF_display" value="yes"/>
	  <?php
	  $page_links = paginate_links( array(
			'base' => add_query_arg( 'pagenum', '%#%' ),
			'format' => '',
			'prev_text' => __( ' &lt;&lt; ' ),
			'next_text' => __( ' &gt;&gt; ' ),
			'total' => $total,
			'show_all' => False,
			'current' => $pagenum
		) );
		?>	
	<div class="tablenav bottom">
	  <div class="alignleft actions">
	    <input class="button"  name="multidelete" type="button" id="multidelete" value="Delete all selected records" onclick="_multipledelete(<?php echo $pagenum; ?>)"> &nbsp; 
	  	<a class="button" href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php?page=simple-contact-form&amp;ac=set">Go to Setting Management</a> &nbsp; 
		<a class="button" target="_blank" href="http://www.gopiplus.com/work/2010/07/18/simple-contact-form/">Help</a>
	  </div>
	  <div class="tablenav-pages"><span class="pagination-links"><?php echo $page_links; ?></span></div>
	</div>
	</form>
	<h3>Plugin configuration option</h3>
	<ol>
		<li>Add directly in to the theme using PHP code.</li>
		<li>Drag and drop the widget to your sidebar.</li>
	</ol>
	<p class="description">This plugin has been integrated with Email Newsletter plugin. Please use Email Newsletter plugin to send Newsletters to above listed emails. <br />Check official website for more information <a target="_blank" href="http://www.gopiplus.com/work/2010/07/18/simple-contact-form/">click here</a></p>
	</div>
</div>