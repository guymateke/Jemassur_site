<?php
// Paramètres de destination
$to = "tonemail@domaine.com"; // 🔁 Remplace par ton adresse mail de réception
$subject = "Nouvelle demande de devis depuis le site Jemassur";

// Sécurisation des données
$fullName = htmlspecialchars($_POST['fullName']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);

// Détection du type de formulaire soumis
if (isset($_POST['typeLogement'])) {
    // Formulaire Habitation
    $typeLogement = htmlspecialchars($_POST['typeLogement']);
    $surface = htmlspecialchars($_POST['surface']);
    $valeurBiens = htmlspecialchars($_POST['valeurBiens']);
    $couverture = htmlspecialchars($_POST['couverture']);

    $message = "
    <h2>Demande de Devis - Assurance Habitation</h2>
    <p><strong>Nom :</strong> $fullName</p>
    <p><strong>Email :</strong> $email</p>
    <p><strong>Téléphone :</strong> $phone</p>
    <hr>
    <p><strong>Type de logement :</strong> $typeLogement</p>
    <p><strong>Surface :</strong> $surface m²</p>
    <p><strong>Valeur des biens :</strong> $valeurBiens €</p>
    <p><strong>Couverture souhaitée :</strong> $couverture</p>
    ";
}
// Tu peux dupliquer cette logique pour auto-détecter les autres types (Décennale, Auto, etc.),
// avec des `elseif` selon les champs spécifiques (ex: $_POST['typeActivite'], etc.)

// Headers email HTML
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: <$email>" . "\r\n";

// Envoi de l'email
if (mail($to, $subject, $message, $headers)) {
    echo "<h3>Merci ! Votre demande a bien été envoyée. Nous vous contacterons rapidement.</h3>";
} else {
    echo "<h3>Erreur lors de l'envoi. Veuillez réessayer plus tard.</h3>";
}
?>
