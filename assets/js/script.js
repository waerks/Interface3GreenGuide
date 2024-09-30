// RECETTE AJOUT
document.addEventListener("DOMContentLoaded", function() {
    // Utiliser querySelectorAll pour sélectionner tous les boutons avec la classe 'addEtapeBtn'
    document.querySelectorAll('.addIngredientBtn').forEach(function(button) {
        button.addEventListener('click', addIngredient);
    });
    document.querySelectorAll('.addEtapeBtn').forEach(function(button) {
        button.addEventListener('click', addEtape);
    });
});


function addIngredient() {
    var container = document.getElementById('ingredientsContainer');
    var inputs = container.getElementsByTagName('input');

    // Vérifier si le dernier champ d'entrée est vide
    if (inputs.length > 0 && inputs[inputs.length - 1].value.trim() === "") {
        alert("Veuillez remplir le champ d'ingrédient précédent avant d'en ajouter un nouveau.");
        return; // Ne pas ajouter un nouvel ingrédient
    }

    // Créer un nouvel élément de conteneur pour l'ingrédient
    var ingredientDiv = document.createElement('div');
    ingredientDiv.className = 'ingredient-item'; // Ajouter une classe pour le style

    var input = document.createElement('input');
    input.type = 'text';
    input.name = 'ajoutIngre[]'; // Utiliser le même nom pour le tableau d'ingrédients
    input.className = 'input'; // Ajouter la classe pour le style

    // Créer le bouton de suppression
    var deleteBtn = document.createElement('span');
    deleteBtn.innerHTML = '🗑️'; // Emoji poubelle
    deleteBtn.className = 'delete-btn'; // Ajouter une classe pour le style
    deleteBtn.style.cursor = 'pointer'; // Changer le curseur en pointeur
    deleteBtn.onclick = function() {
        container.removeChild(ingredientDiv); // Supprimer l'élément même si c'est le premier
    };

    // Ajouter le champ d'ingrédient et le bouton de suppression au conteneur
    ingredientDiv.appendChild(input);
    ingredientDiv.appendChild(deleteBtn);
    container.appendChild(ingredientDiv);
}

function addEtape() {
    var container = document.getElementById('etapesContainer');
    var textareas = container.getElementsByTagName('textarea');

    // Vérifier si le dernier champ de texte est vide
    if (textareas.length > 0 && textareas[textareas.length - 1].value.trim() === "") {
        alert("Veuillez remplir le champ d'étape précédent avant d'en ajouter une nouvelle.");
        return; // Ne pas ajouter une nouvelle étape
    }

    // Créer un nouvel élément de conteneur pour l'étape
    var etapeDiv = document.createElement('div');
    etapeDiv.className = 'etape-item'; // Ajouter une classe pour le style

    var textarea = document.createElement('textarea');
    textarea.name = 'etape[]'; // Utiliser le même nom pour le tableau d'étapes
    textarea.className = 'input'; // Ajouter la classe pour le style

    // Créer le bouton de suppression
    var deleteBtn = document.createElement('span');
    deleteBtn.innerHTML = '🗑️'; // Emoji poubelle
    deleteBtn.className = 'delete-btn'; // Ajouter une classe pour le style
    deleteBtn.style.cursor = 'pointer'; // Changer le curseur en pointeur
    deleteBtn.onclick = function() {
        container.removeChild(etapeDiv); // Supprimer l'élément même si c'est le premier
    };

    // Ajouter la description de l'étape et le bouton de suppression au conteneur
    etapeDiv.appendChild(textarea);
    etapeDiv.appendChild(deleteBtn);
    container.appendChild(etapeDiv);
}

console.log("JS fonctionnel.");