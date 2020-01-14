<?php include 'inc/header.php' ?>

<h1>Статьи <?php
    if($_SESSION['user']['rights'] == 1){
        ?><a href = 'add.php'>добавить</a> <?php
    }
?></h1>
<?php
$res = mysqli_query($db, 'SELECT * FROM `rm_articles` ORDER BY `id` DESC');
$articles = mysqli_fetch_all($res, MYSQLI_ASSOC);
foreach($articles as $article) {
?>
<div class="article-preview">
    <a class="article-title" href="/article.php?id=<?=$article['id']?>"><?=$article['title']?></a>
    <?php
    if($article['img_url']) {
        ?>
        <a href="/article.php?id=<?=$article['id']?>"><img class="article-img-preview" src="<?=$article['img_url']?>" alt="<?=$article['title']?>"></a>
        <?php
    }
    ?>
    <p class="article-text-preview"><?=mb_substr($article['text'], 0, 300).(mb_strlen($article['text']) > 300?'...':'')?><a class="article-read-more" href="/article.php?id=<?=$article['id']?>">Читать дальше</a></p>
</div>
<?php
}
?>
<?php include 'inc/footer.php' ?>
