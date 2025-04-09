<?php
// Configuration : ton adresse email
$destinataire = "contact@jemassur.com"; // <-- Remplace avec ton email

// Vérifie si le formulaire a été soumis via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération sécurisée des champs
    $nom = htmlspecialchars(trim($_POST["fullName"] ?? ''));
    $email = htmlspecialchars(trim($_POST["email"] ?? ''));
    $telephone = htmlspecialchars(trim($_POST["phone"] ?? ''));

    // Champs spécifiques décennale
    $activite = htmlspecialchars(trim($_POST["activite"] ?? ''));
    $chiffreAffaire = htmlspecialchars(trim($_POST["chiffreAffaire"] ?? ''));
    $nbEmployes = htmlspecialchars(trim($_POST["nbEmployes"] ?? ''));
    $anciennete = htmlspecialchars(trim($_POST["anciennete"] ?? ''));

    // Validation basique (peut être améliorée)
    if (empty($nom) || empty($email) || empty($telephone) || empty($activite)) {
        echo "Veuillez remplir tous les champs obligatoires.";
        exit;
    }

    // Sujet de l'email
    $sujet = "Demande de devis décennale - $nom";

    // Contenu du message
    $message = "
    Nouvelle demande de devis décennale :

    Nom complet : $nom
    Email : $email
    Téléphone : $telephone

    Type d’activité : $activite
    Chiffre d’affaires annuel : $chiffreAffaire €
    Nombre d’employés : $nbEmployes
    Ancienneté de l’entreprise : $anciennete ans
    ";

    // En-têtes de l'email
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    // Envoi de l'email
    if (mail($destinataire, $sujet, $message, $headers)) {
        echo "Merci, votre demande a bien été envoyée. Nous vous contacterons rapidement.";
    } else {
        echo "Une erreur est survenue lors de l'envoi. Veuillez réessayer plus tard.";
    }
} else {
    // Si le fichier est accédé sans POST
    echo "Accès non autorisé.";
}
?>
