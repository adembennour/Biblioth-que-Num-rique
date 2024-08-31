document.addEventListener('DOMContentLoaded', () => {
    
    // Prompt the user for their name
    let emprunteur = prompt("Please enter your name:");

    if (emprunteur) {
        // Update the welcome message
        document.getElementById('welcome-message').innerHTML = `Welcome to LibraPlus, ${emprunteur}`;

        // Make an AJAX call to get the borrowing history
        fetch(`../Controller/EmpruntController.php?action=listEmpruntsByEmprunteur&emprunteur=${emprunteur}`)
            .then(response => response.text())
            .then(data => {
                // Insert the fetched history into the history-table div
                document.getElementById('history-table').innerHTML = data;
            })
            .catch(error => console.error('Error fetching borrowing history:', error));
    } else {
        alert('Name is required to view your borrowing history.');
    }


    // Example of adding interaction to the borrow buttons
    const borrowButtons = document.querySelectorAll('.borrow-button');
    borrowButtons.forEach(button => {
        button.addEventListener('click', () => {
            alert('You have borrowed this document!');
        });
    });
});
