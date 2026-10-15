<!DOCTYPE html>
<html>
<body>

<?php
    $myfile = fopen("data/nameAge.txt", "r") or die("Unable to open file!");
    // Output one line until end-of-file
    while(!feof($myfile)) {
        // Get the current line and remove hidden newline characters
        $line = trim(fgets($myfile));
        
        // Split the string into an array using '#' as the delimiter
        $parts = explode("#", $line);
        
        // $parts[0] contains the name and $parts[1] contains the age
        $name = $parts[0];
        $age = $parts[1];
        
        // Output the formatted result
        echo "The age of " . $name . " is " . $age . ".<br>";
    }
    fclose($myfile);
?>

</body>
</html>