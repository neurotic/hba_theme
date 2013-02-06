<?php
global $user;

if (in_array('Basic subscriptor', $user->roles) || in_array('Supporting subscriptor', $user->roles) || in_array('editor', $user->roles) || in_array('administrator', $user->roles)) { ?>

  <div id="<?php print $views_fluidgrid_id ?>" class="views-fluidgrid-wrapper clear-block">
      <?php foreach ($rows as $row): ?>
        <div class="views-fluidgrid-item">
          <div class="views-fluidgrid-item-inner">
            <?php print $row ?>
          </div>
        </div>
      <?php endforeach; ?>
  </div>
  
<?php }

else {
  print '<div class="thumbnail">' . views_embed_view('slideshow','page') . '</div>';
}
?>
