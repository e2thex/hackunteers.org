<div class="node<?php if ($sticky) { print " sticky"; } ?><?php if (!$status) { print " node-unpublished"; } ?>">
	<?php if ($page == 0) { ?><div class="nodeTitle<?php if (!$picture) {print ' nobreak';}?>"><a href="<?php print $node_url?>"><?php print $title?></a></div><?php }; ?>
	<?php if ($submitted) { ?><div class="submitted"><?php print $submitted?></div><?php }; ?>
  <div class="content">
  <?php if ($picture) { ?>
    <?php if ($page == 0) { print '<div class="clearpic"></div>'; } ?><?php print $picture; ?>
  <?php } ?>
  <?php print $content?></div>
	<div class="linkswrap">
	<?php if ($links) { ?><div class="postlinks"><?php print $links?></div><?php }; ?>
	<?php if ($terms) { ?><div class="taxonomy">Tags: <?php print $terms?></div><?php } ?>
	</div>
</div>
