<?php
global $user;
// content only visible if current user if node author or admin
if ($user->uid == $uid || in_array('administrator', $user->roles)) {
?>

<div class="node-inner teaser">
  
  <div<?php print $content_attributes; ?>>
    <?php
      // We hide the links now so that we can render them later.
      hide($content['links']);
      
      print render($content);
      
      // Inline delete
      // FALTA POSAR TOT AIXO DINS DUN MODAL; I CREAR EL LINK A AQUEST MODAL. http://drupal.org/node/1046120
      // http://drupal.stackexchange.com/questions/34750/how-to-make-node-delete-confirmation-inline
      
      /*$item = menu_get_item("node/$nid/delete");
      if ($item['access']) {
          include_once(drupal_get_path('module', 'node') . '/node.pages.inc');
          $page_title = drupal_get_title();
          $delete_form = drupal_get_form('node_delete_confirm', $node);
          print render($delete_form);
          drupal_set_title($page_title, PASS_THROUGH);
          //drupal_goto('checklist');
      }
      */
      

      //print '<a href="/node/' . $node->nid . '/delete?destination=checklist">Delete</a>';
      
    ?>
  </div>
  
  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
      <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
    <?php endif; ?>
  </div>
  
</div>

<?php }
else {
  // The other users should not find in the website any information about another user trip, so we show a fake title
  print "MyRecord";
}

?>
