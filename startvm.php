<?php

if(isset($_POST['start'])) {

$vmname = $_POST['vm'];
$username = $_POST['user'];

passthru('sudo virsh start '.$vmname);
echo "<script>history.back()</script>";

} else echo "no";

?>

