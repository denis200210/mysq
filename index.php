<?php

try {
    $conn = new PDO("mysql:host=localhost;dbname=Php_chat", 'denis200210', '13254');
}
 catch (PDOException $pe) {
    die("Could not connect to the database Php_chat :" . $pe->getMessage());
}


$login = "asd";
$password = "no";

$login = $_GET['login'];
$password = $_GET['password'];

if ($login == null || $password == null)
{
    echo "Enter login and password</br>All messages:</br>";
}
else {
    $sql = 'SELECT login, password FROM users';
    foreach ($conn->query($sql) as $row) {
        if ($login === $row['login'] && $password === $row['password']) {
            echo "Hello ", $login, "</br>All messages:</br>";
            $message = $_GET['message'];
            $Date = date("Y-m-d");

            if (!empty($message)) {
                $newMessage = "Insert Into messages(login, message, date_) Values(?, ?, ?)";
                $addMessage = $conn->prepare($newMessage);
                $addMessage->execute(array($login, $message, $Date));
            }
        } else {
            echo "You are not log in</br>All messages:</br>";
        }

    }

    $sql = 'SELECT * FROM messages';
    foreach ($conn->query($sql) as $row) {
        echo $row['login'], " write ", $row['message'], " on ", $row['date_'], "</br>";
    }

    $conn->close();


}
