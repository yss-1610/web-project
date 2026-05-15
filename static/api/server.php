<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Methods:  POST");
header('Access-Control-Allow-Headers: Content-Type'); 
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}
$action = $_POST['action'];
if ($action==="login") {
    $tanimli_email = "b2412100001@sakarya.edu.tr";
    $tanimli_sifre = "b2412100001";
    
    $_email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $_sifre = isset($_POST['password']) ? trim($_POST['password']) : '';
    
    if ($_email === $tanimli_email && $_sifre === $tanimli_sifre) {
    echo  json_encode(array('success' => 'true')); 
    exit; 
    } else {
    echo json_encode(array('success' => 'false')); 
    exit; 
    }
}elseif ($action==="contact") {
        $data = [
            'name'        => $_POST['name'] ?? '',
            'email'       => $_POST['email'] ?? '',
            'phone'       => $_POST['phone'] ?? '',
            'age'         => $_POST['age'] ?? '',
            'suggestions' => $_POST['suggestions'] ?? [],
            'message'     => $_POST['message'] ?? '',
            'timestamp'   => date('Y-m-d H:i:s')
        ];
        echo json_encode(['success' => 'true', 'data' => $data], JSON_PRETTY_PRINT);
        exit;
}
?>
