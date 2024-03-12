const buttons = document.querySelectorAll('.btn');

buttons.forEach(button => {
  button.addEventListener('click', () => {
    const id = button.dataset.id;
    const action = button.dataset.action;

    // Envoyer une requête HTTP au backend avec l'id et l'action
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/api/offres/action');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(`id=${id}&action=${action}`);

    // Gérer la réponse du backend
    xhr.onload = () => {
      if (xhr.status === 200) {
        // La requête a réussi
        // Mettre à jour l'interface en conséquence
      } else {
        // La requête a échoué
        // Afficher un message d'erreur
      }
    };
  });
});
