<div class="field-name-field-fam-relationship">

<?php
  //trim the text with http://api.drupalize.me/api/drupal/function/views_trim_text/7
  $items_trim = array(
    'max_length' => 300,
    'word_boundary' => TRUE,
    'ellipsis' => TRUE,
    'html' => TRUE,
  );

  global $user;
  if ( arg(0) == 'node' && is_numeric(arg(1)) ) {
    $flag = flag_get_flag('highlighted');
  }
  if ( (empty($user->roles[5]) && empty($user->roles[6]) && empty($user->roles[7]) && empty($user->roles[4]) && empty($user->roles[3])) && (isset($flag) && !$flag->is_flagged($element['#object']->nid)) ) {
    print views_trim_text($items_trim, render($items));
    print '<span class="hide-text"></span><div class="avis">You are reading a trimmed version of the Relationship with Man section.<br />Only members are able to see the rest of the text. To make the most of all of HBW\'s features, discover our subscriptions now.<div class="btn-container"><a title="Compare subscriptions" class="btn" href="/pricing">HBW Alive Plans & Pricing</a>&nbsp;&nbsp;' . l('Why subscribe','subscription-plans', array('attributes' => array('title' => t('Why subscribe ?'),'class' => 'btn'))) .'<div class="sign-in">or <a title="Sign in now if you already have a membership" href="/user">sign in</a> if you already have a membership</div></div></div>';
  }
  else {
    print render($items);
  }
  
?>

</div>
