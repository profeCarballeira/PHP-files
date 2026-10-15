<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select a Football Team</title>
</head>
<body>

    <h1>Select a Football Team</h1>

    <!-- Form that sends data via GET to the PHP script -->
    <form action="14-DataTeam.php" method="GET">
        <label for="team">Choose a Team:</label>
        <select id="team" name="team" required>
            
<?php
// Check if the file exists and open it
if (file_exists('./data/teams.txt')) {
    $file = fopen('./data/teams.txt', 'r');  // Use the correct file path

    // Read the file line by line
    while (($line = fgets($file)) !== false) {
        $data = explode("#", trim($line)); // Split the line by #

        // Only add the first field (team name) to the select options
        if (count($data) >= 1) {
            echo '<option value="' . $data[0] . '">' . $data[0] . '</option>';
        }
    }

    fclose($file);
} else {
    echo '<option disabled>Teams file not found</option>';
}
?>
        </select>
        <button type="submit">Search</button>
    </form>

</body>
</html>
