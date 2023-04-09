<?php

    include('./config/db_connect.php');
    $sql = "SELECT name,username,email FROM users";
    $result = mysqli_query($conn, $sql);
    // echo($result);
    // $printable = mysqli_fetch_array($result);

    // fetch the resulting rows as an array
    $printable = mysqli_fetch_all($result,MYSQLI_ASSOC);

    // free result from memory
    mysqli_free_result($result);

    // close connection
    // mysqli_close($conn);
    
    // print_r($printable);
    
?>

<!DOCTYPE html>
<html lang="en">
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<table>

    <?php
    foreach($printable as $user):
        ?>
        <tr>
            <td><?php echo $user["name"];?></td>
            <td><?php echo $user["username"];?></td>
            <td><?php echo $user["email"];?></td>
        </tr>
        
        <?php
    endforeach;
    
    ?>
  
    
   
  
  
</table> 
    
</body>
</html>