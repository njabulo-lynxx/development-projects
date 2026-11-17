<?php 

   if(isset(($_POST['total_distance']))) $total_distance = htmlentities($_POST["total_distance"]);
   if(isset(($_POST['completed_distance']))) $completed_distance = htmlentities($_POST["completed_distance"]);
   if(isset(($_POST['event_duration']))) $event_duration = htmlentities($_POST["event_duration"]);
   if(isset(($_POST['time_passed']))) $time_passed = htmlentities($_POST["time_passed"]);

   //Format number to 2 decimal place
   function formatToDecimal($number){
      $number = number_format($number, 2);
      return $number;
   }

   //Remaining distance formula:
   //Remaining Distance = Total Distance - Completed Distance
   function calculateRemainingDistance($totalDist, $completedDist){
       return $totalDist - $completedDist;
   }

   //The remaining time formula: 
   //Remaining Time = Total Event Duration - Time Elapsed
   function calculateRemainingTime($totalTime, $passedTime){
       return $totalTime - $passedTime;
   }

   //The required speed Formula:    
   //Required Speed = Remaining Distance ÷ Remaining Time
   function calculateRequiredSpeed($remainingDist, $remainingTime){

       if($remainingTime <= 0){
          $remainingTime = 1;
       }
        return $remainingDist / $remainingTime;
   }

    $remaining_distance = calculateRemainingDistance($_POST['total_distance'], $_POST['completed_distance']);
    $remaining_time = calculateRemainingTime($_POST['event_duration'], $_POST['time_passed']);
    $required_speed = calculateRequiredSpeed($remaining_distance, $remaining_time);

    //Format to 2 decimal place
    $required_speed = formatToDecimal($required_speed);

    //Update file
    function updateTextFile($file_path, $new_content){

    // Append the new content to the file
    file_put_contents($file_path, $new_content, FILE_APPEND);

    echo "<br>file updated successfully!";
}

        if (isset($_POST['myButton'])) {
        // The submit button named 'myButton' was pressed.
        // Process form data here.
        updateTextFile("marathonRecords.txt", "****************************************
The remaining distance is : " . $remaining_distance . " km.
The remaining time is : " . $remaining_time . " hrs left.
The required speed to completed the marathon on time is : " . $required_speed . " km/hr.
****************************************\n");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<header>
        <h1>Marathon</h1>
    </header>
<body>
    <form action="index.php" method="post"><pre>
            Total Marathon Distance (max 50km): <input type="number" name="total_distance" value="0">
            Completed Distance (in km):         <input type="number" name="completed_distance" value="0">
            Duration of the Marathon (in hrs):  <input type="number" name="event_duration" value="0">
            Time passed (in hrs):               <input type="number" name="time_passed" value="0">
                                                <input type="submit" name="myButton">
        </pre>
        </form>
</body>
</html>