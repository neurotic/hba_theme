<article<?php print $attributes; ?>>

<?php print '<div style="border: 1px solid red; background: #FEF5F1; padding: 20px 15px; margin: 15px 0; clear: both;"><p>template for node revision</p></div>'; ?>

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
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content);
      hide($content['group_sp_admin_display']);
      hide($content['group_sp_tab_taxo']);
      hide($content['group_sp_tab_descr_notes']);
      hide($content['group_sp_tab_voice']);
      hide($content['group_sp_tab_habitat']);
      hide($content['group_sp_tab_food']);
      hide($content['group_sp_tab_breeding']);
      hide($content['group_sp_tab_move']);
      hide($content['group_sp_tab_status']);
      hide($content['group_sp_tab_biblio']);
    ?>
  </div>
  
  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
      <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
    <?php endif; ?>

    
  </div>
  </div>
  <?php print render($content['comments']); ?>
</article>
