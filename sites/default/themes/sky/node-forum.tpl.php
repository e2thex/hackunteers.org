<?php
// $Id$

// Show nodes normally when they appear outside of the forum
if (!$page) {
  include('node.tpl.php');
  return;
}

// Separate the filtered version of the node body, so we can print a filtered version, without the forum navigation
$body = $node->content['body']['#value'];

// Unset all fields we don't want to print in the $content variable
unset($node->content['#children']); // required
unset($node->content['forum_navigation']);
unset($node->content['body']);

// Modified content variable, includes all fields except the actual body & the fields explicitly removed above
$content = NULL;

// look for cck fields to print
foreach ($node->content as $key => $field) {
  if (!empty($field['#value'])) {
    $content .= $field['#value'];
  }
  // look for cck fields in fieldgroups to print
  elseif (is_array($field)) {
    foreach ($field as $groupfield) {
      if (!empty($groupfield['#value'])) {
        $content .= $groupfield['#value'];
      }
    }
  }
}
?>
<!-- start node-forum.tpl.php -->
<div class="forum-post forum-post-top">
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
      <span class="date">Posted:</span> <?php print $date; ?></span>
    </div>
    <div class="content">
      <?php print $body; ?>
      <?php if ($content): ?>
        <div class="content-additional"><?php print $content; ?></div>
      <?php endif ?>
    </div>
  </div>
  <br class="clear" />
  <div class="links"><?php print $links; ?> </div>
</div>
<!-- end node.tpl.php -->