<?php
require "includes/db.php";
$articles = mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `id` DESC LIMIT 4");
$categories_q = mysqli_query($connection, "SELECT * FROM `articles_categories`");
$categories = array();
while ($cat = mysqli_fetch_assoc($categories_q)) {
    $categories[] = $cat;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Main</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <!-- ICONS -->
    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

</head>

<body>
    
    <!-- HEADER SECTION -->
    <section id="header">
        <div class="nav">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand m-brand" href="/">Coffee blog</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="n-link" href="#late">Latest</a>
                            <a class="n-link" aria-current="page" href="#top">Top</a>
                            <a class="n-link" href="#contacts">Contacts</a>
                            <a href="Compose.php">
                                <button class="btn n-but" type="submit" name="button">Create</button>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="main-info">
            <img class="main-img" src="static/images/main-back.jpeg" alt="img">
            <div class="main-txt">
                <h1 class="m-title">The place where you can <br> return.</h1>
                <p>Share feelings is ease with us.</p>
                <a href="Compose.php">
                    <button class="btn btn-start " type="submit" name="button">Get start</button>
                </a>
            </div>
        </div>
    </section>

    <!-- SHARED LAST TIME -->
    <section id="late">
        <div class="row row-cols-2">
            <div class="late_share">
                <h3 class="cat-tit" style="font-family: Montserrat; margin-bottom:30px; text-align:center; ">Latest shared</h3>
                <?php
                while ($art = mysqli_fetch_assoc($articles)) {
                ?>
                    <div class="card mb-3 card-all">
                        <div class="row g-0">
                            <div class="col-sm-4">
                                <img src="static/images/<?php echo $art['image']; ?>" class="img-fluid rounded-start card-img" alt="image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <a class="card-title dis_each0" href="/article.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a><br>
                                    <?php
                                    $art_cat = false;
                                    foreach ($categories as $cat) {
                                        if ($cat['id'] == $art['categories_id']) {
                                            $art_cat = $cat;
                                            break;
                                        }
                                    }
                                    ?>
                                    <a class="card-text dis_each" href="/articles.php?categorie=<?php echo $art_cat['id']; ?>">Category: <?php echo $art_cat['title']; ?></a><br>
                                    <p class="card-text dis_each1"><?php echo mb_substr($art['text'], 0, 100, 'utf-8'); ?></p>
                                    <a class="card-text dis_each" href="/article.php?id=<?php echo $art['id']; ?>">See more...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        </div>
        <?php
        $articles = mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `views` DESC LIMIT 5");
        ?>
        <section id="top">
            <div class="late_share2">
                <h3 class="cat-tit">Top views</h3>
                <?php
                while ($art = mysqli_fetch_assoc($articles)) {
                ?>
                    <div class="card mb-3 card-all">
                        <div class="row g-0">
                            <div class="col-sm-4">
                                <img src="static/images/<?php echo $art['image']; ?>" class="img-fluid rounded-start card-img" alt="image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <a class="card-title dis_each0" href="/article.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a><br>
                                    <?php
                                    $art_cat = false;
                                    foreach ($categories as $cat) {
                                        if ($cat['id'] == $art['categories_id']) {
                                            $art_cat = $cat;
                                            break;
                                        }
                                    }
                                    ?>
                                    <a class="card-text dis_each" href="/article.php?categorie=<?php echo $art_cat['id']; ?>">Category: <?php echo $art_cat['title']; ?></a><br>
                                    <p class="card-text dis_each1"><?php echo mb_substr($art['text'], 0, 50, 'utf-8'); ?></p>
                                    <a class="card-text dis_each" href="/article.php?id=<?php echo $art['id']; ?>">See more...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            </div>
        </section>

        <div class="col-4 cat">
            <h3>Category</h3>
            <?php
            foreach ($categories as $cat) {
            ?>
                <a class="cat-link" href="/all-blog.php?categorie=<?php echo $cat['id']; ?>"><?php echo $cat['title'] ?></a><br>
            <?php
            }
            ?>

        </div>
        </div>
        </div>
        </div>


        <div class="col-4 cat1">
            <h3 style="font-family: Montserrat; text-align:center; margin-bottom:30px;">Last comments</h3>
            <?php
            $comments = mysqli_query($connection, "SELECT * FROM `comments` ORDER BY `id` DESC LIMIT 5");
            ?>
            <?php
            while ($comment = mysqli_fetch_assoc($comments)) {
            ?>
                <div class="card mb-3 card-all-comment">
                    <div class="row g-0">
                        <div class="col-sm-4">
                            <img href="https://ru.gravatar.com/avatar/<?php echo md5($comment['email']); ?>" class="img-fluid rounded-start card-img" alt="image">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a class="card-title dis_each0"><?php echo $comment['author']; ?></a><br>
                                <p class="card-text dis_each1"><?php echo mb_substr($comment['text'], 0, 20, 'utf-8'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        </div>
    </section>
    <section id="contacts">
        <?php
        require_once "includes/footer.php"
        ?>
    </section>
</body>

</html>