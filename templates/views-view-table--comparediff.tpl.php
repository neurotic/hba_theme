<?php
/**
* Table view with rows/columns switched
*/

// Remove the 'cols-x' class from the table
$table_classes = explode(' ', $classes);
foreach ($table_classes as $id => $table_class) {
  if (strpos($table_class, 'cols-') === 0) {
    unset($table_classes[$id]);
  }
}
$classes = implode(' ', $table_classes);

// Get the field IDs of the column ID and heading fields
// I'm unsure what this part is for, so I comment this.
/*$col_id = '';
$col_heading = '';
foreach ($header as $id => $value) {
  if ($value == 'Column ID') {
    $col_id = $id;
  }
  elseif ($value == 'Column Heading') {
    $col_heading = $id;
  }
}*/

// Swap the x and y axis' of the table
$row = array();
foreach ($rows as $node) {
  foreach ($node as $field => $value) {
    $row[$field][] = $value;
  }
}

// Setup variable for assigning odd/even classes
$zebra = 'odd';
?>

<table<?php if ($classes) print ' class="' . $classes . '"'; ?><?php print ' ' . $attributes; ?>>
  <?php if (!empty($title)): ?>
    <caption><?php print $title; ?></caption>
  <?php endif; ?>

  <?php if (!empty($row['col_heading'])): ?>
    <thead>
      <tr>
        <th></th>
        <?php foreach ($row['col_heading'] as $id => $heading): ?>
          <th class="<?php print $id; ?>">
            <?php print $heading; ?>
          </th>
        <?php endforeach; ?>
      </tr>
    </thead>
  <?php endif; ?>

  <tbody>
    <?php foreach ($row as $field => $values): ?>
      <?php if ($field != 'col_heading'): ?>
        <tr class="<?php print $field; ?> <?php print $zebra; ?>">
          <th><?php print $header[$field]; ?></th>
          <?php foreach ($values as $id => $value): ?>
            <td class="col <?php print 'col_' . $id; ?>">
            <?php /*if ($id == 2) { print "style='width: 33%;>'" }
			elseif ($id == 1) { print "style='width: 50%;>'" }
			else { print "style='width: 100%;>'" }*/ ?>
              <?php print $value; ?>
            </td>
          <?php endforeach; ?>
        </tr>
        <?php
          if ($zebra == 'odd') {
            $zebra = 'even';
          }
          else {
            $zebra = 'odd';
          }
        ?>
      <?php endif; ?>
    <?php endforeach; ?>
  </tbody>

</table>
