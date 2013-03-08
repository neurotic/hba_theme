<?php

/**
 * Este template existe porque se ha activado un Layout para el view-mode "mini-teaser" del tipo de contenido "species"
 * mediante el módulo Display Suite, desde http://alive.hbw.com/admin/structure/types/manage/my-record/display
 * El layout es "One column". El view-mode "mini-teaser" también se ha creado mediante el módulo Display Suite.
 * No se podria colocar el código directamente node--species.tpl.php con algo tipo "<?php if ($mini-teaser): ?>"
 * 
 * El view-mode mini-teaser se usa en el full node display de los tipos de contenido "Checklist" y "My record", 
 * para visualizar algunos datos de la especie relacionada a cada "my record".
 */
?>

<div id="mini-teaser">

<div class="left">
  <div<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></div>
  <?php
    //trim the text with http://api.drupalize.me/api/drupal/function/views_trim_text/7
    $alter_taxo_c = array('max_length' => 225, 'word_boundary' => TRUE, 'ellipsis' => TRUE, 'html' => TRUE);
    print '<div class="ds-taxonomy"><span class="name_desc">' . render($content['field_sp_name_desc'][0]) . '</span> <span class="descriptor">' . render($content['field_sp_descriptor'][0]) . ',</span> <span class="year">' . render($content['field_sp_year'][0]) . ',</span> <span class="type_locality">' . render($content['field_sp_type_locality'][0]) . '.</span>';
    //print '<div class="taxo_comments">' . views_trim_text($alter_taxo_c, render($content['field_sp_taxo_comments'][0])) . '</div>';
    print '</div>';

    /*$alter_dn = array('max_length' => 225, 'word_boundary' => TRUE, 'ellipsis' => TRUE, 'html' => TRUE);
    print '<strong>Descriptive notes:</strong> ' . views_trim_text($alter_dn, render($content['field_sp_descr_notes'][0]));
    
    print '<div class="more"><a href="' . $node_url . '" title="' . $title . '">read more</a></div>';*/
  ?>
</div>

<div class="right">
<?
print '<div class="thumbnail">' . views_embed_view('species_figure','block_5', $node->nid) . '</div>';
//print '<img class="sp-map" alt="distribution map" src="' . render($content['field_sp_map_jpg'][0]) . '" />';
?>
</div>

</div>
