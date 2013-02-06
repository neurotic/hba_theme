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
  print render($item);
  
  // Size
  $min = db_query("
          SELECT field_data_field_fam_min_size.field_fam_min_size_value FROM {field_data_field_fam_min_size} field_data_field_fam_min_size
          WHERE field_data_field_fam_min_size.entity_id = '".arg(1)."' AND field_data_field_fam_min_size.bundle IN ('family')")->fetchField();
  $max = db_query("
          SELECT field_data_field_fam_max_size.field_fam_max_size_value FROM {field_data_field_fam_max_size} field_data_field_fam_max_size
          WHERE field_data_field_fam_max_size.entity_id = '".arg(1)."' AND field_data_field_fam_max_size.bundle IN ('family')")->fetchField();
  print '<ul><li>' . substr($min, 0, -3) . '-' . substr($max, 0, -3) . ' cm.</li></ul>';
  
  // Linea "xx genera, xx species, xx taxa."
          $count = db_query("
          SELECT count(distinct(field_data_field_sp_genus.field_sp_genus_value)) FROM  {node} node
          LEFT JOIN {field_data_field_sp_family_nr} field_data_field_sp_family_nr ON node.nid = field_data_field_sp_family_nr.entity_id AND (field_data_field_sp_family_nr.entity_type = 'node' AND field_data_field_sp_family_nr.deleted = '0')
          LEFT JOIN {field_data_field_sp_genus} field_data_field_sp_genus ON node.nid = field_data_field_sp_genus.entity_id
          WHERE node.status = '1' AND field_data_field_sp_family_nr.field_sp_family_nr_nid = '".arg(1)."' AND node.type IN  ('species')")->fetchField();
          print '<ul><li>';
          if ($count==1){
            echo "$count genera, ";
          }
          else {
            echo "$count genus, ";
          }
          ?>
          
          <?php
          $count = db_query("
          SELECT COUNT(DISTINCT(node.nid))
          FROM 
          {node} node
          LEFT JOIN {field_data_field_sp_family_nr} field_data_field_sp_family_nr ON node.nid = field_data_field_sp_family_nr.entity_id AND (field_data_field_sp_family_nr.entity_type = 'node' AND field_data_field_sp_family_nr.deleted = '0')
          LEFT JOIN {field_data_field_sp_ordre} field_data_field_sp_ordre ON node.nid = field_data_field_sp_ordre.entity_id AND (field_data_field_sp_ordre.entity_type = 'node' AND field_data_field_sp_ordre.deleted = '0')
          WHERE node.status = '1' AND field_data_field_sp_family_nr.field_sp_family_nr_nid = '".arg(1)."' AND node.type IN  ('species')")->fetchField();
            echo "$count species, ";
          ?>
          
          <?php
          $count = db_query("
          SELECT COUNT(*) AS nid
          FROM 
          node node
          LEFT JOIN field_data_field_ssp_species field_data_field_ssp_species ON node.nid = field_data_field_ssp_species.field_ssp_species_nid
          LEFT JOIN node field_ssp_species_node ON field_data_field_ssp_species.entity_id = field_ssp_species_node.nid
          LEFT JOIN field_data_field_sp_family_nr field_data_field_sp_family_nr ON node.nid = field_data_field_sp_family_nr.entity_id AND (field_data_field_sp_family_nr.entity_type = 'node' AND field_data_field_sp_family_nr.deleted = '0')
          WHERE ( (node.status = '1') AND (field_data_field_sp_family_nr.field_sp_family_nr_nid = '".arg(1)."' ) )AND (node.type IN  ('species'))")->fetchField();
          if ($count==1){
            echo "$count taxon.";
          }
          else {
            echo "$count taxa.";
          }
  ?>

  </li></ul>
