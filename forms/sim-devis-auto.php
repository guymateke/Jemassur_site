<?php
// Vérification de la méthode
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération et nettoyage des données
    $fullName       = htmlspecialchars(trim($_POST['fullName']));
    $email          = htmlspecialchars(trim($_POST['email']));
    $phone          = htmlspecialchars(trim($_POST['phone']));
    $typeVehicule   = htmlspecialchars(trim($_POST['typeVehicule']));
    $usage          = htmlspecialchars(trim($_POST['usage']));
    $anneeCirculation = htmlspecialchars(trim($_POST['anneeCirculation']));
    $bonusMalus     = htmlspecialchars(trim($_POST['bonusMalus']));

    // Validation basique (champ vide)
    if (
        empty($fullName) || empty($email) || empty($phone) || empty($typeVehicule) ||
        empty($usage) || empty($anneeCirculation) || empty($bonusMalus)
    ) {
        echo "Veuillez remplir tous les champs.";
        exit;
    }

    // Préparation du message
    $to = "contact@jemassur.fr"; // ← Adresse à modifier
    $subject = "Nouveau devis auto depuis le site Jemassur";
    $message = "
    Nom complet : $fullName\n
    Email : $email\n
    Téléphone : $phone\n
    Type de véhicule : $typeVehicule\n
    Usage : $usage\n
    Année de mise en circulation : $anneeCirculation\n
    Bonus / Malus : $bonusMalus
    ";
    $headers = "From: $email";

    // Envoi de l'email
    if (mail($to, $subject, $message, $headers)) {
        echo "Votre demande de devis a bien été envoyée. Nous vous contacterons rapidement.";
    } else {
        echo "Une erreur s’est produite lors de l’envoi. Veuillez réessayer.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
