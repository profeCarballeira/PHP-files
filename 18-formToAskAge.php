<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select a Name</title>
</head>
<body>

    <h1>Select a Name</h1>

    <!-- Form that sends data via GET to the PHP script -->
    <form action="17-GetAgeOfName.php" method="GET">
        <label for="name">Choose a Name:</label>
        <select id="name" name="name" required>
            
<?php
// Check if the file exists and open it
if (file_exists('./data/nameAge.txt')) {
    $file = fopen('./data/nameAge.txt', 'r');  // Use the correct file path

    // Read the file line by line
    while (($line = fgets($file)) !== false) {
        $data = explode("#", trim($line)); // Split the line by #

        // Only add the first field (person name) to the select options
        if (count($data) >= 1) {
            echo '<option value="' . $data[0] . '">' . $data[0] . '</option>';
        }
    }

    fclose($file);
} else {
    echo '<option disabled>Names file not found</option>';
}
?>
        </select>
        <button type="submit">Search</button>
    </form>

</body>
</html>
