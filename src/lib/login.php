<?php
$action = $_POST['action']
if ($action==="login") {
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
}elseif ($action==="contact") {
    echo "<b>E-Posta:</b>". $_POST["email"]. "<br>";
    echo "<b>Yaş:</b>". $_POST["age"]. "<br>";
	echo "<b>Telefon:</b>". $_POST["phone"]. "<br>";
    echo "<b>Öneriler:</b>";
    foreach($_POST["suggestions"] as $sugg) {
        echo $sugg . " ";
        }
        echo "<b>Mesaj:</b>". $_POST["message"]. "<br>";
        

}
?>