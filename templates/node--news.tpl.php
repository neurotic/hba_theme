<article<?php print $attributes; ?>>
  <?php if (!$page && $title): ?>
  <header>
    <?php print render($title_prefix); ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php print render($title_suffix); ?>
  </header>
  <?php endif; ?>
  <div class="node-inner <?php if (!$teaser) { print 'full'; } ?>">
  <?php //if ($display_submitted): ?>
  <footer class="submitted"><?php print $date; ?> -- <?php print $name; ?>
  <?php
    /*
    if ($teaser) {
      //$user_item = user_load_by_name($name); // or $user_item = user_load($user->uid);
      //print $user_picture;
      //$user_picture1 = $user_item['picture'][0]['uri'];
      //print theme('image_style', array( 'path' =>  $user_picture1, 'style_name' => 'icon', 'width' => '30', 'height' => '30'));
      
      $user = user_load($uid);
      print theme('user_picture', array('account' =>$user,'style_name' => 'icon'));
      //==> bug http://drupal.org/node/1021564. No es pot utilitzar style en user_picture. S'ha de crear un camp imatge propi des de http://alive.hbw.com/admin/config/people/accounts/fields
    } */
  ?>
  </footer>
  <?php //endif; ?>  
  
  <div<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      //print render($content);
      //dsm($content);
      
      // Print content
      print '<div class="body">' . render($content['body']) . '</div>';
      if (!$teaser) {
        print '<div id="match"><div class="label">Related content matching this news</div>' . render($content['field_wiki_sp']) . '</div>'; // Rendered as teaser (també es podria fer aqui unes queries per mostrar titol, taxo i figure). El view mode "mini_teaser" de Display Suite no funciona (mostra el full node perque a node--species.tpl.php tenim if teaser ... else) i alla la variable $mini_teaser no existeix
      }
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
