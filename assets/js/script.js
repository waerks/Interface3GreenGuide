document.addEventListener('DOMContentLoaded', function () {
    let collectionHolder = document.querySelector('ul.ingredients');
    let addIngredientButton = document.createElement('button');
    addIngredientButton.textContent = 'Add Ingredient';
    collectionHolder.appendChild(addIngredientButton);

    let newLinkLi = document.createElement('li');
    collectionHolder.appendChild(newLinkLi);

    addIngredientButton.addEventListener('click', function (e) {
        e.preventDefault();
        addIngredientForm(collectionHolder, newLinkLi);
    });

    function addIngredientForm(collectionHolder, newLinkLi) {
        // Get the data-prototype
        let prototype = collectionHolder.dataset.prototype;

        // Replace '__name__' in the prototype's HTML to create unique field IDs
        let newForm = prototype.replace(/__name__/g, collectionHolder.dataset.index);

        // Increment the index for the next item
        collectionHolder.dataset.index++;

        // Create a new form and append it to the list
        let newFormLi = document.createElement('li');
        newFormLi.innerHTML = newForm;
        newLinkLi.before(newFormLi);

        
        // Add a button to remove the field
        let removeButton = document.createElement('button');
        removeButton.textContent = 'Remove Ingredient';
        newFormLi.appendChild(removeButton);

        removeButton.addEventListener('click', function (e) {
            e.preventDefault();
            newFormLi.remove();
        });
    }
});
