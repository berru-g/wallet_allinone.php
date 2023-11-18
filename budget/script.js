function calculerTotal(elementId, classe) {
  const elements = document.getElementsByClassName(classe);
  const total = Array.from(elements).reduce((acc, el) => acc + parseInt(el.value || 0), 0);
  document.getElementById(elementId).textContent = total;

  // Appel de la fonction pour mettre à jour la couleur du solde net
  mettreAJourCouleurSoldeNet();
}

function calculerSoldeNet() {
  const totalRevenus = parseInt(document.getElementById('total-revenus').textContent);
  const totalDepenses = parseInt(document.getElementById('total-depenses').textContent);
  const soldeNet = totalRevenus - totalDepenses;
  document.getElementById('solde-net').textContent = soldeNet;

  // Appel de la fonction pour mettre à jour la couleur du solde net
  mettreAJourCouleurSoldeNet();
}

function ajouterEcouteursEvenements() {
  const champsDepense = document.querySelectorAll('.depense');
  const champsRevenu = document.querySelectorAll('.revenu');

  champsDepense.forEach(champ => {
    champ.addEventListener('input', () => {
      calculerTotal('total-depenses', 'depense');
      calculerSoldeNet();
    });
  });

  champsRevenu.forEach(champ => {
    champ.addEventListener('input', () => {
      calculerTotal('total-revenus', 'revenu');
      calculerSoldeNet();
    });
  });
}

function mettreAJourCouleurSoldeNet() {
  const soldeNet = parseInt(document.getElementById('solde-net').textContent);
  const soldeNetElement = document.getElementById('solde-net');

  // Ajout ou suppression de la classe en fonction du solde net
  if (soldeNet < 0) {
    soldeNetElement.classList.remove('solde-positif');
    //document.querySelector('h2').style.color = 'lightgreen';
    soldeNetElement.classList.add('solde-negatif');
  } else {
    soldeNetElement.classList.remove('solde-negatif');
    soldeNetElement.classList.add('solde-positif');
  }
}

// Appeler cette fonction pour initialiser les écouteurs d'événements
ajouterEcouteursEvenements();