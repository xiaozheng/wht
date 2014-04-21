<?php

class WPUF_Edit_Post {

    function __construct() {
        add_shortcode( 'wpuf_edit', array($this, 'shortcode') );
    }

    /**
     * Handles the edit post shortcode
     *
     * @return string generated form by the plugin
     */
    function shortcode() {

        ob_start();

        if ( is_user_logged_in() ) {
            $this->prepare_form();
        } else {
            printf( __( "This page is restricted. Please %s to view this page.", 'wpuf' ), wp_loginout( '', false ) );
        }

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    /**
     * Main edit post form
     *
     * @global type $wpdb
     * @global type $userdata
     */
    function prepare_form() {
        global $wpdb, $userdata;

        $post_id = isset( $_GET['pid'] ) ? intval( $_GET['pid'] ) : 0;

        //is editing enabled?
        if ( wpuf_get_option( 'enable_post_edit', 'wpuf_others', 'yes' ) != 'yes' ) {
            return __( 'Post Editing is disabled', 'wpuf' );
        }

        $curpost = get_post( $post_id );

        if ( !$curpost ) {
            return __( 'Invalid post', 'wpuf' );
        }

        //has permission?
        if ( !current_user_can( 'delete_others_posts' ) && ( $userdata->ID != $curpost->post_author ) ) {
            return __( 'You are not allowed to edit', 'wpuf' );
        }

        //perform delete attachment action
        if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == "del" ) {
            check_admin_referer( 'wpuf_attach_del' );
            $attach_id = intval( $_REQUEST['attach_id'] );

            if ( $attach_id ) {
                wp_delete_attachment( $attach_id );
            }
        }

        //process post
        if ( isset( $_POST['wpuf_edit_post_submit'] ) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'wpuf-edit-post' ) ) {
            $this->submit_post();

            $curpost = get_post( $post_id );
        }

        //show post form
        $this->edit_form( $curpost );
    }

    function edit_form( $curpost ) {
        $post_tags = wp_get_post_tags( $curpost->ID );
        $tagsarray = array();
        foreach ($post_tags as $tag) {
            $tagsarray[] = $tag->name;
        }
        $tagslist = implode( ', ', $tagsarray );
        $categories = get_the_category( $curpost->ID );
        $featured_image = wpuf_get_option( 'enable_featured_image', 'wpuf_frontend_posting', 'no' );
        ?>


<style>
 #wraper ul li.active {
background: #333333;
color:white;
}
#wraper ul li a {
color: rgb(51, 51, 51);
font-family: 'Lucida Sans','Tahoma';
text-transform: uppercase;
font-weight: bold;
}
#wraper ul li {
width: auto !important;
float: left;
vertical-align: middle;
text-align: center;
padding-top:5px;
line-height: 40px;
padding-bottom:0px;
padding-left:0px;
padding-right:10px;

}
#wraper ul{
padding:0px;
}

.site-footer{
bottom:26px;
}
.my_post_create{
height:40px;
font-size:30px;
}
.entry-title{
display:none;
}
</style>
<div id="wraper" class="postbyuser" style="background:#bbbbbb;color:Black;border-bottom:solid 2px #333333">
        
<ul>
<li class="my_post_create"><a href="<?php echo esc_url( home_url( '/' ) ); ?><?php echo myposts;?>/">My posts</a></li>
<li class="my_post_create"  style="float:left;padding-right:20px;padding-left:16px;"><a href="<?php echo esc_url( home_url( '/' ) ); ?><?php echo create_post;?>/" >

Add new post</a></li>
<li><a href="<?php echo esc_url( home_url( '/TimeLine' ) ); ?>" style="color: white; font-size:30px">Back to Timeline</li>
</ul>
</div>
        <div id="wpuf-post-area">
            <form name="wpuf_edit_post_form" id="wpuf_edit_post_form" action="" enctype="multipart/form-data" method="POST">
                <?php wp_nonce_field( 'wpuf-edit-post' ) ?>
                <ul class="wpuf-post-form">

                    <?php do_action( 'wpuf_add_post_form_top', $curpost->post_type, $curpost ); //plugin hook      ?>
                    <?php wpuf_build_custom_field_form( 'top', true, $curpost->ID ); ?>

                    <?php if ( $featured_image == 'yes' ) { ?>
                        <?php if ( current_theme_supports( 'post-thumbnails' ) ) { ?>
                            <li>
                                <label for="post-thumbnail"><?php echo wpuf_get_option( 'ft_image_label', 'wpuf_labels', 'Featured Image' ); ?></label>
                                <div id="wpuf-ft-upload-container">
                                    <div id="wpuf-ft-upload-filelist">
                                        <?php
                                        $style = '';
                                        if ( has_post_thumbnail( $curpost->ID ) ) {
                                            $style = ' style="display:none"';

                                            $post_thumbnail_id = get_post_thumbnail_id( $curpost->ID );
                                            echo wpuf_feat_img_html( $post_thumbnail_id );
                                        }
                                        ?>
                                    </div>
                                    <a id="wpuf-ft-upload-pickfiles" class="button" href="#"><?php echo wpuf_get_option( 'ft_image_btn_label', 'wpuf_labels', 'Upload Image' ); ?></a>
                                </div>
                                <div class="clear"></div>
                            </li>
                        <?php } else { ?>
                            <div class="info"><?php _e( 'Your theme doesn\'t support featured image', 'wpuf' ) ?></div>
                        <?php } ?>
                    <?php } ?>

                    <li>
                        <label for="new-post-title">
                            <?php echo wpuf_get_option( 'title_label', 'wpuf_labels', 'Post Title' ); ?> <span class="required">*</span>
                        </label>
                        <input type="text" name="wpuf_post_title" id="new-post-title" minlength="2" value="<?php echo esc_html( $curpost->post_title ); ?>">
                        <div class="clear"></div>
                        <p class="description"><?php echo stripslashes( wpuf_get_option( 'title_help', 'wpuf_labels' ) ); ?></p>
                    </li>

                    <?php if ( wpuf_get_option( 'allow_cats', 'wpuf_frontend_posting', 'on' ) == 'on' ) { ?>
                        <li>
                            <label for="new-post-cat">
                                <?php echo wpuf_get_option( 'cat_label', 'wpuf_labels', 'Category' ); ?> <span class="required">*</span>
                            </label>

                            <?php
                            $exclude = wpuf_get_option( 'exclude_cats', 'wpuf_frontend_posting' );
                            $cat_type = wpuf_get_option( 'cat_type', 'wpuf_frontend_posting' );

                            $cats = get_the_category( $curpost->ID );
                            $selected = 0;
                            if ( $cats ) {
                                $selected = $cats[0]->term_id;
                            }
                            //var_dump( $cats );
                            //var_dump( $selected );
                            ?>
                            <div class="category-wrap" style="float:left;">
                                <div id="lvl0">
                                    <?php
                                    if ( $cat_type == 'normal' ) {
                                        wp_dropdown_categories( 'show_option_none=' . __( '-- Select --', 'wpuf' ) . '&hierarchical=1&hide_empty=0&orderby=name&name=category[]&id=cat&show_count=0&title_li=&use_desc_for_title=1&class=cat requiredField&exclude=' . $exclude . '&selected=' . $selected );
                                    } else if ( $cat_type == 'ajax' ) {
                                        wp_dropdown_categories( 'show_option_none=' . __( '-- Select --', 'wpuf' ) . '&hierarchical=1&hide_empty=0&orderby=name&name=category[]&id=cat-ajax&show_count=0&title_li=&use_desc_for_title=1&class=cat requiredField&depth=1&exclude=' . $exclude . '&selected=' . $selected );
                                    } else {
                                        wpuf_category_checklist( $curpost->ID, false, 'category', $exclude);
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="loading"></div>
                            <div class="clear"></div>
                            <p class="description"><?php echo stripslashes( wpuf_get_option( 'cat_help', 'wpuf_labels' ) ); ?></p>
                        </li>
                    <?php } ?>

                    <?php do_action( 'wpuf_add_post_form_description', $curpost->post_type, $curpost ); ?>
                    <?php wpuf_build_custom_field_form( 'description', true, $curpost->ID ); ?>

                    <li>
                        <label for="new-post-desc">
                            <?php echo wpuf_get_option( 'desc_label', 'wpuf_labels', 'Post Content' ); ?> <span class="required">*</span>
                        </label>

                        <?php
                        $editor = wpuf_get_option( 'editor_type', 'wpuf_frontend_posting', 'normal' );
                        if ( $editor == 'full' ) {
                            ?>
                            <div style="float:left;">
                                <?php wp_editor( $curpost->post_content, 'new-post-desc', array('textarea_name' => 'wpuf_post_content', 'editor_class' => 'requiredField', 'teeny' => false, 'textarea_rows' => 8) ); ?>
                            </div>
                        <?php } else if ( $editor == 'rich' ) { ?>
                            <div style="float:left;">
                                <?php wp_editor( $curpost->post_content, 'new-post-desc', array('textarea_name' => 'wpuf_post_content', 'editor_class' => 'requiredField', 'teeny' => true, 'textarea_rows' => 8) ); ?>
                            </div>

                        <?php } else { ?>
                            <textarea name="wpuf_post_content" class="requiredField" id="new-post-desc" cols="60" rows="8"><?php echo esc_textarea( $curpost->post_content ); ?></textarea>
                        <?php } ?>

                        <div class="clear"></div>
                        <p class="description"><?php echo stripslashes( wpuf_get_option( 'desc_help', 'wpuf_labels' ) ); ?></p>
                    </li>

                    <?php do_action( 'wpuf_add_post_form_after_description', $curpost->post_type, $curpost ); ?>
                    <?php wpuf_build_custom_field_form( 'tag', true, $curpost->ID ); ?>

                    <?php if ( wpuf_get_option( 'allow_tags', 'wpuf_frontend_posting' ) == 'on' ) { ?>
                        <li>
                            <label for="new-post-tags">
                                <?php echo wpuf_get_option( 'tag_label', 'wpuf_labels', 'Tags' ); ?>
                            </label>
                            <input type="text" name="wpuf_post_tags" id="new-post-tags" value="<?php echo $tagslist; ?>">
                            <p class="description"><?php echo stripslashes( wpuf_get_option( 'tag_help', 'wpuf_labels' ) ); ?></p>
                            <div class="clear"></div>
                        </li>
                    <?php } ?>

                    <?php do_action( 'wpuf_add_post_form_tags', $curpost->post_type, $curpost ); ?>
                    <?php wpuf_build_custom_field_form( 'bottom', true, $curpost->ID ); ?>

                    
 <?php $timezone_format = _x( 'Y-m-d G:i:s', 'timezone date format' );
     date_i18n('Y-m-d',get_the_time('Y-m-d', $curpost->ID)); 
      $month = date_i18n( 'm' );//display current mounth
	 // $month ='Jan';
	$postdate=get_the_time('Y-m-d',  $curpost->ID);
	$postdate=explode('-',$postdate);
        $month_array = array(
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'May',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Aug',
            '09' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec'
        );
	$month =$postdate[1];        
	?>
	
	 <li>
            <label for="timestamp-wrap">
                <?php _e( 'Publish Time:', 'wpuf' ); ?> <span class="required">*</span>
            </label>
            <div class="timestamp-wrap">
                <select name="mm">
                    <?php
                    foreach ($month_array as $key => $val) {
                        $selected = ( $key == $month ) ? ' selected="selected"' : '';
                        echo '<option value="' . $key . '"' . $selected . '>' .  $val . '</option>';
                    }
                    ?>
                </select>
   <!--           
<input type="text" autocomplete="off" tabindex="4" maxlength="2" size="2" value="<?php echo date_i18n( 'd' ); ?>" name="jj">,
<input type="text" autocomplete="off" tabindex="4" maxlength="4" size="4" value="<?php echo date_i18n( 'Y' ); ?>" name="aa">
  display current date-->    
<input type="text" autocomplete="off" tabindex="4" maxlength="2" size="2" 
			value="<?php echo  $postdate[2];?>" name="jj">,            
<input type="text" autocomplete="off" tabindex="4" maxlength="4" size="4" value="<?php echo  $postdate[0];?>" name="aa">
                <span style="display:none;">@ <input type="text" autocomplete="off" tabindex="4" maxlength="2" size="2" value="<?php echo date_i18n( 'G' ); ?>" name="hh">
                : <input type="text" autocomplete="off" tabindex="4" maxlength="2" size="2" value="<?php echo date_i18n( 'i' ); ?>" name="mn">
        </span>    </div>
            <div class="clear"></div>
            <p class="description"></p>
        </li>

<li>
                        <label>&nbsp;</label>
                        <input class="wpuf_submit" type="submit" name="wpuf_edit_post_submit" value="<?php echo esc_attr( wpuf_get_option( 'update_label', 'wpuf_labels', 'Update Post' ) ); ?>">
                        <input type="hidden" name="wpuf_edit_post_submit" value="yes" />
                        <input type="hidden" name="post_id" value="<?php echo $curpost->ID; ?>">
                    </li>
                </ul>

            </form>
        </div>

        <?php
    }

    function submit_post() {
        global $userdata;

        $errors = array();

        $title = trim( $_POST['wpuf_post_title'] );
        $content = trim( $_POST['wpuf_post_content'] );

        $tags = '';
        $cat = '';
        if ( isset( $_POST['wpuf_post_tags'] ) ) {
            $tags = wpuf_clean_tags( $_POST['wpuf_post_tags'] );
        }

        //if there is some attachement, validate them
        if ( !empty( $_FILES['wpuf_post_attachments'] ) ) {
            $errors = wpuf_check_upload();
        }

        if ( empty( $title ) ) {
            $errors[] = __( 'Empty post title', 'wpuf' );
        } else {
            $title = trim( strip_tags( $title ) );
        }

        //validate cat
        if ( wpuf_get_option( 'allow_cats', 'wpuf_frontend_posting', 'on' ) == 'on' ) {
            $cat_type = wpuf_get_option( 'cat_type', 'wpuf_frontend_posting', 'normal' );
            if ( !isset( $_POST['category'] ) ) {
                $errors[] = __( 'Please choose a category', 'wpuf' );
            } else if ( $cat_type == 'normal' && $_POST['category'][0] == '-1' ) {
                $errors[] = __( 'Please choose a category', 'wpuf' );
            } else {
                if ( count( $_POST['category'] ) < 1 ) {
                    $errors[] = __( 'Please choose a category', 'wpuf' );
                }
            }
        }
	//if ( $post_date_enable == 'on' ) {
            $month = $_POST['mm'];
            $day = $_POST['jj'];
            $year = $_POST['aa'];
            $hour = $_POST['hh'];
            $min = $_POST['mn'];

            if ( !checkdate( $month, $day, $year ) ) {
                $errors[] = __( 'Invalid date', 'wpuf' );
            }
       // }
        if ( empty( $content ) ) {
            $errors[] = __( 'Empty post content', 'wpuf' );
        } else {
            $content = trim( $content );
        }

        if ( !empty( $tags ) ) {
            $tags = explode( ',', $tags );
        }

        //process the custom fields
        $custom_fields = array();

        $fields = wpuf_get_custom_fields();
        if ( is_array( $fields ) ) {

            foreach ($fields as $cf) {
                if ( array_key_exists( $cf['field'], $_POST ) ) {

                    if ( is_array( $_POST[$cf['field']] ) ) {
                        $temp = implode(',', $_POST[$cf['field']]);
                    } else {
                        $temp = trim( strip_tags( $_POST[$cf['field']] ) );
                    }
                    //var_dump($temp, $cf);

                    if ( ( $cf['type'] == 'yes' ) && !$temp ) {
                        $errors[] = sprintf( __( '"%s" is missing', 'wpuf' ), $cf['label'] );
                    } else {
                        $custom_fields[$cf['field']] = $temp;
                    }
                } //array_key_exists
            } //foreach
        } //is_array
        //post attachment
        $attach_id = isset( $_POST['wpuf_featured_img'] ) ? intval( $_POST['wpuf_featured_img'] ) : 0;

        $errors = apply_filters( 'wpuf_edit_post_validation', $errors );

        if ( !$errors ) {

            //users are allowed to choose category
            if ( wpuf_get_option( 'allow_cats', 'wpuf_frontend_posting', 'on' ) == 'on' ) {
                $post_category = $_POST['category'];
            } else {
                $post_category = array( wpuf_get_option( 'default_cat', 'wpuf_frontend_posting' ) );
            }
	 /*$month = $_POST['mm'];
            $day = $_POST['jj'];
            $year = $_POST['aa'];
            $hour = $_POST['hh'];
            $min = $_POST['mn'];*/

            $post_date = mktime( $hour, $min, 59, $month, $day, $year );
            $post_update = array(
                'ID' => trim( $_POST['post_id'] ),
                'post_title' => $title,
                'post_content' => $content,
                'post_category' => $post_category,
                'tags_input' => $tags,
		"post_date" => date( 'Y-m-d H:i:s',  $post_date),
		"edit_date" => true
            );
		
            //plugin API to extend the functionality
            $post_update = apply_filters( 'wpuf_edit_post_args', $post_update );
		
            $post_id = wp_update_post( $post_update );

            if ( $post_id ) {
                echo '<div class="success">' . __( 'Post updated successfully.', 'wpuf' ) . '</div>';

                //upload attachment to the post
                wpuf_upload_attachment( $post_id );

                //set post thumbnail if has any
                if ( $attach_id ) {
                    set_post_thumbnail( $post_id, $attach_id );
                }

                //add the custom fields
                if ( $custom_fields ) {
                    foreach ($custom_fields as $key => $val) {
                        update_post_meta( $post_id, $key, $val, false );
                    }
                }

                do_action( 'wpuf_edit_post_after_update', $post_id );
            }
        } else {
            echo wpuf_error_msg( $errors );
        }
    }

}

$wpuf_edit = new WPUF_Edit_Post();
