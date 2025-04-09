<?php
// Adresse email du destinataire
$to = "contact@jemassur.com"; 

// Récupération des données du formulaire
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? 'Nouveau message depuis le site';
$message = $_POST['message'] ?? '';

// Validation de base
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Adresse email invalide.";
    exit;
}

// Préparation du contenu de l’email
$email_content = "Vous avez reçu un nouveau message via le formulaire de contact :\n\n";
$email_content .= "Nom : $name\n";
$email_content .= "Email : $email\n";
$email_content .= "Sujet : $subject\n";
$email_content .= "Message :\n$message\n";

// En-têtes email
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";

// Envoi de l’email
if (mail($to, $subject, $email_content, $headers)) {
    echo "Votre message a bien été envoyé. Merci !";
} else {
    http_response_code(500);
    echo "Une erreur est survenue, veuillez réessayer plus tard.";
}
?>
