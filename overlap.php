<?php
$start=$_POST['start'];
$end=$_POST['end'];

$sql = <<<SQL
    SELECT *
    FROM `events`
    WHERE `eventID` = 0 
SQL;


$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
// Check connection
if (mysqli_connect_errno($connection)) {
    echo "<div>";
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    echo "</div>";
} 


if($result = mysqli_query($connection, "select * from events")){
 
    if($result->num_rows){
        
        while($row = $result->fetch_object()){
            $end2 = $row->endDateTime;
            $start2 = $row->startDateTime;
            if($start <= $end2 && $end >= $start2){
                echo $row->title,' is overlap';
            }
        }
    } 

}

mysqli_close($connection); // Closing Connection
?>