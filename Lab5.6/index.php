<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Система керування користувачами</title>
    <script defer src="script.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Реєстрація нового користувача</h2>
    <form id="registerForm">
        <table>
            <tr>
                <td><label for="username">Логін:</label></td>
                <td><input type="text" id="username" required></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" required></td>
            </tr>
            <tr>
                <td><label for="password">Пароль:</label></td>
                <td><input type="password" id="password" required></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit">Зареєструватися</button></td>
            </tr>
        </table>
    </form>
    
    <h2>Вхід</h2>
    <form id="loginForm">
        <table>
            <tr>
                <td><label for="loginEmail">Email:</label></td>
                <td><input type="email" id="loginEmail" required></td>
            </tr>
            <tr>
                <td><label for="loginPassword">Пароль:</label></td>
                <td><input type="password" id="loginPassword" required></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit">Увійти</button></td>
            </tr>
        </table>
    </form>
    
    <h2>Список користувачів</h2>
    <button id="loadUsers">Завантажити список</button>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Логін</th>
                <th>Email</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody id="userList"></tbody>
    </table>
</body>
</html>