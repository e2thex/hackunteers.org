<div class="commentbox<?php if ($comment->status == COMMENT_NOT_PUBLISHED) print ' comment-unpublished'; ?>">
  <?php if ($picture) { ?>
    <?php print $picture; ?>
  <?php } else { ?>
    <div class="avatar"></div>
  <?php } ?>
	<div class="author_meta">
	  <?php print $title; ?>
	  <?php print $content; ?>
	  <span class="comment_links"><?php print $links; ?></span>
	  <span class="comment_date"><?php print $submitted; ?></span>
	</div>
  <div class="clearfix"></div>
</div>
