<?php // $Id$ ?>
<!-- start block.tpl.php -->
<div id="block-<?php print _sky_id_safe($block->module); ?>-<?php print $block->delta; ?>" class="<?php print $classes; ?>">
<?php if ($block->subject): ?>
  <div class="title"><?php print $block->subject; ?></div>
<?php endif; ?>
  <div class="content"><?php print $block->content; ?></div>
</div>
<!-- end block.tpl.php -->