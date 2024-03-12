const searchInput = document.getElementById("keyword");
const offresList = document.getElementById("offres-list");
const offres = offresList.getElementsByClassName("offre");


function filterOffres(e) {
  e = e.toLowerCase().trim();
  Array.from(offres).forEach((offre) => {
    const title = offre.querySelector("h3").textContent.toLowerCase();
    const description = offre
      .querySelector("p:nth-child(5)")
      .textContent.toLowerCase();
    if (title.includes(e) || description.includes(e)) {
      offre.style.display = "block";
    } else {
      offre.style.display = "none";
    }
  });
}


searchInput.addEventListener("input", () => {
  const query = searchInput.value;
  filterOffres(query);
});
