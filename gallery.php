<?php
/**
 * @author Rustam Safarov (RS)
 * created 4/22/2022
 * (c) 2022 RS DevTeam.
 */
require 'config.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adibon.tj</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/simple-lightbox.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("select * from adib");
$stmt->execute();
$menuResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Adibon</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Асосӣ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Руйхат
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php foreach ($menuResult as $item) {
                            echo '<li><a class="dropdown-item" href="details.php?id=' . $item["uuid"] . '">' . $item["name"] . '</a></li>';
                        } ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/gallery.php">Расмхо</a>
                </li>
            </ul>
            <form class="d-flex" action="index.php">
                <input class="form-control me-2" type="search" name="q" value="<?php echo $_GET['q'] ?>"
                       placeholder="Ҷустуҷу" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Ҷустуҷу</button>
            </form>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <div class="row">
        <div class="gallery">
            <?php foreach ($menuResult as $item) {
                echo '<a href="img/' . $item['img'] . '" class="big col-3 a-img p-2" rel="rel1">
                    <div style="background-image: url(img/'.$item['img'] .')" class="gallery-img" alt="" title="'.$item['name'].'"></div>
                </a>';
            } ?>
        </div>
    </div>
</div>

<footer class="bg-light mt-5" style="background-color: rgba(0,0,0,0.03);">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <!-- Copyright -->
                <div class="text-start p-3">
                    © 2022 Copyright:
                    <a class="text-dark" href="/">adibon.tj</a>,
                    Khujand
                </div>
            </div>
            <div class="col-4">
                <div class="text-end p-3">
                    Кулов Б
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/simple-lightbox.min.js"></script>

<script>
    var gallery = new SimpleLightbox('.gallery a', {
        scaleImageToRatio: true,

    });
</script>

</body>
</html>