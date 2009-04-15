<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>">

<head>
  <title><?php print $head_title ?></title>
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
</head>

<body>
  <div id="header">
    <div id="headerInner">
      <div id="logowrapper">
        <?php if ($logo) { ?><div id="logo">
            <a href="<?php print $base_path ?>" title="<?php print t('SEOposition.com') ?>"><img src="<?php print $logo ?>" alt="<?php print t('SEOposition.com - Internet Marketing') ?>" /></a>
          </div><?php } ?>
        <?php if ($site_name) { ?><div id="siteName">
            <a href="<?php print $base_path ?>" title="<?php print t('Home') ?>"><?php print $site_name ?></a>
          </div><?php } ?>
        <?php if ($site_slogan) { ?><p><?php print $site_slogan ?></p><?php } ?>
      </div>
      <div id="navigation">
        <?php print theme('menu_links', $primary_links) ?> 
      </div>	
    </div>
  </div>

  <!-- main -->
  <div id="main">
    <div id="mainInner">
      <div id="primaryContent">
        <div id="columns" style="width: <?php print alek_2_0_get_primaryContent_width( $sidebar_left, $sidebar_right) ?>%;">
          <?php if ($breadcrumb) { ?><div class="breadcrumb"><?php print $breadcrumb ?></div><?php } ?>
          <?php if ($mission) { ?><div id="mission"><div id="mcontainer"><div id="mcontainer1"><?php print $mission ?></div></div></div><?php } ?>		  
          <?php if ($title) { ?><h1 class="pageTitle"><?php print $title ?></h1><?php } ?>
          <?php if ($tabs) { ?><div class="tabs"><?php print $tabs ?></div><?php } ?>
          <?php if ($help) { ?><div class="help"><?php print $help ?></div><?php } ?>
          <?php if ($messages) { ?><div class="messages"><?php print $messages ?></div><?php } ?>
          <?php print $content ?>
          <?php if (!empty($signature) && $comment->cid > 0):
		  // Put the highest comment ID(in place of 0) before upgrading to Drupal 6
		  // to prevent double-display of signatures on old posts ?>
            <?php print $signature ?>
          <?php endif; ?>
        </div>
      </div>
      <!-- sidebars -->
      <div id="secondaryContent">
        <?php if ($sidebar_left) { ?>
		      <div id="sidebarLeft">
			      <span id="topspan"></span>
            <div class="sidebarLeft-content">
				      <?php print $sidebar_left ?>
				    </div>
			      <span id="bottomspan"></span>
		      </div>
		    <?php } ?>
        <?php if ($sidebar_right) { ?>
          <div id="sidebarRight">
            <?php print $sidebar_right ?>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <!-- footer -->
  <div class="FooterContain">
    <div class="Footer">
      <div class="FooterRecent">
        <?php print $footer_left; ?>
      </div>
      <div class="FooterCommented">
        <?php print $footer_middle; ?>
      </div>
      <div class="FooterPartners">
        <?php print $footer_right; ?>
      </div>

      <div class="FooterCopy">
	      <p>
	        <a href="<?php print $GLOBALS['base_url'] ?>/rss.xml" title="Syndication"><acronym title="Really Simple Syndication">RSS</acronym></a>, 
		      <a href="http://validator.w3.org/check?uri=referer" title="Valid XHTML"><acronym title="eXtensible Hyper Text Markup Language">XHTML</acronym></a>, 
		      <a href="http://jigsaw.w3.org/css-validator/check/referer" title="Valid CSS"><acronym title="Cascading Style Sheet">CSS</acronym></a>
          <?php if (!empty($footer)) { ?> | <?php print $footer ?><?php } ?>
        </p>
	      <div class="seoposition">
	        <a href="http://www.seoposition.com/drupal-development/custom-drupal-cms-development.html">Drupal Themes Design</a> by SEOposition.com
	      </div>
      </div>
    </div>
  </div>
  <?php print $closure ?>
</body>
</html>
