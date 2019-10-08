<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $key=$_POST["key"];
        
        $command = "ps | grep '$key' ";
        $output = shell_exec($command);

        echo nl2br($output);
    } else {
        echo "You cant access this webpage seperatly";
    }
?>