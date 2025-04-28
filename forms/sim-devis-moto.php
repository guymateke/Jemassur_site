<?php
    // Simulation assurance moto
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $typeMoto = $_POST['typeMoto'];
    $cylindree = $_POST['cylindree'];
    $anneeModele = $_POST['anneeModele'];
    $couverture = $_POST['couverture'];

    $to = "contact@jemassur.com"; // ← Remplace par ton adresse
    $subject = "Nouvelle simulation assurance moto";
    $message = "
        Nouvelle demande de devis pour assurance moto :

        Nom : $fullName
        Email : $email
        Téléphone : $phone

        Type de moto : $typeMoto
        Cylindrée : $cylindree cm³
        Année du modèle : $anneeModele
        Couverture souhaitée : $couverture
    ";
    $headers = "From: $email";

    if (mail($to, $subject, $message, $headers)) {
        echo "Votre demande a bien été envoyée.";
    } else {
        echo "Une erreur est survenue lors de l'envoi du message.";
    }

?>