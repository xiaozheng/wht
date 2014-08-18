<?php

/*

	JSON Controller for JSON API WordPress Plugin to return posts in Timeline format for Verite Timeline WordPress Plugin

	Usage:
	http://example.com/api/timeline/category_posts/?category_id=123&post_type=timeline&amount=10&main_post_id=456

	Default values:
	category_id = null
	post_type = 'post'
	amount = -1 (all posts)
	main_post_id = first post from query, ordered by date in ascending order (the main post should be an introduction to the timeline being viewed)

	Content values can be changed to support custom post meta for enhanced usage.

*/

class JSON_API_Timeline_Controller {
	
	public function category_posts() {
		$shortdisclength=50;
		global $json_api;
		$json = array();
		$json['id']="js_history";
		/*$json['title']="A little history of JavaScript";
    		$json['description']="<p>Javascript emerged in a specific context: the fast-paced development of Netscape's browser. When he 			was hired at Netscape, Brendan Eich was told that it would be \"Scheme for the browser\", but he was later told to make it 			more like C and Java. The first iteration of JS, created over a 10 day period, was a super-flexible, but also highly flawed 			child of the internet age.</p>";*/
		
		
		$json["focus_date"]="2013-06-20 12:00:00";
		$json['initial_zoom']="12";
		$json['image_lane_height']=0;
		$json["size_importance"]= "true";
		// get attributes
		$category_id = $json_api->query->category_id;
		$post_type = $json_api->query->post_type;
		$amount = $json_api->query->amount;
		$main_post_id = $json_api->query->main_post_id;

		if(!$post_type) $post_type = 'post';
		if(!$amount) $amount = -1;

		$posts = get_posts(array('post_type' => $post_type, 'numberposts' => $amount, 'category' => $category_id, 'orderby' => 'post_date', 'order' => 'DESC'));

		if($main_post_id) $main_post = get_post($main_post_id);
		else  {
			$main_post = $posts[0];
			unset($posts[0]);
		}

		if($main_post) {
			$stripdesc = $main_post->post_content;
			$smalldisc=  $stripdesc;
			// setting first (main) post
			if(strlen($stripdesc)<=$shortdisclength)
  			{
   			 $smalldisc=$stripdesc;
  			}
 			 else
 			 {
  	 		 $smalldisc=substr($stripdesc,0,$shortdisclength) . '...';
   	 		
 	 		}
			$json['events'] = array();

			$json['events'][0]['id'] = $main_post->ID;
			$json['events'][0]['title'] = $main_post->post_title;
			
			$json['events'][0]['startdate'] = date('Y-m-d H:i:s', strtotime($main_post->post_date));
			$json['events'][0]['enddate'] = date('Y-m-d H:i:s', strtotime($main_post->post_date));
			$json['events'][0]['description'] = $stripdesc;
			$json['events'][0]['icon'] ="circle_green.png";
			
			$stripdesc =$main_post->post_content;
			$json['events'][0]['shortDiscription']=$smalldisc;
			 $json['events'][0]["low_threshold"]= "1";
	        	 $json['events'][0]["high_threshold"]= "100";
	        	 $json['events'][0]["importance"]= "55";
			 $json['events'][0]["ypix"]= "0";
			 $json['events'][0]["event_type"]= "event";
			// example of media asset using the post thumbnail
			if(has_post_thumbnail($main_post->ID)) {

				$thumbnail_id = get_post_thumbnail_id($main_post->ID);
				$thumbnail_src = wp_get_attachment_image_src($thumbnail_id, 'medium');
				$json['events'][0]['image'] = $thumbnail_src[0];
				
			}

			if($posts) {
				//$json['timeline'] = array();
				$i = 1;
				foreach($posts as $post) {
				$stripdesc = $post->post_content;
				$smalldisc ="";
					if(strlen($stripdesc)<=$shortdisclength)
  				{
   					 $smalldisc=$stripdesc;
  					}
 				 else
 				 {
  	 			 $smalldisc=substr($stripdesc,0,$shortdisclength) . '...';
   	 		
 	 			}
					$json['events'][$i]["low_threshold"]= "1";
	        	 		$json['events'][$i]["high_threshold"]= "100";
	        	 		$json['events'][$i]["importance"]= "55";
					$json['events'][$i]["ypix"]= "0";
					$json['events'][$i]['id']=$post->ID;
					
					$json['events'][$i]['shortDiscription']=$smalldisc;
					$json['events'][$i]['startdate'] = date('Y-m-d H:i:s', strtotime($post->post_date));
					$json['events'][$i]['enddate'] = date('Y-m-d H:i:s', strtotime($post->post_date));
					$json['events'][$i]['title'] = $post->post_title;
					$json['events'][$i]['description'] =  $stripdesc ;//"icon":
					$json['events'][$i]['icon'] ="circle_green.png";
					$json['events'][$i]["importance"]="50";
					$json['events'][$i]["event_type"]= "event";

					// example of media asset using the post thumbnail
					if(has_post_thumbnail($post->ID)) {

						$thumbnail_id = get_post_thumbnail_id($post->ID);
						$thumbnail_src = wp_get_attachment_image_src($thumbnail_id, 'medium');

						$json['events'][$i]['image'] = $thumbnail_src[0];

					}

					$i++;

				}

				return $json;

			} else return 'Posts not found';

		} else return 'Main post not found';

	}
 public function create_3d_post() {
$shortdisclength=10;
    global $json_api;
   $json = array();
  
   	$json['host']= "";
	$json['homePage']=  false; 
	 $json['showAdBlock']= "false";
	 $json['id']=43;
	 $json['title']="";
	 $json['urlFriendlyTitle']="";
	 $json['startDate']="2014-01-01 00:00:00";
	 $json['endDate']="2014-03-30 00:00:00";
  	 $json['introText']="";
	 $json['introImage']="";
	 $json['authorName']="";
	 $json["accountType"]="";
	 $json['backgroundImage']="";
	 $json['introImageCredit']="";
	 $json['backgroundImageCredit']="";
	 $json['feed']= "";
	 $json['mainColour']= "c72066";
	 $json['zoom']= "month-small-day";
	 $json['initialFocus']= "39";
	 $json['embedHash']= "9085373548";
	 $json['embed']= "false";
	 $json['secret']= "false";
	 $json['public']= "yes";
	 $json['dontDisplayIntroPanel']=1;
	 $json['openReadMoreLinks']= 0;
	 $json['storyDateStatus']= 0;
	 $json['storySpacing']= 1;
	 $json['viewType']= 0;
	 $json['showTitleBlock']= 0;
	 $json['backgroundColour']= "1a1a1a";
	 $json['storyDateFormat']= "auto";
	 $json['topDateFormat']= "auto";
	 $json['sliderDateFormat']= "auto";
	 $json['language']="english";
	 $json['displayStripes']= 1;
	 $json['htmlFormatting']= 0;
	 $json['sliderBackgroundColour']= "000000";
	 $json['sliderTextColour']= "808080";
	 $json['sliderDetailsColour']= "282828";
	 $json['sliderDraggerColour']= "808080";
	 $json['headerBackgroundColour']= "000000";
	 $json['headerTextColour']= "808080";
	 $json['showGroupAuthorNames']= "1";
	 $json['durHeadlineColour']= "ffffff";
	 $json['cssFile']= "";
	 $json['altFlickrImageUrl']= "";
	 $json['fontBase']= 'default';
	 $json['fontHead']= 'default';
	 $json['fontBody']= 'default';
	 $json['lightboxStyle']= '0';
	 $json['showControls']= '1';
	 $json['lazyLoading']= '0';
	 $json['protection']= "";
	 $json['expander']="2";
	 $json['copyable']= "0";
	 $json['settings3d']= "1,FFFFFF,0.6432,1050,0.1125,1.25,1,3";
	 $json['bgStyle']= 1;
	 $json['bgScale']= 125;
	
	
	$category_id = $json_api->query->category_id;
	$post_type = $json_api->query->post_type;
	$amount = $json_api->query->amount;
	$main_post_id = $json_api->query->main_post_id;
	$category_arrys= get_categories(); 
	$json['categories']=array();
	$cindex=0;
	foreach ($category_arrys as $category) {
	
	$json['categories'][$cindex]['id']=$category->cat_ID;
	$json['categories'][$cindex]['title']=$category->cat_name;
	$json['categories'][$cindex]['colour']='386cd2';
	$json['categories'][$cindex]['layout']='0';
	$json['categories'][$cindex]['rows']='3';
	$json['categories'][$cindex]['order']='10';
	$json['categories'][$cindex]['size']='15';
	$cindex++;
	}
if ($cindex == 0){
	$json['categories'][$cindex]['id']="1";
	$json['categories'][$cindex]['title']="create Post";
	$json['categories'][$cindex]['colour']='386cd2';
	$json['categories'][$cindex]['layout']='0';
	$json['categories'][$cindex]['rows']='3';
	$json['categories'][$cindex]['order']='10';
	$json['categories'][$cindex]['size']='15';

}
	$i =0;
	if(!$post_type) $post_type = 'post';
	if(!$amount) $amount = -1;

	$posts = get_posts(array('post_type' => $post_type, 'numberposts' => $amount, 'category' => $category_id, 'orderby' => 			'post_date','order' => 'DESC', 'post_status' => array('publish', 'future')));

		if($main_post_id) $main_post = get_post($main_post_id);
		else  {
			$main_post = $posts[0];
			unset($posts[0]);
		}

		if($main_post) {
			
			
			$json['stories'] = array();
			//$sdate=strtotime($main_post->post_date.'+20 day');
			$sdate=strtotime($main_post->post_date.'+10 day');
			$json['endDate']=date('Y-m-d H:i:s', $sdate);
			$json['stories'][0]['id'] = $main_post->ID;
			$json['stories'][0]['title'] =  $main_post->post_title;
			$json['stories'][0]['media'] = array();
			$json['stories'][0]['startDate'] = date('Y-m-d H:i:s', strtotime($main_post->post_date));
			$json['stories'][0]['endDate'] = date('Y-m-d H:i:s', strtotime($main_post->post_date));
			$json['stories'][0]['authorID'] = $main_post->post_author;
			$json['stories'][0]['authorName'] = get_the_author_meta( 'display_name', $main_post->post_author );
			
			$json['events'][0]['icon'] ="circle_green.png";
			$post_categories = wp_get_post_categories( $main_post->ID);	
				if($post_categories)
				{
					foreach ($post_categories as  $Cid)
						{	
							$json['stories'][0]['category']=$Cid;		
						}
					
				}
			//$json['stories'][0]['category']=$main_post->$category_id;
			$stripdesc =$main_post->post_content;
			
			$json['stories'][0]['media'] = array();
			if (current_user_can('edit_post',$main_post->ID)){
					$json['stories'][0]['edit_post']=true;
					//$json['stories'][0]['post_permalink']= get_post_permalink();//$main_post->post_name.'/edit'
					$json['stories'][0]['post_permalink']=$main_post->post_name.'/edit/';
					//$json['stories'][0]['title'] =  $main_post->post_title."<a href='".get_post_permalink()."'>Edit<\/a>";
				}
			// example of media asset using the post thumbnail
			if(has_post_thumbnail($main_post->ID)) {
				$photo_caption="";
				if(get_post(get_post_thumbnail_id($main_post->ID))->post_excerpt) {
				$photo_caption=get_post(get_post_thumbnail_id())->post_excerpt;
				}
				$thumbnail_id = get_post_thumbnail_id($main_post->ID);
				$thumbnail_src = wp_get_attachment_image_src($thumbnail_id, 'medium');
				//$thumbnail_src[0];
				$json['stories'][0]['media'][0]['id']=$main_post->ID;
				$json['stories'][0]['media'][0]['src']=$thumbnail_src[0] ;
				$json['stories'][0]['media'][0]['caption']=$photo_caption;
				$json['stories'][0]['media'][0]['type']="Image";
				$json['stories'][0]['media'][0]['thumbPosition']="0,0"; 
				$json['stories'][0]['media'][0]['orderIndex']=0;
				$stripdesc = $main_post->post_content;
			}else{
				$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $main_post->post_content, $matches);
				$first_img = $matches [1] [0];
				if(!empty($first_img)){
				$json['stories'][0]['media'][0]['id']=$main_post->ID;
				$json['stories'][0]['media'][0]['src']=$first_img;
				$json['stories'][0]['media'][0]['type']="Image";
				$json['stories'][0]['media'][0]['thumbPosition']="0,0"; 
				$json['stories'][0]['media'][0]['orderIndex']=0;
				$stripdesc=preg_replace('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',"</a>",$main_post->post_content,1);
				}
			}
			
			
			$smalldisc ="";
				$content = preg_split('/\n/',$stripdesc);
				$fullText =""; 
				if(count($content) != 0 and count($content) < 2)
  				{
   				 $smalldisc=$stripdesc;
				 $fullText =" ";
  				}
 				 else
 				 {
  	 			 $smalldisc=$content[0];
				$fullText=implode(' ', array_slice($content, 1));

 	 			}
				
				//$json['stories'][0]['text']=$smalldisc;
				//$json['stories'][0]['fullText'] = $fullText;
				$anchortag_in_first =array();
				$img_count=preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $smalldisc, $anchortag_in_first);
				if($img_count > 0){
				$json['stories'][$i]['fullText'] = $main_post->post_content;
				$json['stories'][$i]['text']=" ";
				
				}else{
					$json['stories'][$i]['text']=$smalldisc;
				$json['stories'][$i]['fullText'] = $fullText;
				}
			if($posts) {
				//$json['timeline'] = array();
				$i = 1;
				foreach($posts as $post) {
				 
				
				
				
				$json['stories'][$i]['media'] = array();
					$image_index=0;	
				 if(has_post_thumbnail($post->ID)) {
						$stripdesc=$post->post_content;
						$photo_caption="";
						if(get_post(get_post_thumbnail_id($post->ID))->post_excerpt) {
						$photo_caption=get_post($post->ID)->post_excerpt;
						}
							
						$thumbnail_id = get_post_thumbnail_id($post->ID);
						$thumbnail_src = wp_get_attachment_image_src($thumbnail_id, 'medium');
						$json['stories'][$i]['media'][$image_index]['id']=$post->ID;
						$json['stories'][$i]['media'][$image_index]['src']=$thumbnail_src[0];
						$json['stories'][$i]['media'][$image_index]['type']="Image";
						$json['stories'][$i]['media'][$image_index]['thumbPosition']="0,0"; 
						$json['stories'][$i]['media'][$image_index]['orderIndex']=0;
						$json['stories'][$i]['media'][$image_index]['caption']=$photo_caption;
						$image_index++;
					}else{
					$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
					$first_img = $matches [1] [0];
					if(!empty($first_img)){
					$json['stories'][$i]['media'][0]['id']=$post->ID;
					$json['stories'][$i]['media'][0]['src']=$first_img;
					$json['stories'][$i]['media'][0]['type']="Image";
					$json['stories'][$i]['media'][0]['thumbPosition']="0,0"; 
					$json['stories'][$i]['media'][0]['orderIndex']=0;
					}
					$stripdesc=preg_replace('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',"</a>",$post->post_content,1); 					
					}
				$smalldisc ="";
				$content = preg_split('/\n/',$stripdesc);
				$fullText =""; 
				if(count($content) != 0 and count($content) < 2)
  				{
   				 $smalldisc=$stripdesc;
				 $fullText =" ";
  				}
 				 else
 				 {
  	 			 $smalldisc=$content[0];
				$fullText=implode(' ', array_slice($content, 1));

   	 		
 	 			}
				$post_categories = wp_get_post_categories( $post->ID );	
				if($post_categories)
				{
					foreach ($post_categories as  $Cid)
						{	
							$json['stories'][$i]['category']=$Cid;		
						}
					
				}
				$json['stories'][$i]['authorID'] = $post->post_author;
				$json['stories'][$i]['authorName'] = get_the_author_meta( 'display_name', $post->post_author );

				//$json['stories'][$i]['category']=$post->$category_id;		      		
				if (current_user_can('edit_post',$post->ID)){
					$json['stories'][$i]['edit_post']=true;
					//$json['stories'][$i]['post_permalink']= get_post_permalink($post->ID);
					$json['stories'][$i]['post_permalink']=basename(get_permalink($post->ID)).'/edit/';
										
					}
					$json['stories'][$i]['post_permalink']=basename(get_permalink($post->ID)).'/edit/';
	        	 		
					$json['stories'][$i]['id']=$post->ID;
					//Removing images from posts
					//$fullText = preg_replace('/<img[^>]+./','', $fullText);
					
					$json['stories'][$i]['startDate'] = date('Y-m-d H:i:s', strtotime($post->post_date));
			                $json['stories'][$i]['endDate'] =date('Y-m-d H:i:s', strtotime($post->post_date));
					$json['stories'][$i]['title'] =  $post->post_title;
					//$json['stories'][$i]['fullText'] =  $fullText ;//"icon":
					//$json['stories'][$i]['text']=$smalldisc;
					$anchortag_in_first =array();
				$img_count=preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $smalldisc, $anchortag_in_first);
				if($img_count > 0){
					$json['stories'][$i]['fullText'] = $post->post_content;
					$json['stories'][$i]['text']=" ";
				
					}else{
					$json['stories'][$i]['text']=$smalldisc;
					$json['stories'][$i]['fullText'] = $fullText;
					}
					$json['startDate']= date('Y-m-d H:i:s',strtotime ( '-10 day' ,strtotime($post->post_date)));
				       /* $args = array( 'post_type' => 'attachment', 'posts_per_page' => -1, 'post_status' =>'any','post_mime_type'=>'image','post_parent' => $post->ID ); 
								
					// example of media asset using the post thumbnail
					//rand()
						$attachments = get_posts( $args );
					      if ( $attachments ) {
					      foreach ( $attachments as $attachment ) {
						
						
						$ATT=wp_get_attachment_image_src( $attachment->ID);
						$json['stories'][$i]['media'][$image_index]['id']=$attachment->ID;
						$json['stories'][$i]['media'][$image_index]['src']=$ATT[0];
						$json['stories'][$i]['media'][$image_index]['type']="Image";
						$json['stories'][$i]['media'][$image_index]['thumbPosition']="0,0"; 
						$json['stories'][$i]['media'][$image_index]['orderIndex']=$image_index;
						$image_index++;
						
						
						
			 			//$fullText= $fullText."attachment".$ATT[0];
						}
						}else*/
						//$json['stories'][$i]['fullText'] =  $fullText ;
					$i++;
				
				}
			}
		
		}
if (count($json['stories']) == 0){
			
				$json['stories'][0]['id']=123456;
				$json['stories'][0]['title'] =  "Create Post";
				$json['stories'][0]['media'] = array();
				$json['stories'][0]['startDate'] = "2014-04-15 11:31:43";
				$json['stories'][0]['endDate'] = "2014-04-15 11:31:43";
				$json['stories'][0]["category"]=1;
				$json['stories'][0]['fullText'] = '<a href='.esc_url( home_url( "/" )).create_post.'>Click on My post Button to create Post</a>';
				$json['stories'][0]['text']=' ';
				$json['stories'][0]['text']=" ";
				$json['events'][0]['icon'] ="circle_green.png";

}else if($i == 0){
				$json['startDate']= date('Y-m-d H:i:s',strtotime ( '-20 day' ,strtotime($json['endDate'])));
				
				
			}
		return $json;
  }

}

?>
