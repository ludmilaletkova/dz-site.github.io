<?php include 'inc/header.php'; 

if($_SESSION['user']['rights'] != 1){
	exit('Нет прав');
}
if($_POST['add']){
	$sql = mysqli_query($db, "SELECT * FROM `rm_articles` ORDER BY id DESC LIMIT 1");
	$num = mysqli_fetch_array($sql)['id'] + 1;
 	
	

	if ($_FILES['img'] != NULL){
		mysqli_query($db, "INSERT INTO `rm_articles`(`title`, `text`, `img_url`) VALUES ('" . $_POST['title'] . "', '" . $_POST['content'] . "', '" . $num . ".png')");

 	   	$sql = mysqli_query($db, "SELECT * FROM `rm_articles` ORDER BY `id` DESC LIMIT 1");
    	move_uploaded_file($_FILES["img"]["tmp_name"], "" . (mysqli_fetch_array($sql)['id']) . ".png");
    }	else {
    	mysqli_query($db, "INSERT INTO `rm_articles`(`title`, `text`) VALUES ('" . $_POST['title'] . "', '" . $_POST['content'] . "')");
    }
    echo '<script>window.location.href = \'/\';</script>';
}

?>
<form action = '' method="POST" enctype='multipart/form-data'>
	<h2>Заголовок</h2>
	<input type="text" name="title"><br>
	<h3> Описание </h3>
	<textarea name = "content" cols = "50" rows = "30"></textarea><br>
	<input type = 'file' name = 'img' accept='image/png'>
	<input type="submit" name="add" value="add">
</form>


<?php include 'inc/footer.php' ?>
