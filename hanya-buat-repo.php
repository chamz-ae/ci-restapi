<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Simpan atau proses data kontak di sini
    // Misalnya, kirim email atau simpan ke database

    echo "Thank you, $name. Your message has been received.";
} else {
    echo "Invalid request method.";
}
?>
