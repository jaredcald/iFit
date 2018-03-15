

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

function getUserName($connection)
{
    $query = "SELECT * FROM END_USER";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_row($result);
    return $row[1] ." ". $row[2];
    
}

function getUserID($connection)
{
    $query = "SELECT * FROM END_USER";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_row($result);
    return $row[0];
    
}

function saveToDB($connection, $userID, $workoutName, $completedExercises)
{
 
    //echo "entering saveToDB method <br />";

    //echo $workoutName . " " . $userID . "<br />";

    if (!($stmt = $connection->prepare("INSERT INTO workout(userID, workoutName) VALUES (?, ?)"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error. "<br />";
    }
   

     $id = 1;
    if (!$stmt->bind_param("ss", $userID, $workoutName)) 
    {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error. "<br />";
    }

    if (!$stmt->execute())
    {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error. "<br />";
    }
     else
    {
        echo "Workout saved as: <br /><br />";
        echo $workoutName . "<br /><br />";
    }

    $stmt->close();
    //echo "hello <br />";
    
    //populateTable($connection, $userID);
    $query = "SELECT workoutID FROM WORKOUT WHERE workoutName LIKE '$workoutName'";
    if(!$result = mysqli_query($connection, $query))
    {
        echo "You broke it! <br />";
    }
    
    $row = mysqli_fetch_row($result);
    $workoutID = $row[0];
    //echo "workout id: " . $workoutID . "<br />";

    populateWorkoutExercises($connection, $workoutID, $completedExercises);
       

}

function populateWorkoutExercises($connection, $workoutID, $completedExercises)
{
    foreach($completedExercises as $exerciseID)
    {
         //prepare
         if (!($stmt = $connection->prepare("INSERT INTO workout_exercise(workoutID, exerciseID) VALUES (?, ?)"))) 
         {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error. "<br />";
         }
     

        //bind
        if (!$stmt->bind_param("is", $workoutID, $exerciseID)) 
        {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error. "<br />";
        }
    

        //execute
        if (!$stmt->execute())
        {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error. "<br />";
        }
        else{
            echo "added row to WORKOUT_EXERCISE table:";
            echo $workoutID . " " . $exerciseID . "<br />";
        }
  

        $stmt->close();
        }
}


//MAIN
date_default_timezone_set('America/New_York');

$connection = connectToDB();

$difficultyID = $_POST['difficulty'];
$exercise1 = $_POST['exercise1'];
$exercise2 = $_POST['exercise2'];
$exercise3 = $_POST['exercise3'];
$exercise4 = $_POST['exercise4'];
$exercise5 = $_POST['exercise5'];
$exercise6 = $_POST['exercise6'];
$completedExercises = [$exercise1, $exercise2, $exercise3, $exercise4, $exercise5, $exercise6];

//var_dump($completedExercises);

$query = "SELECT difficultyName FROM DIFFICULTY WHERE difficultyID like '$difficultyID';";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_row($result);
$difficultyName = $row[0];
$userName = getUserName($connection);
$userID = getUserID($connection);

$dateTime = date("l") . ", " . date("Y-m-d") . ", "  . date("h:i:sa");

$workoutName = $userName ." :: ". $difficultyName ." :: ". $dateTime;

saveToDB($connection, $userID, $workoutName, $completedExercises);
?>
<br /><br />
<a href="index.php">Create another workout</a>
<form action = 'history.php' method = 'post' id = 'completeWorkout'>
        <input type="hidden" name= 'userID' value='<?php echo $userID; ?>'>
        <input type ="submit" name ="submit" value = "Show workout history" />
</form>