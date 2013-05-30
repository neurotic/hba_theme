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
      print render($content);
      
      if ((!in_array('Basic subscriptor', $user->roles) && !in_array('Supporting subscriptor', $user->roles) && !in_array('editor', $user->roles) && !in_array('administrator', $user->roles))) {
        print '<p class="avis">Only members can view the family teasers list. Login or register to access to a lot of extra features !</p>';
      }
      else {
        // Bloc Families for xxx order
        $view = views_get_view('families_of_the_order');
        $view->set_display('block');
        print '<div class="view-families-of-the-order-wrapper">';
        print '<h2 class="block-title">' . $view->get_title() . '</h2>';
        print $view->preview('block');
        print '</div>';
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
