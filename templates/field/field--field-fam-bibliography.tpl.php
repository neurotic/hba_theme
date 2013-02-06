<div class="field-name-field-fam-bibliography"><div class="field-label">General Bibliography:&nbsp;</div>

<?php
  //trim the text with http://api.drupalize.me/api/drupal/function/views_trim_text/7 i http://api.drupal.org/api/views/views.module/function/views_trim_text/7
  $items_trim = array(
    'max_length' => 300,
    'word_boundary' => TRUE,
    'ellipsis' => TRUE,
    'html' => TRUE,
  );

  global $user;
  $flag = flag_get_flag('highlighted');
  if ((!in_array('Basic subscriptor', $user->roles) && !in_array('Supporting subscriptor', $user->roles) && !in_array('editor', $user->roles) && !in_array('administrator', $user->roles)) && ($flag && !$flag->is_flagged($node->nid))) {
    print views_trim_text($items_trim, render($items));
    print '<p class="avis">You are reading a trimmed version of the Systematics section.<br />Only members are able to see the rest of the content. Login or register to access to a lot of extra features !</p>';
  }
  else {
    print render($items);
  }
  
?>

</div>
