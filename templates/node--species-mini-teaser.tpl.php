<a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a>
 
<?php
  if (!empty($content['field_sp_descr_notes'])) {
    print '(this is the mini-teaser view mode)';
    print '<div class="description">' . render($content['field_sp_genus']) . '</div>';
  }  
  print '<div class="thumbnail">' . views_embed_view('species_figure','block_4', $element['#object']->nid) . '</div>';
?>
