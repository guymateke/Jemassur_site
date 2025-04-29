<?php
// Configuration
$destinataire = "recrutement@jemassur.fr"; // Remplace par ton email
$maxFileSize = 5 * 1024 * 1024; // 5 Mo
$allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

// Récupération des données
$nom = htmlspecialchars($_POST['nom'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$message = htmlspecialchars($_POST['message'] ?? '');

// Vérification basique
if (!$nom || !$email || !$message || !isset($_FILES['cv'])) {
    die("Tous les champs sont requis.");
}

// Traitement du fichier
$file = $_FILES['cv'];

if ($file['error'] !== UPLOAD_ERR_OK) {
    die("Erreur lors du téléchargement du fichier.");
}

if (!in_array($file['type'], $allowedTypes)) {
    die("Type de fichier non autorisé.");
}

if ($file['size'] > $maxFileSize) {
    die("Le fichier dépasse la taille maximale autorisée (5 Mo).");
}

// Préparation de l'e-mail
$boundary = md5(uniqid());
$headers = "From: $nom <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

$cvContent = chunk_split(base64_encode(file_get_contents($file['tmp_name'])));

$messageEmail = "--$boundary\r\n";
$messageEmail .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n\r\n";
$messageEmail .= "Nom: $nom\nEmail: $email\n\nMessage:\n$message\n\n--$boundary\r\n";

$messageEmail .= "Content-Type: " . $file['type'] . "; name=\"" . $file['name'] . "\"\r\n";
$messageEmail .= "Content-Transfer-Encoding: base64\r\n";
$messageEmail .= "Content-Disposition: attachment; filename=\"" . $file['name'] . "\"\r\n\r\n";
$messageEmail .= $cvContent . "\r\n--$boundary--";

// Envoi
$success = mail($destinataire, "Nouvelle candidature ou proposition - Jemassur", $messageEmail, $headers);

if ($success) {
    echo "Merci ! Votre message a bien été envoyé.";
} else {
    echo "Erreur lors de l'envoi. Veuillez réessayer plus tard.";
}
?>
