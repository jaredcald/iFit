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

function getHistory($connection, $userID)
{

    $workoutIDArray = [];
    $query = "SELECT workoutID FROM workout where userID like '$userID';";
    $result = mysqli_query($connection, $query);
    $numRows = mysqli_num_rows($result);
    if($numRows >0)
    {
        for($i = 0; $i < $numRows; $i++)
	    {
		    $row = mysqli_fetch_row($result);
            array_push($workoutIDArray, $row[0]);
        }
        //var_dump($workoutIDArray);
        showHistory($connection, $workoutIDArray);
    }
}

function showHistory($connection, $workoutIDArray)
{
    //query table to get the name of the workout and display ALL NAMES of workouts
    foreach ($workoutIDArray as $id)
    {
        $query = "SELECT workoutName from workout where workoutID like '$id';";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_row($result);
        echo $row[0] . "<br />";
    }
    
}

//main



$connection = connectToDB();

$userID = $_POST['userID'];

getHistory($connection, $userID);