<!DOCTYPE html>
<html>
<body>

<?php
if (isset($_GET['team'])) {
    $teamRequested = $_GET['team'];

    // Open the file teams.txt
    $file = fopen('./data/teams.txt', 'r');
    if ($file) {
        $found = false;

        // Read the file line by line
        while (($line = fgets($file)) !== false) {
            $data = explode("#", trim($line));

            // Check if the team name matches the first field
            if (strcasecmp($data[0], $teamRequested) == 0) {
                echo "<h1>Team: " . $data[0] . "</h1>";
                echo "<p><strong>Best Player:</strong> " . $data[1] . "</p>";
                echo "<p><strong>City:</strong> " . $data[2] . "</p>";
                echo "<p><strong>Followers:</strong> " . (int)$data[3] . "</p>";
                $found = true;
                break;
            }
        }

        fclose($file);

        if (!$found) {
            echo "<p>Team not found.</p>";
        }
    } else {
        echo "<p>Unable to open the file.</p>";
    }
} else {
    echo "<p>Please provide a team name via the URL (e.g., ?team=Real Madrid).</p>";
}
?>


</body>
</html>