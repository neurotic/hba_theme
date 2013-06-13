<?php
  // ocultem el numero d'ordenacio...
  //print render($item);
  //...i fem servir aquest template només per enganxar-hi la species table
  $flag = flag_get_flag('highlighted');
  if ( (!empty($user->roles[5]) || !empty($user->roles[6]) || !empty($user->roles[7]) || !empty($user->roles[4]) || !empty($user->roles[3])) || ($flag && $flag->is_flagged($element['#object']->nid)) ) {
    print '<div class="embedded-view">' . views_embed_view('species_table_by_family','block_1', $element['#object']->nid) . '</div>';
  }
  else {
    print '<img alt="Sample species table image" height="240px" src="/sites/default/files/species-list-sample.png" width="100%" /><div class="avis"><p>A list of the species of the family is displayed to subscribers.</p>You are currently a free subscriber of the HBW Alive. To make the most of all of HBW\'s features, discover our subscriptions now by clicking on the button below.<div class="btn-container"><a title="Compare subscriptions" class="btn" href="/pricing">HBW Alive Plans & Pricing</a>&nbsp;&nbsp;' . l('Why subscribe','subscriptions', array('attributes' => array('title' => t('Why subscribe ?'),'class' => 'btn'))) .'<div class="sign-in">or <a title="Sign in now if you already have a membership" href="/user">sign in</a> if you already have a membership</div></div></div>';
  }
?>
