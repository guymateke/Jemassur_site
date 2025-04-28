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
    echo "Invalid email address.";
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
    http_response_code(200);
    echo "OK"; // <<< Répond juste "OK"
} else {
    http_response_code(500);
    echo "Erreur serveur. Veuillez réessayer plus tard.";
}
?>

