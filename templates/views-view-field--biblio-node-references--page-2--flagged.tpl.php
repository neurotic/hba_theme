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
if ($output == 'No') {
  print '<span class="outstanding"><a title="Outstanding reference">&nbsp;</a></span>'; 
}
?>

<?php
  $query = db_query("SELECT node.title AS title, field_data_field_sp_biblio_new.entity_id AS id FROM {node}, {field_data_field_sp_biblio_new}
  WHERE field_sp_biblio_new_nid = '$row->nid'
  AND field_data_field_sp_biblio_new.entity_id = node.nid
  ORDER BY node.nid ASC
  LIMIT 0,1");

  $sp_nb_total = db_query("SELECT COUNT(*) FROM {node}, {field_data_field_sp_biblio_new} WHERE field_sp_biblio_new_nid = '$row->nid' AND field_data_field_sp_biblio_new.entity_id = node.nid")->fetchField();
  
  $mentioned_sp = db_query($query);
  
  $sp_shown = 1; // Nb of species that we list below the reference teaser as "Reference mentioned in: "
  $sp_nb = $sp_nb_total - $sp_shown;
  
  if($sp_nb_total > 0) {
    print '<div class="views-field-title-1">Reference mentioned in: ';

    foreach ($mentioned_sp as $record) {
      print '<a title="' . $record->title . '" href="/node/' . $record->id . '">' . $record->title . '</a>';
      if ($sp_nb > 0) {
        print ' and ' . $sp_nb . ' more species';
      }
    }
    
    print '</div>';
  }
?>
