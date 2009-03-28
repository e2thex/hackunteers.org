<?php
// $Id$
?>
<!-- start comment-forum.tpl.php -->
<div class="forum-post forum-post-reply<?php print $comment->new ? ' forum-post-new' : ''; ?>">
  <h2 class="title"> <?php print $title ?><?php print $comment->new ? ' <a name="new" id="new">'. $new .'</a>' : '' ?> </h2>
  <div class="forum-wrapper-left">
    <div class="meta-author">
      <ul class="author">
        <?php if ($picture): // print users picture, if enabled ?>
        <li class="user-picture"><?php print $picture; ?></li>
        <?php endif; ?>
        <li class="user-name"><span><?php print $name; ?></span></li>
          <?php if ($joined): ?>
        <li class="user-joined">
          <label>Joined:</label>
          <span><?php print $joined; ?></span></li>
        <?php endif; ?>
      <li class="user-status<?php print $user_status ? '-online' : '-offline'; ?>">
          <span><?php print $user_status ? 'Online Now' : 'Offline'; ?></span> </li>
      </ul>
    </div>
  </div>
  <div class="forum-wrapper-right<?php print $picture ? ' with-picture' : ' without-picture'; // for modifiable min-height ?>">
    <div class="meta-post">
      <ul>
        <li class="date">
          <label>Posted:</label>
          <span><?php print $date; ?></span></li>
        <li class="comment-link"><span><?php print $comment_link; ?></span></li>
      </ul>
    </div>
    <div class="content">
      <?php print $content; ?>
    </div>
  </div>
  <br class="clear" />
  <div class="links"><?php print $links; ?> </div>
</div>
<!-- end comment-forum.tpl.php -->