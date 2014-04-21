<link href="<?php echo plugins_url('/post-from-frontend/css/tablestyle.css');?>" type="text/css" rel="stylesheet" />
<div id="wraper" class="postbyuser">
         <nav>
<ul>
<li <?php if($_GET['task']==''||$_GET['task']=='edit') echo "class='active'"; ?>><a href='<?php the_permalink();?>'>My posts</a></li>
<!--<li <?php if($_GET['task']=='new') echo "class='active'"; ?> ><a href='<?php the_permalink();?><?php echo $concat;?>task=new'>Add new post</a></li>-->
<li <?php if($_GET['task']=='new') echo "class='active'"; ?> ><a href="<?php echo esc_url( home_url( '/' ) ); ?><?php echo create_post;?>">Add new post</a></li>
<li><a href="<?php echo esc_url( home_url( 'TimeLine' ) ); ?>" style="color:white;">Back To Timeline</a></li>
</ul>
</nav>
