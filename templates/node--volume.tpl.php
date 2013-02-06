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
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      
      global $user;

      // Show only Taxonomy section for unprivileged users.
      if ($user->uid != 1 && !in_array('administrator', $user->roles)) {

        print 'Body: ' . $content['body'] . '<br />';
        //print 'Volume number: ' . $content['vol_nb'] . '<br />';
        //print 'Volume number: ' . $content['vol_nb'][0] . '<br />';
        //print 'Volume number: ' . $content['vol_nb'][0]['value'] . '<br />';
        foreach ((array)$field_vol_nb as $item) {
          print $item['value'] . '<br />';
        }
        print 'Volume number: ' . $content['field_vol_nb'] . '<br />';
        print 'Volume number: ' . $content['field_vol_nb'][0] . '<br />';
        print 'Volume number: ' . $content['field_vol_nb'][0]['value'] . '<br />';
        //print 'Volume number: ' . $node->field_vol_nb[0]['value'] . '<br />';
        //print 'Volume number: ' . $node->field_vol_nb[0]['view'] . '<br />';

      }
      else {
        print render($content);
        }
      //print render($content);
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
