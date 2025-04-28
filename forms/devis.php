<?php
// Configuration
$to = "contact@jemassur.com"; 
$subject = "Nouvelle demande de devis assurance";

// Récupération des données du formulaire
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$type_assurance = $_POST['type_assurance'] ?? '';
$message = $_POST['message'] ?? '';
$date_effet = $_POST['date'] ?? '';

// Validation simple
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Adresse email invalide.";
    exit;
}

// Contenu de l'email
$email_content = "Nouvelle demande de devis :\n\n";
$email_content .= "Nom complet : $name\n";
$email_content .= "Email : $email\n";
$email_content .= "Téléphone : $phone\n";
$email_content .= "Type d'assurance : $type_assurance\n";
$email_content .= "Date d'effet souhaitée : $date_effet\n";
$email_content .= "Message :\n$message\n";

// En-têtes
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";

// Envoi de l'email
if (mail($to, $subject, $email_content, $headers)) {
    http_response_code(200);
    echo "OK"; // <<< ici aussi on renvoie juste "OK" !
} else {
    http_response_code(500);
    echo "Erreur serveur. Veuillez réessayer plus tard.";
}
?>
