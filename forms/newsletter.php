<?php
$to = "contact@jemassur.fr"; 
$subject = "Nouvel abonnement à la newsletter";

// Récupération de l'email
$email = $_POST['email'] ?? '';

// Vérification de la validité de l’email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Email invalide.";
    exit;
}

// Contenu de l'email
$message = "Nouvel abonnement à la newsletter :\n\n";
$message .= "Email : $email\n";

// En-têtes
$headers = "From: Newsletter <$email>\r\n";
$headers .= "Reply-To: $email\r\n";

// Envoi de l'email
if (mail($to, $subject, $message, $headers)) {
    echo "Votre abonnement a bien été pris en compte.";
} else {
    http_response_code(500);
    echo "Une erreur est survenue lors de l'envoi.";
}
?>
