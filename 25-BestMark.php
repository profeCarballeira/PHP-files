<?php
// Target directory configuration
$target_dir = "uploads/";

// Create the directory if it does not exist to avoid write errors
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Full path of the destination file keeping the original name
$target_file = $target_dir . basename($_FILES["marksFile"]["name"]);
$upload_ok = true;

// Display file metadata for debugging (optional)
echo "<h3>File details:</h3>";
echo "Original file: " . htmlspecialchars(basename($_FILES["marksFile"]["name"])) . "<br>";
echo "Size: " . $_FILES["marksFile"]["size"] . " bytes<br><br>";

// Check if the file already exists (Informational only, it will overwrite)
if (file_exists($target_file)) {
    echo "<em>Notice: An existing file with this name will be overwritten.</em><br><br>";
}

// Proceed with the upload directly
if ($upload_ok) {
    if (move_uploaded_file($_FILES["marksFile"]["tmp_name"], $target_file)) {
        echo "<strong>The file has been successfully uploaded to:</strong> " . htmlspecialchars($target_file) . "<br><br>";
        
        // --- Process the file content ---
        process_best_mark($target_file);

    } else {
        echo "A general error occurred while trying to move the uploaded file.<br>";
    }
}

/**
 * Function that reads the file and calculates the highest mark
 */
function process_best_mark($file_path) {
    // Open the file in read-only mode
    $file_handle = fopen($file_path, "r");
    
    if (!$file_handle) {
        echo "Could not open the file for reading.<br>";
        return;
    }

    $best_student = "";
    $best_mark = -1; // Initialize with a value lower than the minimum possible mark

    // Read line by line
    while (($line = fgets($file_handle)) !== false) {
        // Clear leading/trailing whitespaces or line breaks
        $line = trim($line);
        
        // Ignore empty lines
        if (empty($line)) {
            continue;
        }

        // Split the string by the '#' delimiter
        $parts = explode("#", $line);

        // Validate that the line has the correct format (Student#Mark)
        if (count($parts) == 2) {
            $student = trim($parts[0]);
            $mark = floatval(trim($parts[1])); // Convert to number (supports decimals)

            // Evaluate if this is the highest mark recorded so far
            if ($mark > $best_mark) {
                $best_mark = $mark;
                $best_student = $student;
            }
        }
    }

    // Safely close the file pointer
    fclose($file_handle);

    // Display the results to the user
    echo "<h3>Analysis Results:</h3>";
    if ($best_mark !== -1) {
        echo "The best mark belongs to <strong>" . htmlspecialchars($best_student) . "</strong> with a <strong>" . $best_mark . "</strong>.";
    } else {
        echo "No valid records were found or the file was empty.";
    }
}
?>
