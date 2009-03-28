<?php
// $Id: comment.tpl.php,v 1.1.8.1 2008/04/08 21:36:25 jgirlygirl Exp $
?>
<!-- start comment.tpl.php -->
<div id="comment-wrapper-<?php print $comment->cid; ?>" class="comment<?php print $comment->new ? ' comment-new' : ''; ?>">
<?php if ($title): ?>
  <span class="title"> <?php print $title; ?>
  <?php if ($comment->new): ?>
    <span class="new"><?php print $new; ?></span>
  <?php endif; // end "new" check ?>
  </span>
<?php endif; // end "title" check ?>
<div class="content"><?php print $content; ?></div>
<?php if ($submitted): ?>
  <div class="info"><?php print $picture ?> <?php print 'Posted by '.  $author; ?> on <?php print $date; ?> </div>
<?php endif; ?>
<?php print $links; ?>
</div>
<!-- end comment.tpl.php -->