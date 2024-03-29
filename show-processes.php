<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $key=$_POST["key"];
        $case_sensitive=$_POST["case"]; // case sensitive will be true or false
        $invert=$_POST["invert"];   // invert will be true or false

        // change string to boolean (helps when string = "false" since php sets as true with (boolean) when string not empty)
        $case_sensitive=filter_var($case_sensitive, FILTER_VALIDATE_BOOLEAN); 
        $invert=filter_var($invert, FILTER_VALIDATE_BOOLEAN);

        $command = "ps -A | grep ";    // Will always use this command
        $options ="";    // Options will be selected by User

        // Check if command is case sensitive
        if($case_sensitive){      
            $options="";
        } elseif(!$case_sensitive){      
            $options="-i ";
        } else {
            $output="Error: Problem with choosing case sensitivity";
        }

        // Check if command is invert matching or not
        if($invert){      
            $options=$options."-v ";    //concatenate options
        } elseif(!$invert){      
            $options=$options."";
        } else {
            $output="Error: Problem with choosing invert matching";
        }

        //Check if user entered *
        if($key === "*" || $key === ""){
            $command = "ps -A";    
            $output = shell_exec("ps -A"); // Show all processes
        }else{   
            $command = $command.$options.$key;  // Concatenate command
            $output = shell_exec($command); // Execute command in shell
        }
        
        //nl2br() inbuilt function in PHP and is used to insert HTML break tags in the place of all new lines in a string
        echo json_encode(array("result" => nl2br($output), "command" => $command)); 
    } else {
        echo "You cant access this webpage separately";
    }
?>