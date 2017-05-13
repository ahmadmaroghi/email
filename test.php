<?php
$s = '12-akjshdkasjdh';
$c = strstr($s, '-', false);
echo strstr($s, '-', true);
echo "<br />";
echo str_replace('-','',$c);
?>