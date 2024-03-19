document.getElementById("add_offre").addEventListener("click", function() {
  console.log("Bouton 'Ajouter offre' cliqué"); // Message de débogage
  document.getElementById("nouvelle-offre").classList.remove("hidden");
});


document.getElementById("form-offre").addEventListener("submit", function(event) {
  event.preventDefault(); // Empêche le rechargement de la page lors de la soumission du formulaire
  
  // Récupère les valeurs des champs du formulaire
  var titre = document.getElementById("titre").value;
  var rh = document.getElementById("rh").value;
  var lieu = document.getElementById("lieu").value;
  var date = document.getElementById("date").value;
  var description = document.getElementById("description").value;

  console.log("Titre:", titre); // Message de débogage
  console.log("RH:", rh); // Message de débogage
  console.log("Lieu:", lieu); // Message de débogage
  console.log("Date:", date); // Message de débogage
  console.log("Description:", description); // Message de débogage

  // Crée une nouvelle offre au format HTML
  var nouvelleOffreHTML = `
      <li class="offre">
          <div class="offre-frame">
              <h3>${titre}</h3>
              <p>RH: ${rh}</p>
              <p>Lieu: ${lieu}</p>
              <p>Date: ${date}</p>
              <p><strong>Description:</strong> ${description}</p>
          </div>
      </li>
  `;

  console.log("Nouvelle offre HTML:", nouvelleOffreHTML); // Message de débogage

  // Insère la nouvelle offre au début de la liste des offres
  document.getElementById("offres-list").insertAdjacentHTML("afterbegin", nouvelleOffreHTML);

  // Réinitialise les champs du formulaire
  document.getElementById("form-offre").reset();

  // Cache le formulaire après l'ajout de l'offre
  document.getElementById("nouvelle-offre").classList.add("hidden");
});
