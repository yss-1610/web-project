<?php
if (isset($_POST['login_form'])) {
    echo "<b>Hoşgeldiniz </b>". $_POST["password"]. "<br>";
}elseif (isset($_POST['contact_form'])) {
    print('Bir mesajınız var!!');
    echo "<b>İsim Soyisim</b>". $_POST["Name"]. "<br>";
    if ('e-mail'===$_POST[prefCont]) {
        echo "<b>E-posta :</b>". $_POST["email"]. "<br>";
    }if ('phone'===$_POST[prefCont]) {
        echo "<b>Telefon Numarası :</b>". $_POST["phone"]. "<br>";
    }
    echo "<b>Mesaj :</b>". $_POST["message"]. "<br>";
}
?>