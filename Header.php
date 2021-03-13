<header class="navbar navbar-expand-lg sticky-top justify-content-around background color-light">
        <img src="image/" alt="Logo de t-shirt Store" class="">
        <nav class="">
            <ul class="nav justify-content-around container-md">
                <?php
                    $liste = '<li class="nav-item">';
                    $classANav = 'class="nav-link color-light bold text-capitalize"';
                    $categories = $bdd ->query('SELECT Nom FROM categories');
                    while($categoriesVal = $categories -> fetch()){
                        echo $liste.'<a href="Categorie.php?cat='.$categoriesVal["Nom"].'"'.$classANav.'>'.$categoriesVal['Nom'].'</a></li>'."\n";
                    }
                ?>
            </ul>
        </nav>
        <div class="d-flex">
            <div class="mx-3">
                <a href="#" class="nav-link color-light bold">Panier</a>
            </div>
            <div class="">
                <a href="#" class="nav-link color-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                </a>
            </div>
        </div>
    </header>


