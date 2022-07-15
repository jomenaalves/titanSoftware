<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= PATH_OF_YOUR_APP . "assets/style.css"?>">
    <?= $this->section("head"); ?>
    <!-- Icones do fonte awesome -->
    <script src="https://kit.fontawesome.com/77cd38f0c6.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <div class="contain">
            <div>
                <img src="<?= PATH_OF_YOUR_APP . 'assets/imgs/logo.jpg'?>" alt="" width="70px">
            </div>
    
            <div class="search">
                <input type="text" name="search" id="searchInput" placeholder="Pesquisar por produtos"/>
            </div>
        </div>
    </nav>
    <?= $this->section("mainContent"); ?>
    <?= $this->section("srcs"); ?>
</body>
</html>