<?php

/**
 * @file
 * // "You and other N people like this": http://drupal.org/node/1414246 template file
 * 
 * Default theme implementation to display a flag link, and a message after the action
 * is carried out.
 *
 * Available variables:
 *
 * - $flag: The flag object itself. You will only need to use it when the
 *   following variables don't suffice.
 * - $flag_name_css: The flag name, with all "_" replaced with "-". For use in 'class'
 *   attributes.
 * - $flag_classes: A space-separated list of CSS classes that should be applied to the link.
 *
 * - $action: The action the link is about to carry out, either "flag" or "unflag".
 * - $status: The status of the item; either "flagged" or "unflagged".
 *
 * - $link_href: The URL for the flag link.
 * - $link_text: The text to show for the link.
 * - $link_title: The title attribute for the link.
 *
 * - $message_text: The long message to show after a flag action has been carried out.
 * - $after_flagging: This template is called for the link both before and after being
 *   flagged. If displaying to the user immediately after flagging, this value
 *   will be boolean TRUE. This is usually used in conjunction with immedate
 *   JavaScript-based toggling of flags.
 *
 * NOTE: This template spaces out the <span> tags for clarity only. When doing some
 * advanced theming you may have to remove all the whitespace.
 */
?>

<?php

  //$node = node_load(arg(1)); // aixo dona errors
  $node = menu_get_object();
  if (!empty($node)) {
    $nid = $node->nid;
    $flag_counter = $flag->get_count($nid);
  
  /*global $user;
  if (empty($user->roles[6]) && !in_array('editor', $user->roles) && !in_array('administrator', $user->roles)) {
    print '<p>';
    print $flag_counter.' people have seen it. ';
    print l('Log in to mark this species as seen', 'user/login', array('query' => drupal_get_destination()));
    print '.</p>';
    // AIXO NO FUNCIONA. INCOMPATIBILITAT AMB EL FET QUE AQUEST FLAG ES NOMES PER SUPPORTING?
    Veure http://drupal.org/node/301680#comment-5041624 / https://lynxeds.teamworkpm.net/tasks/1292257 . Veure amb Flag API 3.x i/o amb mòdul flag_anon
  }
  else {*/
    //print '<p>' . flag_create_link('seen', $node->nid) . '</p>';

  
    /*$flag_counter2 = 'Flag counter fix: ' . $flag_counter . '<br />';
    print $flag_counter2;
    print 'Flag counter: ' . $flag_counter . '<br />';*/
    
    if ($flag_counter != 0){
      //not yet flagged by me
      
      if ($status == 'unflagged'){
           if($flag_counter == 1){
                $link_text = t("1 user have seen it");
            }else{
                $link_text = t($flag_counter." users have seen it");
            }
   
        //flagged by me
        }else{
       
            if ($flag_counter == 1){
                $link_text = t("You're the only user who have seen it");
            }elseif($flag_counter == 2){
                $link_text = t("You and another user have seen it");
            }else{
                $link_text = t("You and other ".($flag_counter-1)." people have seen it");
            }
           
        }
    }
    else{
      $link_text = t("Nobody has seen it");
    }
  }
  ?>

<div class="<?php print $flag_wrapper_classes; ?>">
  <?php if ($link_href): ?>
    <a href="<?php print $link_href; ?>" title="<?php print $link_title; ?>" class="<?php print $flag_classes ?>" rel="nofollow"><?php print $link_text; ?></a><span class="flag-throbber">&nbsp;</span>
  <?php else: ?>
    <span class="<?php print $flag_classes ?>"><?php print $link_text; ?></span>
  <?php endif; ?>
  <?php if ($after_flagging): ?>
    <span class="flag-message flag-<?php print $status; ?>-message">
      <?php print $message_text; ?>
    </span>
  <?php endif; ?>
</div>

<?php //} ?>
