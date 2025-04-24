<?php
include 'db.php';

$action = $_POST['action'];

switch ($action) {
    case 'register':
        registerUser();
        break;
    case 'login':
        loginUser();
        break;
    case 'get_users':
        getUsers();
        break;
    case 'edit_user':
        editUser();
        break;
    case 'delete_user':
        deleteUser();
        break;
    default:
        echo json_encode(["message" => "Невідома дія"]);
        break;
}

function registerUser() {
    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data['username'];
    $email = $data['email'];
    $password = password_hash($data['password'], PASSWORD_BCRYPT);

    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode(["message" => "Будь ласка, заповніть всі поля"]);
        exit();
    }

    try {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        echo json_encode(["message" => "Користувача успішно зареєстровано"]);
    } catch (PDOException $e) {
        echo json_encode(["message" => "Помилка реєстрації: " . $e->getMessage()]);
    }
}

function loginUser() {
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data['email'];
    $password = $data['password'];

    if (empty($email) || empty($password)) {
        echo json_encode(["message" => "Будь ласка, заповніть всі поля"]);
        exit();
    }

    try {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            echo json_encode(["message" => "Успішний вхід"]);
        } else {
            echo json_encode(["message" => "Невірний email або пароль"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["message" => "Помилка входу: " . $e->getMessage()]);
    }
}

function getUsers() {
    try {
        global $pdo;
        $stmt = $pdo->query("SELECT id, username, email FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($users);
    } catch (PDOException $e) {
        echo json_encode(["message" => "Помилка отримання користувачів: " . $e->getMessage()]);
    }
}

function editUser() {
    $data = json_decode(file_get_contents("php://input"), true);
    $userId = $data['id'];
    $username = $data['username'];
    $email = $data['email'];

    if (empty($username) || empty($email)) {
        echo json_encode(["message" => "Будь ласка, заповніть всі поля"]);
        exit();
    }

    try {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $stmt->execute([$username, $email, $userId]);
        echo json_encode(["message" => "Дані користувача успішно оновлені"]);
    } catch (PDOException $e) {
        echo json_encode(["message" => "Помилка редагування користувача: " . $e->getMessage()]);
    }
}

function deleteUser() {
    $data = json_decode(file_get_contents("php://input"), true);
    $userId = $data['id'];

    try {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        echo json_encode(["message" => "Користувача успішно видалено"]);
    } catch (PDOException $e) {
        echo json_encode(["message" => "Помилка видалення користувача: " . $e->getMessage()]);
    }
}
?>