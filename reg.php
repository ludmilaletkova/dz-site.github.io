<?php
include 'inc/header.php';
$show_warning = false;
if(strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    $name = mysqli_real_escape_string($db, $_POST['name']) ?? false;
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ?? false;
    $password = $_POST['password'] ?? false;


    if(empty($password) || empty($email) || empty($name)) {
        $show_warning = 'Не все поля заполнены';
    } else {
        $hash = md5(SALT.$password);
        $result = mysqli_query($db, 'INSERT INTO `rm_users` (`name`, `email`, `hash`) VALUES ("'.$name.'", "'.$email.'", "'.$hash.'")');
        $user_id = mysqli_insert_id($db);
        $result = mysqli_query($db, 'SELECT * FROM `rm_users` WHERE `id` = "'.$user_id.'"');
        $user = mysqli_fetch_assoc($result);
        if(!empty($user)) {
            unset($user['hash']);
            $_SESSION['user'] = $user;
            echo '<script>window.location.href = \'/\';</script>';
        } else {
            $show_warning = 'Такой пользователь уже зарегистрирован';
        }
    }
}
?>
    <h1>Регистрация</h1>
    <?php
    if($show_warning) {
        ?>
        <div class="warning"><?=$show_warning?></div>
        <?php
    }
    ?>
    <form class="form reg" method="post">
        <label for="nm">Имя</label>
        <input class="inp" type="text" name="name" id="nm" autofocus required>
        <label for="eml">E-mail</label>
        <input class="inp" type="text" name="email" id="eml" required>
        <label for="pswd">Пароль</label>
        <input class="inp" type="password" name="password" id="pswd" minlength="8" required>
        <button type="submit" class="btn">Зарегистрироваться</button>
    </form>
    <a class="bot-link" href="/login.php">Вход</a>
<?php include 'inc/footer.php' ?>
