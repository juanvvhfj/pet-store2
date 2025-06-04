<?php
include('../config/database.php');

$email = $_POST['e_mail'];
$passw = $_POST['p_assw'];

// Busca el usuario por email
$sql = "SELECT id, password FROM users WHERE email = $1 AND status = true";
$res = pg_query_params($conn, $sql, array($email));

if ($res && pg_num_rows($res) > 0) {
    $row = pg_fetch_assoc($res);
    // Verifica la contraseña (si usas password_hash en el registro)
    // if (password_verify($passw, $row['password'])) {
    if ($passw === $row['password']) { // Solo si guardas la contraseña en texto plano (no recomendado)
        echo "<script>alert('User has been logged in. Go to home!');</script>";
        header('refresh:0;url=http://localhost/pet-store2/src/home.html');
        exit();
    } else {
        echo "<script>alert('Incorrect password.');</script>";
        header('refresh:0;url=http://localhost/pet-store2/src/login.html');
        exit();
    }
} else {
    echo "<script>alert('User not found. Go to signup!');</script>";
    header('refresh:0;url=http://localhost/pet-store2/src/register.html');
    exit();
}
?>