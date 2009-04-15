<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>">
<head>
<title><?php print $head_title ?></title>
<?php print $head ?>
<?php print $styles ?>
<?php print $scripts ?>
<?php if ((arg(2) == 'themes') || (arg(2) == 'track')) { ?>
<style type="text/css">
#outerColumn {border-right: none !important;}
#rightCol {display: none;}
</style>
<?php } ?>
</head>

<body class="<?php print $body_classes; ?>">
<div id="pageWrap">
	<div id="header">
		<div class="inside">
			<div class="header_left">
				<?php if ($logo) { ?><a href="<?php print $front_page ?>" title="<?php print $site_name.'-'.t('Home') ?>"><img src="<?php print $logo ?>" alt="<?php print $site_name.'-'.t('Home') ?>" /></a><?php } ?>
				<div class="header_text">
					<?php if ($site_name) { ?><h1 class="site-name"><a href="<?php print $front_page ?>" title="<?php print $site_name ?>"><?php print $site_name ?></a></h1><?php } ?>
					<?php if ($site_slogan) { ?><span class="site-slogan"><?php print $site_slogan ?></span><?php } ?>
				</div>
			</div>
			<?php if ($search_box || isset($primary_links)) { ?><div class="header_right">
				<div class="search">
					<?php print $search_box ?>
				</div>
				<?php if (isset($primary_links)) { print theme('links', $primary_links, array('class' => 'links', 'id' => 'navlist')); } ?>
			</div><?php } ?>
		</div>
	</div>
	<div id="outerColumn">
		<div id="innerColumn">
			<div id="soContainer">
				<div id="content">
					<div class="inside">
						<?php if ($mission) { ?><div class="mission"><?php print $mission ?></div><?php } ?>
						<?php if ($header) { ?><div class="intro"><?php print $header ?></div><?php } ?>
						<?php print $breadcrumb ?>
						<?php if ($tabs) { ?><div class="tabs"><?php print $tabs ?></div><?php } ?>
						<?php if ($title) { ?><h1 class="title"><?php print $title ?></h1><?php } ?>
						<?php print $help ?>
						<?php if ($show_messages) { print $messages; } ?>
						<?php print $content; ?>
						<?php print $feed_icons; ?>
					</div>
				</div>
				<?php if ($left) { ?><div id="leftCol">
					<div class="inside">
						<?php print $left ?>
					</div>
				</div><?php } ?>
				<div class="clr"></div>
			</div>
			<?php if ($right) { ?><div id="rightCol">
				<div class="inside">
					<?php print $right ?>
				</div>
			</div><?php } ?>
		</div>
		<div class="clr"></div>
	</div>
	<div id="footer">
		<div class="inside">
			<?php if ($footer_message || $footer) { ?><div class="footer_left">
				<?php print $footer_message ?>
				<?php print $footer ?>
			</div><?php } ?>
			<div class="footer_right">
				<?php print theme('links', $secondary_links, array('class' => 'links', 'id' => 'subnavlist')); ?>
				<?php /*?>You may remove this link<?php */?>
				<div class="powered">powered by <a href="http://www.freecmsdesigns.com" title="Foliage theme by FreeCmsDesigns.com">FreeCmsDesigns.com</a></div>
			</div>
			<div class="clr"></div>
		</div>
	</div>
</div>
<?php print $closure ?>
</body>
</html>