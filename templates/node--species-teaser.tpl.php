<article<?php print $attributes; ?>>

  <?php if (!$page && $title): ?>
  <header>
    <?php print render($title_prefix); ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php print render($title_suffix); ?>
  </header>
  <?php endif; ?>
  <div class="node-inner">
  <?php if ($display_submitted): ?>
  <footer class="submitted"><?php print $date; ?> -- <?php print $name; ?></footer>
  <?php endif; ?>  
  
  <div<?php print $content_attributes; ?>>
 
  <?php
  if (!empty($content['field_sp_descr_notes'])) {
    print '<div class="description">' . render($content['field_sp_descr_notes']) . '</div>';
  }  
  print '<div class="thumbnail">' . views_embed_view('species_figure','block_4', $element['#object']->nid) . '</div>';
  print '<p><a href="/">< back to Species account</a></p>';
  ?>

  </div>
  </div>
</article>
