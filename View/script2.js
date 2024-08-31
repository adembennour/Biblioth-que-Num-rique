document.addEventListener('DOMContentLoaded', () => {
    // Sample data to populate tables
    const documents = [
        { title: 'The Great Gatsby', author: 'F. Scott Fitzgerald', publicationDate: '1925-04-10', category: 'Classic', description: 'A novel set in the Jazz Age' },
        { title: 'To Kill a Mockingbird', author: 'Harper Lee', publicationDate: '1960-07-11', category: 'Classic', description: 'A novel about racial injustice' },
        { title: 'Pride and Prejudice', author: 'Jane Austen', publicationDate: '1813-01-28', category: 'Romance', description: 'A novel about love and societal expectations' },
    ];

    const history = [
        { title: 'The Great Gatsby', dateBorrowed: '2024-01-15', dueDate: '2024-01-29', status: 'Returned' },
        { title: 'Moby-Dick', dateBorrowed: '2024-02-10', dueDate: '2024-02-24', status: 'Overdue' }
    ];

    const docTableBody = document.querySelector('.available-documents tbody');
    const historyTableBody = document.querySelector('.borrowing-history tbody');

    // Populate Available Documents table
    documents.forEach(doc => {
        const row = `<tr>
            <td>${doc.title}</td>
            <td>${doc.author}</td>
            <td>${doc.publicationDate}</td>
            <td>${doc.category}</td>
            <td>${doc.description}</td>
            <td><button class="borrow-button">Borrow</button></td>
        </tr>`;
        docTableBody.innerHTML += row;
    });

    // Populate Borrowing History table
    history.forEach(entry => {
        const row = `<tr>
            <td>${entry.title}</td>
            <td>${entry.dateBorrowed}</td>
            <td>${entry.dueDate}</td>
            <td>${entry.status}</td>
        </tr>`;
        historyTableBody.innerHTML += row;
    });

    // Example of adding interaction to the borrow buttons
    const borrowButtons = document.querySelectorAll('.borrow-button');
    borrowButtons.forEach(button => {
        button.addEventListener('click', () => {
            alert('You have borrowed this document!');
        });
    });
});
