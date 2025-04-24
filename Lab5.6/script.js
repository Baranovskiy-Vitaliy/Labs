document.addEventListener("DOMContentLoaded", () => {
    const registerForm = document.getElementById("registerForm");
    const loginForm = document.getElementById("loginForm");
    const loadUsersButton = document.getElementById("loadUsers");
    const userList = document.getElementById("userList");

    // Обробка реєстрації
    registerForm.addEventListener("submit", async (event) => {
        event.preventDefault();
        
        const username = document.getElementById("username").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        
        if (!username || !email || !password) {
            alert("Будь ласка, заповніть всі поля");
            return;
        }
        
        const response = await fetch("backend/user_actions.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ action: 'register', username, email, password })
        });
        
        const result = await response.json();
        alert(result.message);
    });

    // Обробка входу
    loginForm.addEventListener("submit", async (event) => {
        event.preventDefault();
        
        const email = document.getElementById("loginEmail").value;
        const password = document.getElementById("loginPassword").value;
        
        const response = await fetch("backend/user_actions.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ action: 'login', email, password })
        });
        
        const result = await response.json();
        alert(result.message);
    });

    // Завантаження списку користувачів
    loadUsersButton.addEventListener("click", async () => {
        const response = await fetch("backend/user_actions.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ action: 'get_users' })
        });
        const users = await response.json();
        userList.innerHTML = "";
        users.forEach(user => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${user.id}</td>
                <td>${user.username}</td>
                <td>${user.email}</td>
                <td>
                    <button onclick="deleteUser('${user.id}')">Видалити</button>
                    <button onclick="editUser('${user.id}', '${user.username}', '${user.email}')">Редагувати</button>
                </td>
            `;
            userList.appendChild(row);
        });
    });
});

// Функція для видалення користувача
async function deleteUser(userId) {
    const response = await fetch("backend/user_actions.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ action: 'delete_user', id: userId })
    });
    const result = await response.json();
    alert(result.message);
}

// Функція для редагування користувача
async function editUser(userId, username, email) {
    const newUsername = prompt("Введіть новий логін:", username);
    const newEmail = prompt("Введіть новий email:", email);
    if (!newUsername || !newEmail) return;
    
    const response = await fetch("backend/user_actions.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ action: 'edit_user', id: userId, username: newUsername, email: newEmail })
    });
    const result = await response.json();
    alert(result.message);
}