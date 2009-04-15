<?php
// $Id: panels-rounded-corners-box.tpl.php,v 1.1.2.1 2009/02/05 01:57:17 merlinofchaos Exp $
/**
 * @file
 *
 * Display the box for rounded corners.
 *
 * - $content: The content of the box.
 */
?>
<div class="rounded_corner">
  <div class="wrap-corner">
    <div class="t-edge"><div class="l"></div><div class="r"></div></div>
    <div class="l-edge">
      <div class="r-edge">
        <?php print $content; ?>
      </div>
    </div>
    <div class="b-edge"><div class="l"></div><div class="r"></div></div>
  </div>
</div>
