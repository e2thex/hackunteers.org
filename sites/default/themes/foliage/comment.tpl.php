<div class="comment<?php if (isset($comment->status) && $comment->status == COMMENT_NOT_PUBLISHED) print ' comment-unpublished'; ?>">
	<?php if ($picture) print $picture; ?>
	<h3 class="title"><?php print $title; ?></h3><?php if ($new != '') { ?><span class="new"><?php print $new; ?></span><?php } ?>
	<div class="submitted"><?php print $submitted; ?></div>
	<div class="content"><?php print $content; ?></div>
	<?php if ($signature) { ?><div class="signature">
  	<?php print $signature ?>
	</div><?php } ?>
	<div class="links">&raquo; <?php print $links; ?></div>
</div>