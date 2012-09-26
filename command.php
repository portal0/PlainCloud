<?php
$command1 = "mkdir /vm/";

if (isset($_POST['filename'])) {
$command2 = $_POST['filename'];
system($command1 . $command2);
}

?>
