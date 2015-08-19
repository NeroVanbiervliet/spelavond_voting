<?php
// huidige directory nummer
$dirNum = 1;

// post data ophalen
$name = $_POST["name"];
$first = $_POST["first"];
$second = $_POST["second"];
$third = $_POST["third"];

// who voted data ophalen
$recoveredData = file_get_contents($dirNum . "/whovoted.data");
$whoVoted = unserialize($recoveredData);

array_push($whoVoted,$name);

// who voted data stockeren
$serializedData = serialize($whoVoted); 
file_put_contents($dirNum . "/whovoted.data", $serializedData);

// votes data ophalen
$recoveredData = file_get_contents($dirNum . "/votes.data");
$votes = unserialize($recoveredData);

// zoeken of game al in de votes zit
$firstDone = false;
$secondDone = false;
$thirdDone = false;
for($i = 0; $i < count($votes); $i++)
{
	$vote = &$votes[$i];	
	if($vote[1] == $first)
	{
		$vote[0] += 6;
		$firstDone = true;
	}
	if($vote[1] == $second)
	{
		$vote[0] += 3;
		$secondDone = true;
	}
	if($vote[1] == $third)
	{
		$vote[0] += 1;
		$thirdDone = true;
	}
}

if(! $firstDone)
{
	array_push($votes,array(6,$first));
}
if(! $secondDone)
{
	array_push($votes,array(3,$second));
}
if(! $thirdDone)
{
	array_push($votes,array(1,$third));
}	

// votes data schrijven naar file
$serializedData = serialize($votes); 
file_put_contents($dirNum . "/votes.data", $serializedData);

echo("je hebt gestemd!<br>");
echo("Klik <a href=\"/spelavond_voting\">hier</a> om terug te keren naar het overzicht");

?>
