<?php
    include("Head.php");
?>
<body>
<?php
    include("Header.php");
    function kodex_random_string($length){
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for($i=0; $i<$length; $i++){
            $string .= $chars[rand(0, strlen($chars)-1)];
        }
        return $string;
    }
    if(!empty($_POST["Mail"])){
        $mail_Present_dans_la_BDD = $bdd->prepare("SELECT id FROM utilisateurs WHERE Email = :email");
        $mail_Present_dans_la_BDD->execute(array(":email" => $_POST["Mail"]));
        if($mail_Present_dans_la_BDD->rowCount() === 1){
            $longueur_MDP = rand(8,14);
            $nouveau_MDP = kodex_random_string($longueur_MDP);
            $to = $_POST["Mail"];
            $subject = "Nouveau mot de passe";
            $message = "Votre nouveau mot de passe est :".$nouveau_MDP;
            $headers = "MIME-Version: 1.0"."\r\n". 
            "Content-type: text/html; charset=iso-8859-1"."\r\n". 
            "From: webmaster@example.com" . "\r\n" .
            "Reply-To: webmaster@example.com" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();
            if(mail($to, $subject, $message, $headers)){
                $MDP_a_Actualiser = $bdd->prepare("UPDATE utilisateurs SET MDP = ? WHERE Email = ?");
                $MDP_a_Actualiser->execute(array($nouveau_MDP, $_POST["Mail"]));
            }

        }
    }
?>
    <div class="d-flex justify-content-center mt-5"> 
        <div class="d-flex flex-column">
            <form method="POST" action="" class="d-flex flex-column background-light p-3 border rounded align-self-start">
                <h2 class="align-self-center color-green">Mot de passe oublié</h2>
                <div class="d-flex justify-content-between my-1 bold color-green">
                    <label class="m-0" for="Mail">Adresse mail :</label>
                    <input type="text" name="Mail" id="Mail" class="ml-2">
                </div>
                <div class="d-flex justify-content-end my-1 bold color-green">
                    <input type="submit"  name="connecter" value="Envoyer un mail">
                </div>
            </form>
        </div> 
    </div>
</body>
