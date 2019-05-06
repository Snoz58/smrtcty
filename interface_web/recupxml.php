<?php
$sourcexml = $_GET['http://www.bank.lv/vk/xml.xml?date=20130530'];

$url = "http://www.bank.lv/vk/xml.xml?date=20130530";
$xml = simplexml_load_file($url);
echo "<pre>";
print_r($xml);
echo "<pre>";
print_r($sourcexml);

?>
