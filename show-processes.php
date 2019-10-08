<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $key=$_POST["key"];
        $case=$_POST["case"];

        // Check if command is case sensitive
        if($case === "case-sensitive"){      
            $command = "ps | grep '$key' ";
            $output = shell_exec($command);
        } elseif($case === "ignore-case"){      
            $command = "ps | grep -i '$key' ";
            $output = shell_exec($command);
        } else {
            $output="Error: Problem with choosing case sensitivity";
        }

        echo nl2br($output);
    } else {
        echo "You cant access this webpage seperatly";
    }
?>