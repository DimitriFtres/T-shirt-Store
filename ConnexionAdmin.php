<?php
    include("Head.php");
?>
<body class="h-100 d-flex flex-column">
    <?php
        include("Header.php");
    ?>
    <div class="d-flex my-auto flex-column align-items-center justify-content-center">
        <p class="h1 text-center">Connexion</p>
        <div class="background-light d-flex flex-column align-items-center">
            <img src="#" alt="logo t-shirt">
            <p class="h2">Admin</p>
            <div class="">
                <form class="d-flex flex-column" action="" method="POST">
                    <div class="d-flex justify-content-between my-2">
                        <label class="pr-2" for="email">Email :</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="d-flex justify-content-between my-2">
                        <label class="pr-2" for="mdp">Mot de passe :</label>
                        <input type="password" id="mdp" name="mdp">
                    </div>
                    <input class="btn mb-2 border" type="submit" value="Connexion">
                </form>
            </div> 
        </div>

    </div>
</body>
</html>