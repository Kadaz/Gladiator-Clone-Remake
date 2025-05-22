<?php
session_start();
require_once("var/ustawienia.php");

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $msg_id = intval($_POST['delete_id']);
    $player_id = $_SESSION['id'];

    // Confirm ownership
    $stmt = $conn->prepare("SELECT id_msj FROM mensajes WHERE id_msj = ? AND id_user_r = ?");
    $stmt->bind_param("ii", $msg_id, $player_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $del_stmt = $conn->prepare("DELETE FROM mensajes WHERE id_msj = ?");
        $del_stmt->bind_param("i", $msg_id);
        $del_stmt->execute();
        $del_stmt->close();
    }

    $stmt->close();
}

header("Location: inbox.php");
exit;