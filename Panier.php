<?php
    include("Head.php");
?>
<body>
<?php
    if(isset($_GET["aSupp"])){
        if(!empty($_SESSION["idArticle"][$_GET["aSupp"]])){
            unset($_SESSION["idArticle"][$_GET["aSupp"]]);
            unset($_SESSION["taille"][$_GET["aSupp"]]);
            unset($_SESSION["modele"][$_GET["aSupp"]]);
            unset($_SESSION["quantite"][$_GET["aSupp"]]);
            $_SESSION["nombreArticle"]--;
        }
    }
    if((!empty($_GET["clean"])) AND ($_GET["clean"] === "ok")){
        session_unset();
    }
    if((isset($_POST["key"])) AND (isset($_GET["key"])) AND (is_numeric($_POST["key"])) AND (is_numeric($_GET["key"])) AND ($_POST["key"] === $_GET["key"])){
        if(($_POST["modifQ"] > 0) AND ($_POST["modifQ"] < 5)){
            $_SESSION["quantite"][$_GET["key"]] = $_POST["modifQ"];
        }
    }
    include("Header.php");
?>
    <section class="container mt-5 mb-3 mx-auto">
        <div class="row">
            <h1 class="mr-auto">Votre Panier</h1>
            <a href="?clean=ok" class="">Réinitialiser</a>
        </div>
        <?php
            $total = 0;

            if(!empty($_SESSION["idArticle"])){
                foreach($_SESSION["idArticle"] as $key => $value){
                    $articlePanier = $bdd -> prepare("SELECT id, Image, Nom, Prix FROM Teeshirts WHERE id = :id");
                    if($articlePanier -> execute(array(':id' => $value))){
                        if($aP = $articlePanier -> fetch()){
                            $total = $total + ($aP["Prix"] * $_SESSION["quantite"][$key]);
                            $totalParArticle = $aP["Prix"] * $_SESSION["quantite"][$key];
                            echo "<div class=\"row mx-auto background-light mb-2 rounded\">
                            <div class=\"col-3 col-md-2 px-0\">
                            <img src=\"".$aP["Image"]."\" alt=\"Image du t-shirt\" class=\"img-panier m-auto\">
                            </div>
                            <div class=\"col-4 col-md-2 px-0 d-flex align-items-center justify-content-center\">
                            <div>
                            <p class=\"m-auto\">".$aP["Nom"]."</p>
                            </div>
                            </div>
                            <div class=\"col-5 col-md-3 px-0 d-flex align-items-center justify-content-center\">
                            <div>
                            <p class=\"m-auto\">P.U TVAC : ".$aP["Prix"]."€</p>
                            </div>
                            </div>
                            <div class=\"col-5 col-md-2 px-0 d-flex align-items-center justify-content-center\">
                            <form action=\"?key=".$key."\" method=\"POST\">
                                <input type=\"hidden\" class=\"hidden\" value=\"".$key."\" name=\"key\"/>
                                <input class=\"\"type=\"number\" max=\"4\" min=\"1\" name=\"modifQ\" Value=\"".$_SESSION["quantite"][$key]."\">
                                <input class=\"\"type=\"submit\" value=\"Changer\">
                            </form>
                            </div>
                            <div class=\"col-5 col-md-2 px-0 d-flex align-items-center justify-content-center\">
                            <div>
                            <p class=\"m-auto\">Prix total : ".$totalParArticle."€</p>
                            </div>
                            </div>
                            <div class=\"col-2 col-md-1 px-0 d-flex align-items-center justify-content-center\">
                            <div>
                                <a href=\"?aSupp=".$key."\" class=\"\">"?>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <path fill-rule="evenodd" d="M16 1.75V3h5.25a.75.75 0 010 1.5H2.75a.75.75 0 010-1.5H8V1.75C8 .784 8.784 0 9.75 0h4.5C15.216 0 16 .784 16 1.75zm-6.5 0a.25.25 0 01.25-.25h4.5a.25.25 0 01.25.25V3h-5V1.75z"></path><path d="M4.997 6.178a.75.75 0 10-1.493.144L4.916 20.92a1.75 1.75 0 001.742 1.58h10.684a1.75 1.75 0 001.742-1.581l1.413-14.597a.75.75 0 00-1.494-.144l-1.412 14.596a.25.25 0 01-.249.226H6.658a.25.25 0 01-.249-.226L4.997 6.178z"></path>
                                        <path d="M9.206 7.501a.75.75 0 01.793.705l.5 8.5A.75.75 0 119 16.794l-.5-8.5a.75.75 0 01.705-.793zm6.293.793A.75.75 0 1014 8.206l-.5 8.5a.75.75 0 001.498.088l.5-8.5z"></path>
                                    </svg>
        <?php
                            echo"</a>
                            </div>
                            </div>
                            </div>";
                        }
                    }
                }
            }
            if(!empty($_SESSION["idArticle"])){
                $tva = $total/100*21;
                $tva = round($tva, 2);
                echo "<div class=\"row mt-5 container mx-0\">
                      <div class=\"col-3 col-md-4 px-0 text-danger h4 d-flex align-items-center mb-0\">
                      <div>
                      <p class=\"m-0\">Total:</p>
                      </div>
                      </div>
                      <div class=\"col-5 col-md-5 text-danger h6 d-flex align-items-end mb-0\">
                      <div>
                      <p class=\"m-0\">TVA : ".$tva."€</p>
                      </div>
                      </div>
                      <div class=\"col-4 col-md-3 p-0 text-danger h6 d-flex align-items-end mb-0\">
                      <div>
                      <p class=\"m-0\">TVAC : ".$total."€</p>
                      </div>
                      </div>
                      </div>";
                echo "<div class=\"container d-flex justify-content-end mt-3\">
                      <div>
                      <a href=\"ValidationPanier.php\" class=\"py-2 btn btn-light border\">Valider mon panier</a>
                      </div>      
                      </div>";
            }else{
                echo "<p class=\"text-center h3 mt-5\">Votre panier est vide</p>";
            }
        ?>



    </section>
</body>
</html>
