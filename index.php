<!DOCTYPE html>
<html lang="en">
<head>
    <title>"KPOPERS"</title>
    <meta charset="UTF-8">
    <meta name="description" contents="KPOPERS">
    <link rel="stylesheet" href="style2.css" type="text/css">
</head>
<body>
    <header>
        <h1 class="title">"KPOPERS"</h1>
        <h3 class="desc">Only Kpopers</h3>
        <nav id="navigation">
            <ul>
                <li><a href="login.php">LOGIN</a></li>
                <li><a href="register.php">REGISTER</a></li>
                <img src="image/allfandom.jpg" alt="">
            </ul>
        </nav>
    </header>
    <div id="contents">
        <?php 
        if(isset($_GET['page'])){
            $page = $_GET['page'];
 
            switch ($page) {
                case 'LOGIN':
                include "LOGIN.php";
                break;
                case 'REGISTER':
                include "REGISTER.php";
                break;       
            }
        }
else{
            include "LOGIN.php";
        }
        ?>
 
    </div>
    <footer>
    </footer>
</body>
</html>