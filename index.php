<?php
/**
 * @author Rustam Safarov (RS)
 * created 4/17/2022
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
                    <a class="nav-link active" aria-current="page" href="/">Асосӣ</a>
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
                    <a class="nav-link" aria-current="page" href="/gallery.php">Расмхо</a>
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
<div class="container">
    <div class="row">
        <div class="col-12">
            <h5 class="w-100 text-center mt-4">
                Коркарди Веб-саҳифаи муаррифии адибони тоҷик: омода намудани портрети рақамии Дадохон Эгамзод
            </h5>
        </div>
    </div>
</div>
<div class="container-fluid mt-3">
    <div class="row">
        <?php
        if ($_GET["q"]) {
            $stmt = $conn->prepare("select * from adib where name like :q or bio like :q");
            $stmt->execute(["q" => '%' . $_GET["q"] . '%']);
        } else {
            $stmt = $conn->prepare("select * from adib");
            $stmt->execute();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (sizeof($result) == 0) {
            echo "Not found";
        }
        foreach ($result as $item) {
            ?>
            <div class="col-4 mt-3">
                <a class="adib-link" href="details.php?id=<?php echo $item["uuid"] ?>">
                    <div class="card adib-view">
                        <div class="card-img-top adib-img"
                             style="background-image: url('img/<? echo $item['img'] ?>')"></div>
                        <div class="card-body">
                            <h3 class="card-text"><?php echo $item["name"] ?>
                            </h3>
                            <p class="card-text adib-bio"><?php echo substr($item["bio"], 0, 300) . "..." ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php
        }

        ?>

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
</body>
</html>
