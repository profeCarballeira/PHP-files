<?php
$myfile = fopen("data/newfile.txt", "x") or die("Unable to open file!");
$txt = "aaaaaaaaaaa\n";
fwrite($myfile, $txt);
$txt = "bbbbbb\n";
fwrite($myfile, $txt);
fclose($myfile);
echo "The file was created";
?>