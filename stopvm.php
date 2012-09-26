<?php

if(isset($_POST['stop'])) {

$vmname = $_POST['vm'];
$username = $_POST['user'];

passthru('sudo virsh shutdown '.$vmname);
echo "<script>history.back()</script>";

} else echo "log in first";

?>
