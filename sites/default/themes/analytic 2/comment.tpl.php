<?php
// $Id: comment.tpl.php,v 1.1 2008/12/23 20:11:02 troy Exp $
?>

<div class="clear-block comment<?php if ($comment->status == COMMENT_NOT_PUBLISHED) print ' comment-unpublished'; ?>">
<?php if ($picture) { print $picture; } ?>
<span class="submitted"><?php print $submitted; ?></span>&nbsp;<span class="this-link 	 <?php if ($new != '') { ?>new <?php } ?>"><?php echo "<a href=\"$node_url#comment-$comment->cid\">#</a>"; ?></span>


<div class="content"><?php print $content; ?></div>
<div class="links-comment "><?php print $links; ?></div> &nbsp;</div>
