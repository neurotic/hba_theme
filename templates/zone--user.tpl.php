<?php if (!empty($_SESSION['global_filter']['view_taxo_paisos'])): ?><div id="active-country"><?php endif; ?>
<?php if ($wrapper): ?><div<?php print $attributes; ?>><?php endif; ?>
  <div<?php print $content_attributes; ?>>
    <?php print $content; ?>
  </div>
<?php if ($wrapper): ?></div><?php endif; ?>
<?php if (!empty($_SESSION['global_filter']['view_taxo_paisos'])): ?></div><?php endif; ?>
