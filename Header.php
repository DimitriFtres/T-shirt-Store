<header class="background">
    <nav class="container navbar navbar-expand-lg sticky-top justify-content-around color-light">
        <a href="index.php"><img src="Image\Logo_tshirtstore.png" alt="Logo de t-shirt Store" class="logo-header navbar-brand"></a>
        <div class="collapse navbar-collapse justify-content-around container-md" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <?php
                    $liste = '<li class="nav-item">';
                    $classANav = 'class="nav-link color-light bold text-capitalize text-center"';
                    $categories = $bdd ->query('SELECT Nom FROM categories WHERE Flag_supp IS NULL LIMIT 6');
                    while($categoriesVal = $categories -> fetch()){
                        echo $liste.'<a href="Categorie.php?cat='.$categoriesVal["Nom"].'"'.$classANav.'>'.$categoriesVal['Nom'].'</a></li>'."\n";
                    }
                ?>
            </ul>
            </div>
        <div class="d-flex">
            <div class="mx-3">
                <a href="panier.php" class="nav-link color-light bold">Panier
                <?php 
                    if(!empty($_SESSION["nombreArticle"])){
                       echo "(".$_SESSION["nombreArticle"].")";
                    }
                ?>
                </a>
            </div>
            <div class="">
                <a href="ConnexionAdmin.php" class="nav-link color-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                </a>
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-justify color-light" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
        </svg>
    </button>
        </nav>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </header>



