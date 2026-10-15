<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Process Number</title>
</head>
<body>

<?php
if (isset($_GET['num'])) {
    $number = (int)$_GET['num'];
    $filePath = './data/numbers.txt';

    if ($number !== 0) {
        // Append the number to the file with a new line
        $file = fopen($filePath, 'a');
        if ($file) {
            fwrite($file, $number . PHP_EOL);
            fclose($file);
            echo "<h1>Success</h1>";
            echo "<p>The number $number has been saved.</p>";
        } else {
            echo "<p>Unable to open the file for writing.</p>";
        }
    } else {
        // If the number is 0, calculate average and delete the file
        if (file_exists($filePath)) {
            $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            
            if (count($lines) > 0) {
                $sum = array_sum($lines);
                $count = count($lines);
                $average = $sum / $count;

                echo "<h1>Results</h1>";
                echo "<p><strong>Total numbers:</strong> $count</p>";
                echo "<p><strong>Average:</strong> " . round($average, 2) . "</p>";
            } else {
                echo "<p>The file was empty. Cannot calculate average.</p>";
            }

            // Delete the file
            unlink($filePath);
            echo "<p><em>The data file has been deleted.</em></p>";
        } else {
            echo "<h1>No Data</h1>";
            echo "<p>There are no numbers saved yet to calculate an average.</p>";
        }
    }
} else {
    echo "<p>Please provide a number via the form.</p>";
}
?>

    <p><a href="20-SendNumbers.html">Go Back</a></p>
</body>
</html>
