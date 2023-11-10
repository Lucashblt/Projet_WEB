
function toggleEditMode(elementId, type) {
    const displayDiv = document.getElementById(`display-${type}-${elementId}`);
    const editDiv = document.getElementById(`edit-${type}-${elementId}`);

    if (displayDiv.style.display === 'none') {
        const newName = document.getElementById(`input-${type}-${elementId}`).value;
        updateName(elementId, newName, type);
    } else {
        displayDiv.style.display = 'none';
        editDiv.style.display = 'block';
    }
}

function updateName(elementId, newName, type) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'renommer_element.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        if (this.status == 200) {
            const response = this.responseText;
            if (response === 'Mise à jour réussie') {
                document.getElementById(`display-${type}-${elementId}`).textContent = newName;
                toggleEditMode(elementId, type);
            } else {
                alert('Erreur : la mise à jour n\'a pas été confirmée.');
            }
        }
    };

    xhr.send(`id=${elementId}&nouveauNom=${encodeURIComponent(newName)}&type=${type}`);
}

function confirmDelete(elementId, type) {
    if (confirm("Êtes-vous sûr de vouloir effacer ce catalogue ?")) {
        deleteElement(elementId, type);
    }
}

function deleteElement(elementId, type) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'effacer_element.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        if (this.status == 200) {
            const response = this.responseText;
            if (response === 'Effacement réussi') {
                location.reload();
            } else {
                alert('Erreur : l\'effacement n\'a pas été confirmé.');
            }
        }
    };

    xhr.send(`id=${elementId}&type=${type}`);
}

document.addEventListener("DOMContentLoaded", function() {
    const toggleFormButton = document.getElementById("toggle-form-button");
    const createCatalogueForm = document.getElementById("create-catalogue-form");

    toggleFormButton.addEventListener("click", function() {
        // Inversez la visibilité du formulaire
        if (createCatalogueForm.style.display === "none") {
            createCatalogueForm.style.display = "block";
        } else {
            createCatalogueForm.style.display = "none";
        }
    });
});

function toggleFormVisibility() {
    const form = document.getElementById('create-catalogue-form');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
    const errorMessage = document.getElementById('error-message');
    errorMessage.style.display = 'none'; // Masquer le message d'erreur
}

document.getElementById('toggle-form-button').addEventListener('click', toggleFormVisibility);

document.getElementById('create-catalogue-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Empêcher la soumission du formulaire par défaut

    const form = this;
    const formData = new FormData(form);

    fetch('creer_catalogue.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        if (result === 'Succès') {
            // Réinitialiser le formulaire et masquer le message d'erreur
            form.reset();
            const errorMessage = document.getElementById('error-message');
            errorMessage.style.display = 'none';
        } else {
            // Afficher le message d'erreur reçu du serveur
            const errorMessage = document.getElementById('error-message');
            errorMessage.textContent = result;
            errorMessage.style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
});
