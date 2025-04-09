<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$nom = $_POST['nom'] ?? '';
$prenom = $_POST['prenom'] ?? '';
$telephone = $_POST['telephone'] ?? '';
$email = $_POST['email'] ?? 'Non renseigné';
$heure = $_POST['heure'] ?? 'Non précisée';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'tonemail@gmail.com';
    $mail->Password = 'motdepasse';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('tonemail@gmail.com', 'Formulaire Rappel');
    $mail->addAddress('destinataire@tonsite.com');

    $mail->isHTML(true);
    $mail->Subject = "Demande de rappel - $prenom $nom";
    $mail->Body = "
        <h3>Nouvelle demande de rappel :</h3>
        <p><strong>Nom :</strong> $nom</p>
        <p><strong>Prénom :</strong> $prenom</p>
        <p><strong>Téléphone :</strong> $telephone</p>
        <p><strong>Email :</strong> $email</p>
        <p><strong>Heure souhaitée :</strong> $heure</p>
    ";

    $mail->send();
    echo "Votre demande a bien été envoyée.";
} catch (Exception $e) {
    echo "Erreur lors de l'envoi : " . $mail->ErrorInfo;
}
?>
