<!DOCTYPE html>
<html>
<body>

<?php
if (isset($_GET['name'])) {
    $nameRequested = $_GET['name'];
    
    // Open the file users.txt
    $file = fopen('./data/nameAge.txt', 'r');
    
    if ($file) {
        $found = false;
        
        // Read the file line by line
        while (($line = fgets($file)) !== false) {
            $data = explode("#", trim($line));
            
            // Check if the name matches the first field
            if (strcasecmp($data[0], $nameRequested) == 0) {
                echo "<h1>Name: " . $data[0] . "</h1>";
                echo "<p><strong>Age:</strong> " . (int)$data[1] . "</p>";
                $found = true;
                break;
            }
        }
        fclose($file);
        
        if (!$found) {
            echo "<p>Name not found.</p>";
        }
    } else {
        echo "<p>Unable to open the file.</p>";
    }
} else {
    echo "<p>Please provide a name via the URL (e.g., ?name=Paulo).</p>";
}
?>

</body>
</html>
