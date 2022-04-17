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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Асосӣ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
<?php
if (isset($_GET["id"])) {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("select * from adib where uuid=:id limit 1");
    $stmt->execute(["id" => $_GET["id"]]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (sizeof($result) != 0) {
        $item = $result[0];
        ?>
        <div class="container mt-3">
            <div class="row">
                <div class="col-4 ms-auto me-auto">


                    <img src="img/<?php echo $item["img"] ?>" class="mw-100" alt="">
                    <h2 class="text-center">
                        <?php echo $item["name"] ?>
                    </h2>
                    <p class="text-center">
                        <?php echo $item["years"] ?>
                    </p>
                    <?php
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p>
                        <?php
                        echo $item["bio"]
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <?php
    } else {
        echo "Not found";
    }
} else {
    echo "Not found";
}
?>