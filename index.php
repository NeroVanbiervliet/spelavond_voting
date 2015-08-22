<html>
<body>

Spotlight: spel van de maand
<br>
<img src="monopoly_cover.jpg" width="50%" height="50%">

<br>
<br>

<?php

// huidige directory nummer
$dirNum = 1;

// usorts

function compareByNumOfVotes($a, $b) 
{
  return $b[0] - $a[0];
}

function compareAlphabetic($a, $b) 
{
  return ($a[0] > $b[0]);
}

// games index

$games = array(array("pandemie","(2-4)"),array("agricola","(2-5)"),array("niagara","(3-5)"),array("pingouin","(2-4)"),array("carcassonne","(2-5)"),array("kolonisten van catan","(3-4)"),array("caylus","(2-5)"),array("ticket to ride","(2-5)"),array("union pacific","(2-6)"),array("adel verpflichtet","(2-6)"),array("monopoly","()"),array("scotland yard","(3-6)"),array("hoogspanning","(2-6)"),array("maharadja","(3-5)"),array("dixit","(3-6)"),array("de kathedraal","(2-4)"),array("cartagena","(2-5)"),array("machiavelli","(4-8)"),array("7 wonders","(2-7)"),array("terra mystica","(2-5)"),array("medina","(3-4)"),array("alhambra","(2-6)"),array("cafe international","(2-4)"),array("trans america","(2-6)"),array("elfenland","(2-6)"),array("el grande","(2-5)"),array("fresco","(2-4)"),array("java","(2-4)"),array("tikal","(2-4)"),array("mexica","(2-4)"));

// alfabetisch sorteren
usort($games, "compareAlphabetic");

// option generator function WERKT NIET
function getGameOptions()
{
	$options = "";
	foreach($games as $game)
	{
		$newOption = "<option value=\"" . $game[0] . "\">" . $game[0] . " " . $game[1] . "</option>";		
		$options .= $newOption;
	}
	
	return $options;
}


// who voted data ophalen
$recoveredData = file_get_contents($dirNum . "/whovoted.data");
$whoVoted = unserialize($recoveredData);

// display who voted
echo("Deze personen hebben al gestemd: <br>");
$whoVotedString = "";
foreach($whoVoted as $person)
{	
	$whoVotedString .= $person;
	$whoVotedString .= ", ";
}	
echo($whoVotedString . "<br><br>");

// form tonen om te stemmen
echo("<form action=\"submit_vote.php\" method=\"post\">");

	// naam 
	echo("naam");
	echo("<input type=\"text\" name=\"name\"><br>");	

	// select voor eerste keuze
	echo("eerste keuze (6 punten)");
	echo("<select name=\"first\">");
		// hier moet eigenlijk de functie aangeroepen worden, maar dat werkt op een of andere manier niet GRRR
		$options = "";
		foreach($games as $game)
		{
			$newOption = "<option value=\"" . $game[0] . "\">" . $game[0] . " " . $game[1] . "</option>";		
			$options .= $newOption;
		}
		echo($options);
	echo("</select><br>"); 

	// select voor eerste keuze
	echo("tweede keuze (3 punten)");
	echo("<select name=\"second\">");
		// hier moet eigenlijk de functie aangeroepen worden, maar dat werkt op een of andere manier niet GRRR
		$options = "";
		foreach($games as $game)
		{
			$newOption = "<option value=\"" . $game[0] . "\">" . $game[0] . " " . $game[1] . "</option>";		
			$options .= $newOption;
		}
		echo($options);
	echo("</select><br>"); 

	// select voor eerste keuze
	echo("derde keuze (1 punt)");
	echo("<select name=\"third\">");
		// hier moet eigenlijk de functie aangeroepen worden, maar dat werkt op een of andere manier niet GRRR
		$options = "";
		foreach($games as $game)
		{
			$newOption = "<option value=\"" . $game[0] . "\">" . $game[0] . " " . $game[1] . "</option>";		
			$options .= $newOption;
		}
		echo($options);
	echo("</select><br>"); 

	// submit button
	echo("<input type=\"submit\" value=\"stem\">");

echo("</form>");

// votes data van vorige ronde ophalen
$recoveredData = file_get_contents($dirNum . "/votesPrevRound.data");
$votes = unserialize($recoveredData);

// sorteren volgens number of 
usort($votes, "compareByNumOfVotes");

// info over votes berekenen
$numOfGames = count($votes);

echo("<table>");

for($i = 0; $i < $numOfGames; $i++)
{
	echo("<tr>");
	$gameName = $votes[$i][1];
	echo("<td>" . $gameName . "</td>");
	$numVotes = $votes[$i][0];
	for($j = 0; $j < $numVotes + 1; $j++)
	{
		echo("<td bgcolor=\"#C0C0C0\" width=\"15\"></td>");
	}
	echo("<td>" . $numVotes . "</td>");
	echo("</tr>");
}

echo("</table>");
?>

</body>
</html>
