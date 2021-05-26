<?php
include('Head.php');
?>
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
        <table>";
        // <tr>
        // <td>nom du t-shirt</td>
        // <td>Taille du t-shirt</td>
        // <td>Modele du t-shirt</td>
        // <td>Quantite commandé</td> 
        // <td>prix total</td>
        // </tr>
        ;
foreach($_SESSION["idArticle"] as $k => $v){
    $message .= "<tr><td>".$_SESSION["NomTshirt"][$k]."</td>
        <td>".$_SESSION["taille"][$k]."</td>
        <td>".$_SESSION["modele"][$k]."</td>
        <td>".$_SESSION["quantite"][$k]."X</td>
        <td>".$_SESSION["PrixTshirt"][$k]."€</td>
        <td>".$_SESSION["totalParArticle"][$k]."€</td>
        </tr>"; //nom t-shirt et prixpart-shirt n'existent pas
}
$message .= "</table>
</body>
</html>";
echo $message;
$message = wordwrap($message, 70, "\r\n");
$headers = "MIME-Version: 1.0"."\r\n". 
"Content-type: text/html; charset=iso-8859-1"."\r\n". 
"From: webmaster@example.com" . "\r\n" .
"Reply-To: webmaster@example.com" . "\r\n" .
"X-Mailer: PHP/" . phpversion();

mail($to, $subject, $message, $headers);
if(!empty($_SESSION)){
    session_unset();
}
?>

</body>
</html>