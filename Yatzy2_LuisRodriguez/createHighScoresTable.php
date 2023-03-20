<!DOCTYPE html>

<!--
    Yatzy 2.0 - 
    Author: Luis Rodriguez 
	Student ID: 0812903 
	Date: 2022 07 21
	
   --> 


<html>
    <head>
        <title>
            Create Yatzy High Scores table
        </title>
    </head>
    <body>
        <?php
        require_once('connectvars.php');
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        $query =   " CREATE TABLE high_scores (
            Id INT AUTO_INCREMENT,
            date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            name VARCHAR(32),
            score INT,
            screenshot VARCHAR(64),
            PRIMARY KEY (Id),
            KEY name (name)
            )";
            
            
            
            if (mysqli_query ($dbc, $query)) {
                echo "<h3 class='success'>The query was successfully executed!</h3>";
            } else {
                echo "The query, CREATE TABLE email_list, could not be executed! " . mysqli_error($dbc);
            } 
            mysqli_close($dbc);

        ?>
    </body>
</html>
