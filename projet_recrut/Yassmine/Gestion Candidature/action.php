<?php

// Accéder aux données JSON envoyées par la requête
$data = json_decode(file_get_contents('php://input'), true);

// Extraire l'ID et l'action de l'offre
$offre_id = $data['id'];
$action = $data['action'];

// Traiter l'action
if ($action === 'accept') {
  // Accepter l'offre en base de données
  // ...

  echo json_encode(['success' => true]);
} else if ($action === 'refuse') {
  // Refuser l'offre en base de données
  // ...

  echo json_encode(['success' => true]);
} else {
  // Action invalide
  echo json_encode(['error' => 'Action invalide']);
}

?>
