<?php
include 'inc/header.php';
$id = $_GET['id'] ?? false;

if(!$id) {
    die('404');
}

$res = mysqli_query($db, 'SELECT * FROM `rm_articles` WHERE id = "'.(int)$id.'"');
$article = mysqli_fetch_assoc($res);

if(empty($article)) {
    die('404');
}
?>
<div class="article-preview">
    <span class="article-title"><?=$article['title']?></span>
    <?php
    if($article['img_url']) {
    ?>
    <img class="article-img-preview" src="<?=$article['img_url']?>" alt="<?=$article['title']?>">
    <?php
    }
    ?>
    <div class="article-text-preview"><?=$article['text']?></div>
</div>
<div>
	<h3> Комментарии </h3>
	<?php
		if($_SESSION['user'] != NULL){
		?>
				<form action = '' method = 'POST'>
					<textarea name = 'text' cols = '80' rows = '5' placeholder = "Комментарий..."></textarea><br>
					<input type="submit" name="send" value="Отправить">
				</form>
		<?php
		} else {
			?>
				<h4>Добавлять комментарии могут только зарегистрированные пользователи</h4>
			<?php
		}
		if($_POST['send'] !=  NULL){
			mysqli_query($db, "INSERT INTO `comments`(`article`, `name`, `text`) VALUES ({$_GET['id']},'{$_SESSION['user']['name']}','{$_POST['text']}')");
		}

		$comment = mysqli_query($db, "SELECT * FROM `comments` WHERE `article` = {$_GET['id']} ORDER BY `id` DESC");
		while($result = mysqli_fetch_array($comment)){
			echo "<div style = 'border-top : 1px solid black;'> {$result['name']} {$result['date']} <br> {$result['text']}</div>";
		}
	?>
</div>
<?php
include 'inc/footer.php';>
