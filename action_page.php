<?php

$errors = [];

if (!empty($_POST)) {
  $subject = $_POST['subject'];
  $email = $_POST['email'];
 
  if (empty($subject)) {
      $errors[] = 'Vous n'avez pas entré de message !';
  }

  if (empty($email)) {
      $errors[] = 'L\'email est vide.';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'L\'email est invalide.';
  }
}

    // Si pas d'erreurs, envoyer l'email
    if (empty($errors)) {
        // Adresse email du destinataire (remplacez par la vôtre)
        $recipient = "martin.fontbonne@proton.me";

        // En-têtes supplémentaires
        $headers = "De : <$email>";

        // Envoyer l'email
        if (mail($recipient, $subject, $headers)) {
            echo "Email envoyé avec succès !";
        } else {
            echo "Échec de l'envoi de l'email. Veuillez réessayer plus tard.";
        }
    } else {
        // Afficher les erreurs
        echo "Le formulaire contient les erreurs suivantes :<br>";
        foreach ($errors as $error) {
            echo "- $error<br>";
        }
    }
} else {
    // Pas une requête POST, afficher une erreur 403 forbidden
    header("HTTP/1.1 403 Forbidden");
    echo "Vous n'êtes pas autorisé à accéder à cette page.";
}
?>