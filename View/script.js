document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    // Validation for Document Form
    form.addEventListener('submit', function (event) {
        let isValid = true;
        let errorMessages = [];

        const title = document.getElementById('titre').value.trim();
        if (title === '') {
            isValid = false;
            errorMessages.push('Title is required.');
            displayError('titre', 'Title is required.');
        } else if (title.length > 255) {
            isValid = false;
            errorMessages.push('Title must be less than 255 characters.');
            displayError('titre', 'Title must be less than 255 characters.');
        }

        const author = document.getElementById('auteur').value.trim();
        if (author === '') {
            isValid = false;
            errorMessages.push('Author is required.');
            displayError('auteur', 'Author is required.');
        } else if (!/^[a-zA-Z\s]+$/.test(author)) {
            isValid = false;
            errorMessages.push('Author name should only contain letters and spaces.');
            displayError('auteur', 'Author name should only contain letters and spaces.');
        }

        const publicationDate = document.getElementById('date_publication').value;
        if (publicationDate === '') {
            isValid = false;
            errorMessages.push('Publication date is required.');
            displayError('date_publication', 'Publication date is required.');
        } else if (new Date(publicationDate) > new Date()) {
            isValid = false;
            errorMessages.push('Publication date cannot be in the future.');
            displayError('date_publication', 'Publication date cannot be in the future.');
        }

        const category = document.getElementById('categorie').value.trim();
        if (category === '') {
            isValid = false;
            errorMessages.push('Category is required.');
            displayError('categorie', 'Category is required.');
        } else if (!/^[a-zA-Z\s]+$/.test(category)) {
            isValid = false;
            errorMessages.push('Category should only contain letters and spaces.');
            displayError('categorie', 'Category should only contain letters and spaces.');
        }

        const description = document.getElementById('description').value.trim();
        if (description === '') {
            isValid = false;
            errorMessages.push('Description is required.');
            displayError('description', 'Description is required.');
        }

        if (isValid === false) {
            event.preventDefault();
            displayErrorMessages(errorMessages);
        }
    });

    // Utility functions for validation error display
    function displayError(inputId, message) {
        const inputElement = document.getElementById(inputId);
        let errorElement = inputElement.nextElementSibling;
        if (!errorElement || !errorElement.classList.contains('error-message')) {
            errorElement = document.createElement('span');
            errorElement.classList.add('error-message');
            inputElement.after(errorElement);
        }
        errorElement.textContent = message;
        errorElement.style.color = 'red';
    }

    function displayErrorMessages(messages) {
        let summaryElement = document.getElementById('error-summary');
        if (!summaryElement) {
            summaryElement = document.createElement('div');
            summaryElement.id = 'error-summary';
            summaryElement.style.color = 'red';
            form.prepend(summaryElement);
        }

        summaryElement.innerHTML = '<strong>Please correct the following errors:</strong><ul>' +
            messages.map(message => `<li>${message}</li>`).join('') +
            '</ul>';
    }

    
});

