<?php
$query = $_POST['query'];

$mysqli = mysqli_connect("localhost", "1926434", "6ab25p", "db1926434");
$sql =  mysqli_query($mysqli, "SELECT Title FROM Comments WHERE Title LIKE '%$query%'");

    if($sql-> num_rows>0){
        while ($row = mysqli_fetch_assoc($sql)) {
            echo "<a class='list-group-item list-group-item-action'>".$row['Title']."</a>";
        }

    } else {
        echo "<p class='list-group-item border-1'> No Reviews with that title</p>";
    }


?>