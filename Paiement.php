<?php
include('Head.php');
if((empty($_SESSION["Email"])) OR (empty($_SESSION["totalPanier"]))){
    header("Location: Index.php");
}
print_r($_SESSION);
?>
</head>
<body>
<?php
    include('Header.php');
?>
<h1 class="text-center my-5">Merci pour votre commande</h1>
<section class="container">
    <p>Votre commande sera livrée lorsque votre paiement de <?= $_SESSION["totalPanier"] ?>€ sera reçu sur le compte en banque BE65 9584 1235 4578. Veuillez mettre votre nom et prénom ainsi que votre adresse dans la communication libre. Vos informations ne peuvent pas être différentes de celles que vous avez entrées.</p></p>
    <p>Vous receverez un mail de confirmation.</p>
</section>
<?php
$to      = $_SESSION["Email"];
$subject = 'Commande de T-shirt Store';
$message = "
<html>
    <head>
        <title>Commande T-shirt Store</title>
    </head>
    <body>
        <h1>Merci pour votre commande</h1>
        <p>Votre commande sera livrée lorsque votre paiement de ".$_SESSION["totalPanier"]."€ sera reçu sur le compte en banque BE65 9584 1235 4578. Veuillez mettre votre nom et prénom ainsi que votre adresse dans la communication libre. Vos informations ne peuvent pas être différentes de celles que vous avez entrées.</p>
        <p>Voici un résumé de votre commande : </p>
        <table>
        <tr><td>Nom du T-shirt</td>
        <td>Taille</td>
        <td>Modele</td>
        <td>Quantité</td>
        <td>Prix</td>
        <td>Total par T-shirt</td>
        </tr>"
        ;
foreach($_SESSION["idArticle"] as $k => $v){
    $message .= "<tr><td>".$_SESSION["NomTshirt"][$k]."</td>
        <td>".$_SESSION["taille"][$k]."</td>
        <td>".$_SESSION["modele"][$k]."</td>
        <td>".$_SESSION["quantite"][$k]."X</td>
        <td>".$_SESSION["PrixTshirt"][$k]."€</td>
        <td>".$_SESSION["quantite"][$k]*$_SESSION["PrixTshirt"][$k]."€</td>
        </tr>";
}
$message .= "</table>
</body>
</html>";
$message = wordwrap($message, 70, "\r\n");
$headers = "MIME-Version: 1.0"."\r\n". 
"Content-type: text/html; charset=UTF-8"."\r\n". 
"From: contact@tshirtstore.com" . "\r\n" .
"Reply-To: contact@tshirtstore.com" . "\r\n" .
"X-Mailer: PHP/" . phpversion();

mail($to, $subject, $message, $headers);
if(!empty($_SESSION)){
    session_unset();
}

?>

</body>
</html>