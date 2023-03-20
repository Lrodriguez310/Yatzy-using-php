<!DOCTYPE html>




<!--
    Yatzy 2.0 - 
    Author: Luis Rodriguez 
	Student ID: 0812903 
	Date: 2022 07 21
	
   --> 


<html>
<head><title>Yatzy Tables</title>
<link type="text/css" rel="stylesheet" href="style_table.css" />
</head>
<body>
    <div id="head"></div>
<p><a href="yatzyIndex.php">To Index</a></p>
</div>
<div id="content">
<h2>Yatzy TABLE</h2>
<p> program made by Luis Rodriguez </p>
<?php
require_once('connectvars.php');
$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$query="SELECT * FROM high_scores";
$result=mysqli_query($dbc,$query) or die ("Error querying database".mysqli_error($dbc));
    echo "<h2>High Score Table</h2>";
	echo "<table>";
	echo "<tr>";
	echo "<th>ID*</th>";
	echo "<th>DATE</th>";	
	echo "<th>NAME</th>";
    echo "<th>SCORE</th>";
    echo "<th>SCREENSHOT</th>";
    echo "<th>Approved</th>";	
	echo "</tr>";

    while ($Row = mysqli_fetch_array ($result, MYSQLI_ASSOC)) {
		echo "<tr>";
		echo "<td>$Row[Id]</td>";
		echo "<td>$Row[date]</td>";
		echo "<td>$Row[name]</td>";
        echo "<td>$Row[score]</td>";
        echo "<td>$Row[screenshot]</td>";
        echo "<td>N/A</td>";
		echo "</tr>";
	}
	echo "</table>";
 echo "</div>";
mysqli_close ($dbc);
?>
<div id="footer">
    <p>End of TABLES</p>
</div>
</body>
</html>