<?php
    session_start();
    include("Head.php");
?>
<body class="h-100 d-flex flex-column">
    <?php
        include("Header.php");
    ?>
    <div class="d-flex my-auto flex-column align-items-center justify-content-center">
        <p class="h1 text-center mb-3">Connexion</p>
        <div class="bg-light d-flex flex-column align-items-center">
            <img src="#" alt="logo t-shirt">
            <p class="h2 mt-3">Admin</p>
            <?php
                if(isset($_SESSION["id"])){
                    header("Location: Administration/AdminAccueil.php");
                }else {
                    if(isset($_GET["error"])){
                        echo "<p class=\"\">Vos identifiants sont incorrects</p>";
                    }
                }
            ?>
            <div class="">
                <form class="d-flex flex-column" action="TraitementConnexion.php" method="POST">
                    <div class="d-flex justify-content-between my-2">
                        <label class="pr-2" for="email">Email :</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="d-flex justify-content-between my-2">
                        <label class="pr-2" for="mdp">Mot de passe :</label>
                        <input type="password" id="mdp" name="mdp">
                    </div>
                    <input class="btn mt-2 border" type="submit" value="Connexion">
                </form>
            </div> 
        </div>

    </div>
</body>
</html>