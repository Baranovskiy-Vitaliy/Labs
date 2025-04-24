// script.js

async function submitFormInsert(event) {
    
    event.preventDefault();
    
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const message = document.getElementById("message");
    
    if (!name || !email || !password) {
        message.textContent = "Будь ласка, заповніть всі поля.(submitFormInsert)";
        message.style.color = "red";
        return;
    }
    
    const userData = { name, email, password };
    
    try {
        const response = await fetch("http://labs/Lab6/task1/insert.php", {
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

document.getElementById("getAllUsers").addEventListener("click", function() {
    fetch("http://labs/Lab6/task1/getAllUsers.php") // Замість URL використовуйте адресу вашого API
        .then(response => response.json())
        .then(data => {
            document.getElementById("userTable").style.display = "block"; // Показуємо таблицю

            const tableBody = document.getElementById("userTableBody")
            const tableHead = document.getElementById("userTable")
            
            tableBody.innerHTML = ""; // Очищаємо таблицю перед оновленням
            console.log(data['name']);
            data.forEach(users => {
                const row = document.createElement("tr");
                const nameCell = document.createElement("td");
                nameCell.textContent = users.name;
                row.appendChild(nameCell);

                const emailCell = document.createElement("td");
                emailCell.textContent = users.email;
                row.appendChild(emailCell);

                tableBody.appendChild(row);

            });
        })
        .catch(error => {
            console.error("Помилка при завантаженні користувачів:", error);
        });
});

async function submitFormLogin(event){
        
        event.preventDefault();
        
        const loginEmail = document.getElementById("loginEmail").value.trim();
        const loginPassword = document.getElementById("loginPassword").value.trim();
        
        
        if (!email || !password) {
            message.textContent = "Будь ласка, заповніть всі поля.";
            message.style.color = "red";
            return;
        }
        const loginUserData = { loginEmail, loginPassword };
        document.getElementById('test').innerText = loginEmail + loginPassword; // Вивести дані на сторінку для перевірки
        try {
            const responseLogin = await fetch("http://labs/Lab6/task1/login.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(loginUserData)
            })
            .then((response) => response.json())
            .then(data => {
                // Вивести повідомлення на сторінку
                document.getElementById('message').innerText = data.message;
                if(data.message != "Неправильний email або пароль"){
                
                document.getElementById('formLogin').style.display = "none"; // Сховати форму входу
                document.getElementById('log').style.display = "none"; 
                document.getElementById('exit').style.display = "block"; // Показати кнопку виходу
                document.getElementById('deleteUser').style.display = "block"; // Показати кнопку видалення
                }
            })
            .catch(error => console.log('Error:', error));
            
        } catch (error) {
            message.textContent = error.message;
        }
}

document.getElementById("exit").addEventListener("click", function() {
    
    document.getElementById('exit').style.display = "none"; // Сховати кнопку виходу
    document.getElementById('deleteUser').style.display = "none"; // Сховати кнопку видалення
    document.getElementById('formLogin').style.display = "block"; // Показати форму входу
    document.getElementById('log').style.display = "block"; 
    
    document.getElementById('message').innerText = "Ви вийшли з системи."; // Показати повідомлення про вихід
});

document.getElementById("deleteUser").addEventListener("click", function() {
    const loginEmail = document.getElementById("loginEmail").value.trim();

        const deleteUserData = { loginEmail };
        document.getElementById('test').innerText = loginEmail; // Вивести дані на сторінку для перевірки
        fetch("http://labs/Lab6/task1/delete.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(deleteUserData)
        })
        .then(response => response.json())
        .then(data => {
            // Вивести повідомлення на сторінку
            document.getElementById('message').innerText = data.message;
            
                document.getElementById('exit').style.display = "none"; // Сховати кнопку виходу
                document.getElementById('deleteUser').style.display = "none"; // Сховати кнопку видалення
                document.getElementById('formLogin').style.display = "block"; // Показати форму входу
                document.getElementById('log').style.display = "block"; 
            
            
        })
        .catch(error => console.log('Error:', error));
    });