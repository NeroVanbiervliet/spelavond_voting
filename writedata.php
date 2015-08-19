<?php

$whovoted = array();

$serializedData = serialize($whovoted); 
file_put_contents('1/whovoted.data', $serializedData);

$votes = serialize(array());
file_put_contents('1/votes.data', $votes);
?>
