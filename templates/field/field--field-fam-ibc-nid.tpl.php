<?php

/**
 * @file field.tpl.php
 * Default template implementation to display the value of a field.
 *
 * This file is not used and is here as a starting point for customization only.
 * @see theme_field()
 *
 * Available variables:
 * - $items: An array of field values. Use render() to output them.
 * - $label: The item label.
 * - $label_hidden: Whether the label display is set to 'hidden'.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - field: The current template type, i.e., "theming hook".
 *   - field-name-[field_name]: The current field name. For example, if the
 *     field name is "field_description" it would result in
 *     "field-name-field-description".
 *   - field-type-[field_type]: The current field type. For example, if the
 *     field type is "text" it would result in "field-type-text".
 *   - field-label-[label_display]: The current label position. For example, if
 *     the label position is "above" it would result in "field-label-above".
 *
 * Other variables:
 * - $element['#object']: The entity to which the field is attached.
 * - $element['#view_mode']: View mode, e.g. 'full', 'teaser'...
 * - $element['#field_name']: The field name.
 * - $element['#field_type']: The field type.
 * - $element['#field_language']: The field language.
 * - $element['#field_translatable']: Whether the field is translatable or not.
 * - $element['#label_display']: Position of label display, inline, above, or
 *   hidden.
 * - $field_name_css: The css-compatible field name.
 * - $field_type_css: The css-compatible field type.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess_field()
 * @see theme_field()
 */
?>

<?php
  // ocultem el camp original (nid ibc)
  //print render($item);
  //...i fem servir el template només per engantxar-hi el comments thread
  //print render($content['comments']);
  if (arg(0) == 'node' && is_numeric(arg(1)) && $node = menu_get_object('node')) {
    $node = menu_get_object();
    $rendered = render(comment_node_page_additions($node));
    if($node->comment_count == '0') {
      print '<p>No comments yet</p>';
    }
    /*else {
      print '<p>' . $node->comment_count . ' comments so far.</p>';
    }*/
    print $rendered;
    
    global $user;
    if (empty($user->roles[5]) && empty($user->roles[6]) && empty($user->roles[7]) && empty($user->roles[4]) && empty($user->roles[3])) {
      print '<div class="avis"><p>Only members are able to post public commments. To make the most of all of HBW\'s features, discover our subscriptions now!<div class="btn-container"><a title="Compare subscriptions" class="btn" href="/pricing">HBW Alive Plans & Pricing</a>&nbsp;&nbsp;' . l('Why subscribe','subscription-plans', array('attributes' => array('title' => t('Why subscribe ?'),'class' => 'btn'))) .'<div class="sign-in">or <a title="Sign in now if you already have a membership" href="/user">sign in</a> if you already have a membership</div></div></div>';
    }
  
  }
  
  /*$collapsed_content = render($content['comments']);
  print theme('ctools_collapsible', array('handle' => 'Click here to view/add comments', 'content' => $collapsed_content, 'collapsed' => TRUE));*/
  ?>
