<?php

$tanimli_email = "b2412100001@sakarya.edu.tr";
$tanimli_sifre = "b2412100001";

$_email = isset($_POST['email']) ? trim($_POST['email']) : '';
$_sifre = isset($_POST['password']) ? trim($_POST['password']) : '';

if ($post_email === $tanimli_email && $post_sifre === $tanimli_sifre) {
    echo  "true"; 
    exit; 
} else {
    echo "false"; 
    exit; 
}
?>