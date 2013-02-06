<ul><li>

<?php
  $count = db_query("
    SELECT count(distinct(nid)) FROM {node} node
    LEFT JOIN {field_data_field_sp_family_nr} field_data_field_sp_family_nr ON node.nid = field_data_field_sp_family_nr.entity_id AND (field_data_field_sp_family_nr.entity_type = 'node' AND field_data_field_sp_family_nr.deleted = '0')
    LEFT JOIN {field_data_field_sp_status} field_data_field_sp_status ON node.nid = field_data_field_sp_status.entity_id
    WHERE node.status = '1' AND field_data_field_sp_family_nr.field_sp_family_nr_nid = '".arg(1)."' AND field_data_field_sp_status.field_sp_status_value IN  ('CR','EN','NT','VU') AND node.type IN ('species')")->fetchField();
    print $count . ' species threatened;';
    
?>

<?php
  foreach ($items as $delta => $item) : ?>
  <div style="display:inline;" class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>>
  <?php 
  print render($item);
  // Add comma if not last item
    if ($delta < (count($items) - 1)) {
      print ','; 
    }
    ?>
  </div>
<?php endforeach;
?>

</li></ul>
