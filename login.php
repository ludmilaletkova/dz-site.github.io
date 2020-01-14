<?php
include 'inc/header.php';
$show_warning = false;
if(strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ?? false;
    $password = $_POST['password'] ?? false;


    if(empty($password) || empty($email)) {
        $show_warning = 'Не все поля заполнены';
    } else {
        $hash = md5(SALT.$password);
        $result = mysqli_query($db, 'SELECT * FROM `rm_users` WHERE `email` = "'.$email.'" AND `hash` = "'.$hash.'"');
        $user = mysqli_fetch_assoc($result);
        if(!empty($user)) {
            unset($user['hash']);
            $_SESSION['user'] = $user;
            echo '<script>window.location.href = \'/\';</script>';
        } else {
            $show_warning = 'Такой пользователь не найден';
        }
    }
}
?>
    <h1>Вход</h1>

    <?php
    if($show_warning) {
        ?>
        <div class="warning"><?=$show_warning?></div>
        <?php
    }
    ?>
    <form class="form login" method="post">
        <label for="eml">E-mail</label>
        <input class="inp" type="text" name="email" id="eml" autofocus required>
        <label for="pswd">Пароль</label>
        <input class="inp" type="password" name="password" id="pswd" minlength="8" required>
        <button type="submit" class="btn">Войти</button>
    </form>
    <a class="bot-link" href="/reg.php">Регистрация</a>
<?php include 'inc/footer.php' ?>
