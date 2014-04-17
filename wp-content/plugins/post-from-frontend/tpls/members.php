<?php
 

    
    have_posts();
    the_post();
   v
?>
       
    <div class="page">
      
    <?php  
     
       if(!is_user_logged_in()) wp_login_form();
       wp_register();
      
    ?>    

    </div><!--page close-->
  