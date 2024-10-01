document.addEventListener('DOMContentLoaded', function () {
    // Ingredients
    let collectionHolderIngredients = document.querySelector('.ingredients');
    let addIngredientButton = document.createElement('button');
    addIngredientButton.textContent = 'Ajouter un ingrédient';
    addIngredientButton.id = 'secondBtn';
    collectionHolderIngredients.appendChild(addIngredientButton);

    addIngredientButton.addEventListener('click', function (e) {
        e.preventDefault();
        addFormField(collectionHolderIngredients, 'ingredient-item');
    });

    // Etapes (Steps)
    let collectionHolderEtapes = document.querySelector('.etapes');
    let addEtapeButton = document.createElement('button');
    addEtapeButton.textContent = 'Ajouter une étape';
    addEtapeButton.id = 'secondBtn';
    collectionHolderEtapes.appendChild(addEtapeButton);

    addEtapeButton.addEventListener('click', function (e) {
        e.preventDefault();
        addFormField(collectionHolderEtapes, 'etape-item');
    });

    // Function to add a form field dynamically
    function addFormField(collectionHolder, itemClass) {
        let prototype = collectionHolder.dataset.prototype;
        let newForm = prototype.replace(/__name__/g, collectionHolder.dataset.index);
        collectionHolder.dataset.index++;

        let newFormDiv = document.createElement('div');
        newFormDiv.classList.add(itemClass);
        newFormDiv.innerHTML = newForm;

        let inputField = newFormDiv.querySelector('input');
        if (inputField) {
            inputField.className = "input";
        }

        // Add a remove button
        let removeButton = document.createElement('button');
        removeButton.textContent = '🗑️';
        removeButton.className = "remove";
        newFormDiv.appendChild(removeButton);

        removeButton.addEventListener('click', function (e) {
            e.preventDefault();
            newFormDiv.remove();
        });

        collectionHolder.appendChild(newFormDiv);
    }
});