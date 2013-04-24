<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
?>
<?php
  switch ($output) {
     case 'EX' :
     print '<div id="status" class="ds-status EX"></div>';
     break;
     case 'EW' :
     print '<div id="status" class="ds-status EW"></div>';
     break;
     case 'CR' :
     print '<div id="status" class="ds-status CR"></div>';
     break;
     case 'EN' :
     print '<div id="status" class="ds-status EN"></div>';
     break;
     case 'VU' :
     print '<div id="status" class="ds-status VU"></div>';
     break;
     case 'CD' :
     print '<div id="status" class="ds-status CD"></div>';
     break;
     case 'NT' :
     print '<div id="status" class="ds-status NT"></div>';
     break;
     case 'LC' :
     print '<div id="status" class="ds-status LC"></div>';
     break;
     case 'DD' :
     print '<div id="status" class="ds-status DD"></div>';
     break;
     case 'NE' :
     print '<div id="status" class="ds-status NE"></div>';
     break;
     case 'NA' :
     print '<div id="status" class="ds-status NA"></div>';
     break;
     default :
     print "";
     break;
  }
?>
