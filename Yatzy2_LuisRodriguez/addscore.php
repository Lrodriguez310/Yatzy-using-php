<!DOCTYPE html>

<!--
    Yatzy 2.0 - 
    Author: Luis Rodriguez 
	Student ID: 0812903 
	Date: 2022 07 21
	
   --> 



<html>
    <head>
        <title>Yatzy - Add Your High Score</title>
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>
    <body>
        <h2>Yatzy - Add Your High Score</h2>
    <?php
// This is a self-referencing page
        
        require_once('connectvars.php');
        require_once('addvars.php');
        $TableName = "high_scores";

        if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $score=$_POST['score'];
        $screenshot = $_FILES['screenshot']['name']; // NEW CODE
        $screenshot_type = $_FILES['screenshot']['type'];
        $screenshot_size = $_FILES['screenshot']['size'];
    
        if (!empty($name) && !empty($score)&& !empty($screenshot)) {
            if((($screenshot_type=='image/gif')||($screenshot_type=='image/jpeg')||
            ($screenshot_type=='image/pjpeg') ||($screenshot_type=='image/png'))&&
            ($screenshot_size>0) && ($screenshot_size<=MAXFILESIZE)){
                if($_FILES['screenshot']['error']==0){

                
            
// Connect to the database
        $target = UPLOADPATH . $screenshot; // NEW CODE
        if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {   
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query="INSERT INTO $TableName VALUES(0,NOW(),'$name','$score','$screenshot')";
        mysqli_query($dbc, $query);


			echo '<p>Thanks for adding your new high score!</p>';
				echo '<p><strong>Name:</strong> ' . $name . '<br />';
					echo '<strong>Score:</strong> ' . $score . '<br />';
						echo '<img src="' . DISPLAYPATH . $screenshot. '" alt="Score image" /></p>';
							echo '<p><a href="yatzyIndex.php">&lt;&lt;Back to high scores</a></p>';
        // Clear the score data to clear the form
        $name="";
        $score="";
        $screenshot="";
        mysqli_close($dbc);
        } 
        else {
            echo '<p class="error">Sorry, there was a problem uploading your screen shot
            image.</p>';
        }
        }
        }
        else {
            echo '<p class="error">The Screenshot must be a GIF, JPEG, or PNG image file
             no greater than'.(MAXFILESIZE/1024).'KB in size.</p>';
        }
        @unlink($_FILES['screeshot']['tmp_name']);
        }
        else {
            echo '<p class="error">Please enter all of the information to add your
            high score.</p>';
        }
        }

        ?>
        <hr />
			<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAXFILESIZE; ?>" />
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" /><br />
            <label for="score">Score:</label>
            <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>" /><br />
            <label for="screenshot">Screen shot:</label>
            <input type="file" id="screenshot" name="screenshot" />
            <hr />
            <input type="submit" value="Add" name="submit" />
        </form>
    </body>
</html>