<?php

/**
 * @file
 * Bartik's theme implementation to provide an HTML container for comments.
 *
 * Available variables:
 * - $content: The array of content-related elements for the node. Use
 *   render($content) to print them all, or
 *   print a subset such as render($content['comment_form']).
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default value has the following:
 *   - comment-wrapper: The current template type, i.e., "theming hook".
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * The following variables are provided for contextual information.
 * - $node: Node object the comments are attached to.
 * The constants below the variables show the possible values and should be
 * used for comparison.
 * - $display_mode
 *   - COMMENT_MODE_FLAT
 *   - COMMENT_MODE_THREADED
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess_comment_wrapper()
 */
?>
<a name="comments"></a>
<div id="comments" class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php if ($content['comments'] && $node->type != 'forum'): ?>
    <?php print render($title_prefix); ?>
    <?php //print t('Comments'); ?>
    <?php print render($title_suffix); ?>
  <?php endif; ?>

  <?php 
    //if (!empty($content['comments'])) {
      print render($content['comments']);
    //}
    //else {
      //print 'No comments yet';
    //}

  /*global $user;
  if (!empty($user->roles[8])) {
    print 'You need a subscription to be able to comment on that element.';
  }
  else {*/
  
    if ($content['comment_form']): ?>
    <a name="comment-form"></a>
    <?php
      /*global $user;
      if (!$user->uid || (empty($user->roles[5]) && empty($user->roles[6]) && empty($user->roles[7]) && empty($user->roles[4]) && empty($user->roles[3]))) {
        print '<div class="avis"><p>Only members are able to post public commments. To make the most of all of HBW\'s features, discover our subscriptions now!<div class="btn-container"><a title="Compare subscriptions" class="btn" href="/pricing">HBW Alive Plans & Pricing</a>&nbsp;&nbsp;' . l('Why subscribe','subscriptions', array('attributes' => array('title' => t('Why subscribe ?'),'class' => 'btn'))) .'<div class="sign-in">or <a title="Sign in now if you already have a membership" href="/user">sign in</a> if you already have a membership</div></div></div>';
      }
      else {*/ ?>
        <div class="comment-form-wrapper">
          <h2 class="title comment-form"><?php print t('Add new comment'); ?></h2>
          <?php print render($content['comment_form']); ?>
        </div>
      <?php //} ?>
  <?php endif; ?>
  <?php //} ?>
</div>
