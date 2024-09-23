// RECETTE AJOUT
function addIngredient() {
    var container = document.getElementById('ingredientsContainer');
    var input = document.createElement('input');
    input.type = 'text';
    input.name = 'ajoutIngre[]';
    container.appendChild(input);
}

function addEtape() {
    var container = document.getElementById('etapesContainer');
    var textarea = document.createElement('textarea');
    textarea.name = 'etape[]';
    container.appendChild(textarea);
}