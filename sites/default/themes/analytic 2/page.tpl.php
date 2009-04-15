<?php
// $Id: page.tpl.php,v 1.8 2009/01/29 14:32:52 troy Exp $
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $language->language ?>" xml:lang="<?php echo $language->language ?>" dir="<?php echo $language->dir ?>" id="html-main">

<head>
  <title><?php echo $head_title ?></title>
  <?php echo $head ?>
  <?php echo $styles ?>
  <?php echo $scripts ?>
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyle Content in IE */ ?> </script>
</head>

<body class="body-main">
	
	
<!-- / make-it-center --><div class="make-it-center">

<div class="top-menu clear-block">
  <?php if ($mission): ?>
    <span class="mission"><?php echo $mission ?></span>
  <?php endif; ?>  
  
  <!-- >>>>>>>> REMOVE THIS IF YOU WANT TO GET RID OF TOP LINKS (RSS, LOGIN, REGISTER | PROFILE) start-->  
  
  <div id="top-links">
    <ul class="top-links-ul">
    <?php if (!$user->uid): ?>	
    	<li><?php echo l(t("Log in"), "user");?></li>
      <?php if ($registration_enabled): ?>    	
    	<li><?php echo l(t("Create new account"), "user/register");?></li>
    	<?php endif; ?>
    <?php else: ?> 
       <li><?php echo t("You are logged in as <strong>!user</strong>", array('!user' => l($user->name, "user"))); ?>&nbsp;|&nbsp;<?php echo l(t("Edit"), "user/" . $user->uid . "/edit");?></li>
      	<li><?php echo l(t("Log out"), "logout"); ?></li>
    <?php endif; ?>
    
	<?php if ($feed_icons): ?>
	<li><a href="<?php echo url("rss.xml"); ?>"><img src="<?php echo base_path() . path_to_theme() ?>/images/rss.gif"  alt="RSS" /></a></li>
	<?php endif; ?>
   
	
	</ul>
  </div>
  
  <!-- <<<<<<<< REMOVE THIS IF YOU WANT TO GET RID OF TOP LINKS (RSS, LOGIN, REGISTER) end -->

</div>

<!-- logo-container -->
<div id="logo-container">
  <div id="money-bg" class="clear-block">
  <div id="logo<?php if ($logo && !$site_name && !$site_slogan): ?>-no-padding<?php endif; ?>">
  
			<?php if ($logo): ?> 
            <div id="logo-picture">
            <a href="<?php print $base_path ?>" title="<?php print t('Home') ?>"><img src="<?php print $logo ?>" alt="<?php print t('Home') ?>" /></a>
            </div>
            <?php endif; ?>


 <?php if ($site_name): ?>
 <!-- if logo picture is defined, text is aligned to left -->
 
    <h1 <?php if ($logo && !$site_slogan): ?>class="logo-picture-true-slogan-false"<?php endif; ?>  <?php if ($logo): ?>class="logo-picture-true"<?php endif; ?>><a href="<?php echo $front_page; ?>" title="<?php echo t('Home') ?>"><?php echo $site_name ?></a></h1>
  <?php endif; ?>
  
 <?php if ($site_slogan): ?>
 <!-- if logo defined, text is aligned to left -->
    <strong <?php if ($logo): ?>class="logo-picture-true"<?php endif; ?>><?php echo $site_slogan; ?></strong>
  <?php endif; ?> 
  </div>
  </div>
</div>
<!-- /logo-container -->


<!-- primary menu -->
<div class="rws-primary-menu clear-block">
  <?php if ($search_box): ?>
  <div id="search-box">
    <?php print $search_box; ?>
  </div><!-- /search-box -->
  <?php endif; ?>
  
  
  
   <?php if (isset($primary_links)) : ?>
     <?php echo theme('links', $primary_links, array('class' => 'links primary-links')) ?>
   <?php endif; ?>
  
  
  <!-- admin edit   -->
  <?php if ($is_admin): ?>
    <?php echo l(t("Edit menu"), "admin/build/menu-customize/primary-links", array("attributes" => array("class" => "edit-this-link"))); ?>
  <?php endif; ?>
  <!-- admin edit   -->
  
  
  
    <!-- admin panel   -->
   <?php if ($is_admin): ?>
    <ul id="rws-uni-tabs" class="clear-block">
      <li><?php echo l(t("Administer"), "admin"); ?></li>
      <li><?php echo l(t("Blocks"), "admin/build/block"); ?></li>
      <li><?php echo l(t("Menus"), "admin/build/menu"); ?></li>
      <li><?php echo l(t("Modules"), "admin/build/modules"); ?></li>
      <li><?php echo l(t("Translation"), "admin/build/translate/search"); ?></li>
    </ul>
  <?php endif; ?>
  <!-- / admin panel -->


</div>
<!--  /primary menu -->


<?php if ($left): ?>
<!-- column-1 -->
<div class="column-1"><?php echo $left ?></div>
<!-- / column-1 -->
<?php endif; ?>





<!-- column-2 --><div class="column-2 
<?php if (!$right && !$left): ?>no-right-and-left-columns
<?php elseif (!$left): ?>
no-left-column
<?php elseif (!$right): ?>
no-right-column
<?php endif; ?>
">


		<?php if ($show_messages): ?>
		<?php echo $messages; ?>
		<?php endif; ?>
        


<!-- PRINTING BLOCKS BEFORE THE CONTENT (with RED headers) -->
<?php if ($top_content_block_left || $top_content_block_right): ?>
  <!-- column-2-blocks -->
  <div id="block-top" class="column-2-blocks clear-block 
  <?php if (!$right&&!$left): ?>column-2-blocks-no-right-and-left-columns
  <?php elseif (!$left): ?>
  column-2-blocks-no-left-column
  <?php elseif (!$right): ?>
  column-2-blocks-no-right-column
  <?php endif; ?>
  ">
  <!-- /column-2-blocks-left --><div class="column-2-blocks-left">
  <?php if ($top_content_block_left): ?><?php echo $top_content_block_left ?><?php endif; ?>
  <?php if (!$top_content_block_left): ?>&nbsp;<?php endif; ?>
  <!-- /column-2-blocks-left --></div>
  <!-- /column-2-blocks-right --><div class="column-2-blocks-right">
  <?php if ($top_content_block_right): ?><?php echo $top_content_block_right ?><?php endif; ?>
  <!-- /column-2-blocks-right --></div>
  <!-- /column-2-blocks --></div>
<?php endif; ?>
<!-- PRINTING BLOCKS BEFORE THE CONTENT (with RED headers) -->

<?php if ($content_top): ?><div id="content-top"><?php echo $content_top ?></div><?php endif; ?>



		<?php echo $breadcrumb ?>
		
		<?php echo $help ?>



		<?php if ($title): ?><h1 class="title"><?php echo $title ?></h1><?php endif; ?>
		<?php if ($tabs): ?><div class="tabs"><?php echo $tabs; ?></div><?php endif; ?>
		<!-- main-content-block --><div class="main-content-block"> 
		<?php echo $content; ?>
		<!-- /main-content-block --></div>
		
<?php if ($content_bottom): ?><?php echo $content_bottom ?><?php endif; ?>
        



<!-- PRINTING BLOCK AFTER THE CONTENT -->

<?php if ($content_block_left || $content_block_right): ?>

  <!-- column-2-blocks -->
  <div class="column-2-blocks clear-block 
  <?php if (!$right && !$left): ?>column-2-blocks-no-right-and-left-columns
  <?php elseif (!$left): ?>
  column-2-blocks-no-left-column
  <?php elseif (!$right): ?>
  column-2-blocks-no-right-column
  <?php endif; ?>
  ">
  <!-- /column-2-blocks-left --><div class="column-2-blocks-left">
  <?php if ($content_block_left): ?><?php echo $content_block_left ?><?php endif; ?>
  <?php if (!$content_block_left): ?>&nbsp;<?php endif; ?>
  <!-- /column-2-blocks-left --></div>
  
  
  
  <!-- /column-2-blocks-right --><div class="column-2-blocks-right">
  <?php if ($content_block_right): ?><?php print $content_block_right ?><?php endif; ?>
  <!-- /column-2-blocks-right --></div>
  <!-- /column-2-blocks --></div>

<?php endif; ?>


<?php if ($content_after_blocks): ?><div class="content_after_blocks"><?php if ($content_after_blocks): ?><?php echo $content_after_blocks ?><?php endif; ?></div><?php endif; ?>



<!-- / column-2 --></div>



<?php if ($right): ?>
<!-- column-3 -->
<div class="column-3"><?php echo $right ?></div>
<!-- / column-3 -->
<?php endif; ?>



<!-- footer -->
<div id="footer" class="clear-block">
 
  <?php echo $footer ?>

<div class="clear-both">
  <?php echo $footer_message ?>
  <?php echo $closure ?>
</div>

</div>
<!-- /footer -->



</div>
<!-- / make-it-center -->

	</body>
</html>

