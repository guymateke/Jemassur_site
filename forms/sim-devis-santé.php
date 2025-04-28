<?php
// Simulation Santé
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $beneficiaires = $_POST['beneficiaires'];
    $couverture = $_POST['couverture'];
    $regime = $_POST['regime'];

    $to = "contact@jemassur.com"; // ← à personnaliser
    $subject = "Nouvelle simulation Santé";
    $message = "
        Nouvelle demande de devis Santé :

        Nom : $fullName
        Email : $email
        Téléphone : $phone

        Âge de l'assuré : $age
        Nombre de bénéficiaires : $beneficiaires
        Type de couverture : $couverture
        Régime de Sécurité Sociale : $regime
    ";
    $headers = "From: $email";

    if (mail($to, $subject, $message, $headers)) {
        echo "Votre demande a bien été envoyée.";
    } else {
        echo "Une erreur est survenue lors de l'envoi du message.";
    }

?>