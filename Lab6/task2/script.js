async function submitFormInsert(event) {
    
    event.preventDefault();
    
    const title = document.getElementById("title").value.trim();
    const note = document.getElementById("note").value.trim();
    
    if (!title || !note) {
        message.textContent = "Будь ласка, заповніть всі поля.(submitFormInsert)";
        message.style.color = "red";
        return;
    }
    
    const userData = { title, note };
    
    try {
        const response = await fetch("http://labs/Lab6/task2/insert.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(userData)
        })
        .then((response) => response.json())
        .then(data => {
            // Вивести повідомлення на сторінку
            document.getElementById('message').innerText = data.message;

            
        })
        .catch(error => console.log('Error:', error));
        
        
    } catch (error) {
        message.textContent = error.message;
    }
}



async function submitFormDelete(event){
        
    event.preventDefault();
    
    const id = document.getElementById("idNote").value.trim();
    
    
    if (!id) {
        message.textContent = "Будь ласка, вкажіть.";
        message.style.color = "red";
        return;
    }
    const deleteData = { id };
    
    try {
        const responseDelete = await fetch("http://labs/Lab6/task2/delete.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(deleteData)
        })
        .then((response) => response.json())
        .then(data => {
            // Вивести повідомлення на сторінку
            document.getElementById('message').innerText = data.message;
            
        })
        .catch(error => console.log('Error:', error));
        
    } catch (error) {
        message.textContent = error.message;
    }
}

document.getElementById("getAllNotes").addEventListener("click", function() {
    fetch("http://labs/Lab6/task2/getAllNotes.php") // Замість URL використовуйте адресу вашого API
        .then(response => response.json())
        .then(data => {
            

            const tableBody = document.getElementById("noteTableBody")
            const tableHead = document.getElementById("noteTable")
            
            tableBody.innerHTML = ""; // Очищаємо таблицю перед оновленням
            // console.log(data['title']);
            data.forEach(notes => {
                const row = document.createElement("tr");

                const idCell = document.createElement("td");
                idCell.textContent = notes.id;
                row.appendChild(idCell);

                const nameCell = document.createElement("td");
                nameCell.textContent = notes.title;
                row.appendChild(nameCell);

                const emailCell = document.createElement("td");
                emailCell.textContent = notes.note;
                row.appendChild(emailCell);

                tableBody.appendChild(row);

            });
        })
        .catch(error => {
            console.error("Помилка при завантаженні користувачів:", error);
        });
});