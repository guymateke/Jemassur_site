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
    http_response_code(200);
    echo "OK"; // <<< ici aussi, on renvoie "OK"
} else {
    http_response_code(500);
    echo "Erreur serveur. Veuillez réessayer.";
}
?>
