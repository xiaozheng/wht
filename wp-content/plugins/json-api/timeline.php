	

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
                    global $json_api;
                    $json = array();
     
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
     
                            // setting first (main) post
     
                            $json['timeline'] = array();
     
                            $json['timeline']['headline'] = $main_post->post_title;
                            $json['timeline']['type'] = 'default';
                            $json['timeline']['startDate'] = date('Y,m,d', strtotime($main_post->post_date));
                            $json['timeline']['text'] = $main_post->post_excerpt;
     
                            // example of media asset using the post thumbnail
                            if(has_post_thumbnail($main_post->ID)) {
     
                                    $thumbnail_id = get_post_thumbnail_id($main_post->ID);
                                    $thumbnail_src = wp_get_attachment_image_src($thumbnail_id, 'medium');
                                    $json['timeline']['asset']['media'] = $thumbnail_src[0];
                                   
                            }
     
                            if($posts) {
                                    $json['timeline']['date'] = array();
                                    $i = 0;
                                    foreach($posts as $post) {
     
                                            $json['timeline']['date'][$i]['startDate'] = date('Y,m,d', strtotime($post->post_date));
                                            $json['timeline']['date'][$i]['endDate'] = date('Y,m,d', strtotime($post->post_date));
                                            $json['timeline']['date'][$i]['headline'] = $post->post_title;
                                            $json['timeline']['date'][$i]['text'] = $post->post_excerpt;
     
                                            // example of media asset using the post thumbnail
                                            if(has_post_thumbnail($post->ID)) {
     
                                                    $thumbnail_id = get_post_thumbnail_id($post->ID);
                                                    $thumbnail_src = wp_get_attachment_image_src($thumbnail_id, 'medium');
     
                                                    $json['timeline']['date'][$i]['asset']['media'] = $thumbnail_src[0];
     
                                            }
     
                                            $i++;
     
                                    }
     
                                    return $json;
     
                            } else return 'Posts not found';
     
                    } else return 'Main post not found';
     
            }
     
    }
     
    ?>


