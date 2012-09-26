<?php
session_start();

if ($_POST["os"] && $_POST["vmname"] && $_POST["ram"] && $_POST["disk"]) {

$os = $_POST["os"];
$vmname = $_POST["vmname"];
$ram = $_POST["ram"];
$disk = $_POST["disk"];
$username = $_SESSION["username"];

$vm = str_replace(' ', '_', $vmname);

$host = "localhost";
$sqluser = "root";
$sqlpass = "test1234";
$sqlconnect = mysql_connect($host, $sqluser, $sqlpass);
mysql_select_db("Plaintech", $sqlconnect);

$checkUserVM = "SELECT vmname FROM vm WHERE vm.username = '$username' AND vm.vmname = '$vm'";
$checkUserVM2 = mysql_query($checkUserVM);
$nr = mysql_num_rows($checkUserVM2);
if($nr > 0) {
echo "You already have a VM with this name";
} else {
$checkVNC = "SELECT vmname FROM vm WHERE vm.username = '$username'";
$checkVNC2 = mysql_query($checkVNC);
$checkVNCnr = mysql_num_rows($checkVNC2);
$vnc = 5900 + $checkVNCnr;
$q = "'";

if($os == "Windows") {
passthru("sudo virt-install -n ".$vm." -r ".$ram." --network bridge:br0 --cdrom=/vms/install/winxp_pro.iso -f /vms/".$username."/".$vm.".qcow2 -s ".$disk." --noautoconsole --vnc --vncport=".$vnc." --connect qemu:///system");
putenv("VAR1=$vm");
system("/bin/bash /vms/install/sed.sh $vm");
//passthru("sudo sed '29i<source file=/vms/install/winxp_pro.iso/>' /etc/libvirt/qemu/$vm.xml > /etc/libvirt/qemu/sed-file1.xml");
//passthru("sudo sed '27c<disk type=file device=cdrom>' /etc/libvirt/qemu/sed-file1.xml > /etc/libvirt/qemu/sed-file2.xml");
//passthru('sudo mv /etc/libvirt/qemu/'.$vm.'.xml /etc/libvirt/qemu/will-delete');
//passthru('sudo mv /etc/libvirt/qemu/sed-file2.xml /etc/libvirt/qemu/'.$vm.'.xml');
//passthru('sudo rm /etc/libvirt/qemu/sed-file1.xml');
//passthru('sudo rm /etc/libvirt/qemu/will-delete');
//passthru('sudo virsh define /etc/libvirt/qemu/'.$vm.'.xml');

//passthru('sudo qemu-img create -f qcow2 /vms/'.$username.'/'.$vm.'.img '.$disk.'G');
//passthru('sudo virt-install -n '.$vm.' -r '.$ram.' -f '.$vm.'.qcow2 -s '.$disk.' --cdrom=/vms/install/winxp_pro.iso --vnc --vncport='.$vnc);
//passthru('sudo cp /vms/install/temp_winxp.img /vms/'.$username);
//passthru('sudo mv /vms/'.$username.'/temp_winxp.img /vms/'.$username.'/'.$vm.'.img');
//passthru('sudo virsh start '.$vm);
//passthru('sudo qemu -m '.$ram.' -vnc :'.$vnc.' -hda /vms/'.$username.'/'.$vm.'.img -cdrom /vms/install/winxp_pro.iso -boot c');
}
if($os == "Linux") {
passthru('sudo qemu-img create -f qcow2 /vms/'.$username.'/'.$vm.'.img '.$disk.'G');
//exec('sudo qemu -m '.$ram.' -vnc :'.$vnc.' -hda /vms/'.$username.'/'.$vm.'.img -cdrom /vms/install/ubuntu_server1004.iso -boot d');
}
$addUserVM = "INSERT INTO vm (username, vmname, os, ram, disk, vnc) values ('$username','$vm','$os','$ram','$disk','$checkVNCnr')";
$addUserVM2 = mysql_query($addUserVM, $sqlconnect);
//header("location:home.php");
}

} else echo "You have left some fields empty";

?>
