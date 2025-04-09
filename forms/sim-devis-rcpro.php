<?php

// Simulation RC Pro
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $secteur = $_POST['secteur'];
    $ca = $_POST['ca'];
    $employes = $_POST['employes'];
    $couverture = $_POST['couverture'];

    $to = "ton-email@domaine.com"; // ← Remplace par ton adresse email
    $subject = "Nouvelle simulation RC Pro";
    $message = "
        Nouvelle demande de devis RC Pro :

        Nom : $fullName
        Email : $email
        Téléphone : $phone

        Secteur d'activité : $secteur
        Chiffre d’affaires annuel : $ca
        Nombre d’employés : $employes
        Niveau de couverture : $couverture
    ";
    $headers = "From: $email";

    if (mail($to, $subject, $message, $headers)) {
        echo "Votre demande a bien été envoyée.";
    } else {
        echo "Une erreur est survenue lors de l'envoi du message.";
    }
?>