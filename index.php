<html>
<head>
    
<title>PHP Test</title>

</head>
<body>

<?php 



function connectToDB()
{
//connect to the local database
    $user = 'root';
    $pass = '';
    $db = 'ifitness';

    $connection = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

    return $connection;

}

function queryDB($connection, $difficultyID)
{
//retrieve all exercises of the selected difficulty

    $query = "SELECT difficultyName FROM DIFFICULTY WHERE difficultyID like '$difficultyID';";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_row($result);
    
    echo "Random $row[0] Workout\n\r\n\r";

    //retrieve all workouts of the selected difficulty
    //$workoutIDArray = getWorkouts($connection, $difficultyID);

    //retrieve all workouts of the selected difficulty
    $exerciseIDArray = getExercises($connection, $difficultyID);
    //var_dump($exerciseIDArray);

    $associativeExercises = getExerciseInfo($connection, $exerciseIDArray);

    return $associativeExercises;

}

function displayExercises($exerciseInfo)
{
//display 4 random exercises of the selected difficulty 

   
    
    ?>
    <table>
        <th>ID</th>
        <th>Name</th>
        <th>Sets</th>
        <th>Reps</th>
        
        <?php $completedExercises = fillTable($exerciseInfo); ?>
    </table>
    <?php
    
        return $completedExercises;
}

function fillTable($exerciseInfo)
{
    
    $completedExercises = [];

     //get the number of exercises of selected difficulty 
    $numExercises = sizeof($exerciseInfo);
    
    $randomIndex = rand(0, $numExercises-1);

    //number of random exercises that will be displayed in the table
    $numExercises = 6;

    //array that will store indexes of already-displayed exercises to prevent duplicates
    $usedIndexes = [];

    for($i = 0; $i < $numExercises; $i++)
    {
        
        $found = checkUsed($usedIndexes, $randomIndex);
        

        if($found)
        {
            do
            {
                $randomIndex = rand(0, $numExercises-1);
                $found = checkUsed($usedIndexes, $randomIndex);
            }
            while($found);
        }
        ?>
        
        <tr>
            <td><?php echo $exerciseInfo[$randomIndex]['ID'];?></td>
            <td><?php echo $exerciseInfo[$randomIndex]['Name'];?></td>
            <td><?php echo $exerciseInfo[$randomIndex]['Sets'];?></td>
            <td><?php echo $exerciseInfo[$randomIndex]['Reps'];?></td>
            
        </tr>

        <?php
            array_push($usedIndexes, $randomIndex);
            array_push($completedExercises, $exerciseInfo[$randomIndex]['ID']);
    }
    return $completedExercises;
}

function checkCompleted()
{
    ?>

    <script>
    </script>

    <?php
}

function checkUsed($usedIndexes, $randomIndex)
{
    $found = false;
    foreach($usedIndexes as $index)
    {
        if($index == $randomIndex)
        {
            $found = true;
        }
    }
    return $found;
}

function getExerciseInfo($connection, $exerciseIDArray)
{
    $associativeExercises = [];

    foreach ($exerciseIDArray as $id)
    {
        $query = "SELECT * FROM EXERCISE where exerciseID LIKE '$id'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_row($result);

        
        $associativeExercises[] = array('ID' => $row[0], 'Name' => $row[1], 'Sets' => $row[3], 'Reps' => $row[4]);
    }

    return $associativeExercises;

}

function getExercises($connection, $difficultyID)
{
    $exerciseIDArray = [];
    $query = "SELECT exerciseID FROM EXERCISE WHERE difficultyID LIKE '$difficultyID'";
    $result = mysqli_query($connection, $query);
    $numRows = mysqli_num_rows($result);
 
        //$query = "SELECT exerciseID FROM WORKOUT_EXERCISE WHERE workoutID LIKE '$id'";
        //$result = mysqli_query($connection, $query);
        

    for($i = 0; $i < $numRows; $i++)
	{
		$row = mysqli_fetch_row($result);
        array_push($exerciseIDArray, $row[0]);
    }
    

    return $exerciseIDArray;

}

function getWorkouts($connection,$difficultyID)
{
//retrieve all workouts of the selected difficulty

    $query = "SELECT workoutID FROM WORKOUT WHERE difficultyID LIKE '$difficultyID';";

    $result = mysqli_query($connection, $query);

	$numRows = mysqli_num_rows($result);

    $workoutIDArray = [];

    for($i = 0; $i < $numRows; $i++)
	{
		$row = mysqli_fetch_row($result);
        array_push($workoutIDArray, $row[0]);
    }

    return $workoutIDArray;

}

function checkFormAction()
{
	if(isset($_POST['submit']))
	{return true;}
	else
	{return false;}	
}

function showDifficulties($connection)
{
//show dropdown for selecting a difficulty

    $query = "SELECT * FROM DIFFICULTY;";
	$result = mysqli_query($connection, $query);

	$numRows = mysqli_num_rows($result);

    ?>
	<select name='difficulty' id='difficulty'>
    <option disabled selected value> -- select a difficulty -- </option>
		
	<?php
	for($i = 0; $i < $numRows; $i++)
	{
		$row = mysqli_fetch_row($result);
		echo "<option value=$row[0]>$row[1]</option>";
	}
	?>
	</select>
	<?php
}
?>



<?php
function showForm($connection)
{
//display HTML form for submitting Workout preferences 
    ?>

    <form action = 'index.php' method = 'post' id = 'workoutPrefs'>
		<?php showDifficulties($connection); ?>
		<input type ="submit" name ="submit" value = "Go!" />
    </form>

    <?php
}

function completeWorkout($difficultyID, $connection, $completedExercises)
{
    $exercise1 = $completedExercises[0];
    $exercise2 = $completedExercises[1];
    $exercise3 = $completedExercises[2];
    $exercise4 = $completedExercises[3];
    $exercise5 = $completedExercises[4];
    $exercise6 = $completedExercises[5];
    ?>
    <form action = 'complete.php' method = 'post' id = 'completeWorkout'>
        <input type="hidden" name= 'difficulty' value='<?php echo $difficultyID; ?>'>
        <input type="hidden" name= 'exercise1' value='<?php echo $exercise1; ?>'>
        <input type="hidden" name= 'exercise2' value='<?php echo $exercise2; ?>'>
        <input type="hidden" name= 'exercise3' value='<?php echo $exercise3; ?>'>
        <input type="hidden" name= 'exercise4' value='<?php echo $exercise4; ?>'>
        <input type="hidden" name= 'exercise5' value='<?php echo $exercise5; ?>'>
        <input type="hidden" name= 'exercise6' value='<?php echo $exercise6; ?>'>
        <input type="submit" name ="complete" value="Complete Workout" />
    </form>
    <?php
}

//END FUNCTION DECLARATION



//BEGIN MAIN 

$connection = connectToDB();

$action = checkFormAction();

if($action)
{
    //show the form the user will fill out
    showForm($connection);
    
    //check to see if a difficulty has been selected
    if(isset($_POST['difficulty']))
    {
        //store ID of selected difficulty in the $difficulty variable
        $difficultyID = $_POST['difficulty'];
        $exerciseInfo = queryDB($connection, $difficultyID);
        $completedExercises = displayExercises($exerciseInfo);
        completeWorkout($difficultyID, $connection, $completedExercises);
    }
    
    
    
}
else
{
    //show the form the user will fill out
    showForm($connection);
}


 ?>
</body>
</html>