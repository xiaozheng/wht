<?php
    global $current_user, $wpdb;
    $user = $wpdb->get_row("select * from {$wpdb->prefix}users where ID=".$current_user->ID);
     
?>
<div class="my-profile">
 
<div id="form" class="form profile-form">
<?php if($_SESSION['member_error']){ ?>
<blockquote class="error" style="margin: 0px;width: 730px"><b>Save Failed!</b><br/><?php echo implode('<br/>',$_SESSION['member_error']); unset($_SESSION['member_error']); ?></blockquote>
<?php } ?>
<?php if($_SESSION['member_success']){ ?>
<blockquote class="success" style="margin: 0px;width: 730px"><b>All Done!</b><br/><?php echo $_SESSION['member_success']; unset($_SESSION['member_success']); ?></blockquote>
<?php } ?>
<form method="post" id="validate_form" name="contact_form" action="">
                                            <ul class="formstyle">
                                                <li><label for="name">Your name: </label><input size="80" type="text" class="required" value="<?php echo $user->display_name;?>" name="profile[display_name]" id="name"></li>
                                                <li><label for="email">Your Email:</label><input size="80" type="text" class="required" value="<?php echo $user->user_email;?>" name="profile[user_email]" id="email"></li>
                                                <li><label for="new_pass">New Password: </label><input size="80" placeholder="Use nothing if you don't want to change old password" type="password" value="" name="password" id="new_pass"> </li>
                                                <li><label for="re_new_pass">Re-type New Password: </label><input size="80" type="password" value="" name="cpassword" id="re_new_pass"> </li>
                                                <li class="full"><label for="message">Description:</label><textarea class="required" cols="40" rows="8" name="profile[description]" id="message"><?php echo htmlspecialchars(stripslashes($current_user->description));?></textarea></li>                                                
                                            </ul>
                                            <div class="clear"></div>
                                            <input type="submit" value="Save Changes" class="submit">
</form>
</div>
</div>