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

<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                <li class="nav-item">
                    <!--                    <a class="nav-link" href="#">Link</a>-->
                </li>
            </ul>
            <form class="d-flex" action="index.php">
                <input class="form-control me-2" type="search" name="q" value="<?php echo $_GET['q'] ?>"
                       placeholder="Ҷустуҷу" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Ҷустуҷу</button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid mt-3">
    <div class="row">
        <?php
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
                    <div class="card adib-view">
                        <img src="img/<?php echo $item["img"] ?>"
                             class="card-img-top img-fluid adib-img me-auto ms-auto"
                             alt="...">
                        <div class="card-body">
                            <h3 class="card-text"><a
                                        href="details.php?id=<?php echo $item["uuid"] ?>"><?php echo $item["name"] ?></a>
                            </h3>
                            <p class="card-text adib-bio"><?php echo substr($item["bio"], 0, 300) . "..." ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }


        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        ?>

    </div>
</div>

<footer class="bg-light text-center text-lg-start mt-5">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0,0,0,0.03);">
        © 2022 Copyright:
        <a class="text-dark" href="/">adibon.tj</a>
    </div>
    <!-- Copyright -->
</footer>

<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
