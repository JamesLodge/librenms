<?php

if($_GET['id']) { $interface = $_GET['id'];
} elseif($_GET['port']) { $interface = $_GET['port'];
} elseif($_GET['if']) { $interface = $_GET['if'];
} elseif($_GET['interface']) { $interface = $_GET['interface']; }

$query = mysql_query("SELECT * FROM `ports` AS I, `devices` AS D WHERE I.interface_id = '".$interface."'
                      AND I.device_id = D.device_id");

$port = mysql_fetch_array($query);
#if(is_file($config['rrd_dir'] . "/" . $port['hostname'] . "/" . safename($port['ifIndex'] . ".rrd"))) {
  $rrd_filename = $config['rrd_dir'] . "/" . $port['hostname'] . "/port-" . safename($port['ifIndex'] . "-adsl.rrd");
#}

$rrd_list[0]['filename'] = $rrd_filename;
$rrd_list[0]['descr'] = "Downstream";
$rrd_list[0]['rra'] = "AtucCurrSnrMgn";

$rrd_list[1]['filename'] = $rrd_filename;
$rrd_list[1]['descr'] = "Upstream";
$rrd_list[1]['rra'] = "AturCurrSnrMgn";

$unit_text = "dB";

$units='';
$total_units='';
$colours='mixed';

$scale_min = "0";

$nototal = 1;

if ($rrd_list) {
  include ("generic_multi_line.inc.php");
}

?>