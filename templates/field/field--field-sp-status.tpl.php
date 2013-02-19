<?php 
  //print render($items);
        
  /*if (isset($node->field_sp_status['und'][0]['value']) && $node->field_sp_status['und'][0]['value'] === 'LC') {
      $tpl_taxo .= '<div id="status" class="ds-status">' . render($content['group_sp_tab_taxo']['field_sp_status'][0]) . '</div>';
    }
    else {$tpl_taxo .= 'no';}*/
    
  $valor = render($items);
  switch ($valor) {
     case 'EX' :
     print '<div id="status" class="ds-status EX">Extinct</div>';
     break;
     case 'EW' :
     print '<div id="status" class="ds-status EW">Extinct in the Wild</div>';
     break;
     case 'CR' :
     print '<div id="status" class="ds-status CR">Critically Endangered</div>';
     break;
     case 'EN' :
     print '<div id="status" class="ds-status EN">Endangered</div>';
     break;
     case 'VU' :
     print '<div id="status" class="ds-status VU">Vulnerable</div>';
     break;
     case 'CD' :
     print '<div id="status" class="ds-status CD">Conservation Dependent</div>';
     break;
     case 'NT' :
     print '<div id="status" class="ds-status NT">Near Threatened</div>';
     break;
     case 'LC' :
     print '<div id="status" class="ds-status LC">Least Concern</div>';
     break;
     case 'DD' :
     print '<div id="status" class="ds-status DD">Data Deficient</div>';
     break;
     case 'NE' :
     print '<div id="status" class="ds-status NE">Not Evaluated</div>';
     break;
     case 'NA' :
     print '<div id="status" class="ds-status NA">Not Assessed</div>';
     break;
     default :
     print "No status";
     break;
  }

?>
