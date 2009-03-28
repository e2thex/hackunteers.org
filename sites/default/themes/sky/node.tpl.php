<?php // $Id$ ?>
<!-- start node.tpl.php -->
<div id="node-<?php print $node->nid; ?>" class="node<?php print " node-" . $node->type; ?><?php print $sticky ? ' node-sticky' : ''; ?>">
<?php if (!$page && $title): ?>
  <h2 class="title"><a href="<?php print $node_url; ?>" title="<?php print $title; ?>"><?php print $title; ?></a></h2>
<?php endif; ?>
<?php if ($submitted): ?>
  <div class="info"><?php print $picture; ?>
    <p><?php print $submitted; ?></p>
    <?php if ($terms): ?>
      <div class="btn-tags"><?php print $terms; ?></div>
    <?php endif; ?>
  </div>
<?php endif; ?>
<div class="content"><?php print $content; ?></div>
<?php if ($links): ?>
  <div class="btn-links"><?php print $links; ?></div>
<?php endif; ?>
</div>
<!-- end node.tpl.php -->