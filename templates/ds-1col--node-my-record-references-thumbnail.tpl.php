<?php

/**
 * Este template existe porque se ha activado el view mode "Reference thumbnail" para my-record
 * mediante el módulo Display Suite, desde http://alive.hbw.com/admin/structure/types/manage/my-record/display
 * El layout es "One column".
 * Desactiva la parte del template para teaser del archivo node--my-record.tpl.php
 * Sirve para mostrar teasers de my-record en el camp Entity Reference "My records (species you observed)" del formulario de My record
 */

?>

<div class="node-inner teaser">
  <article<?php print $attributes; ?>>
  <div<?php print $content_attributes; ?>>
  
    <?php hide($content['links']); ?>
    
    <div class="left">
      <?php
        print render($content['field_myr_sp'][0]);
      ?>
    </div>
    
    <div class="right">
      <div class="field_myr_nb"><?php print render($content['field_myr_nb'][0]); ?></div>
      <?php
        if (isset($node->field_myr_heard['und'][0]['value']) && $node->field_myr_heard['und'][0]['value'] === '1') {
          print '<div class="field_myr_heard">Heard only</div>';
        }
      ?>
      <?php
        if (isset($node->field_myr_captive['und'][0]['value']) && $node->field_myr_captive['und'][0]['value'] === '1') {
          print '<div class="field_myr_captive">Captive</div>';
        }
      ?>
      <div class="field_myr_date">
        <?php print render($content['field_myr_date'][0]); ?>
      </div>
    </div>
    
  </div>
  </article>
</div>
