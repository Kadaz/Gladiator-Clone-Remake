<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$player_id = $_SESSION['id'];

// ⬇️ Φόρτωσε χρήστη
$stmt = $conn->prepare("SELECT zloto, bank_gold FROM gracze WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

// ⬇️ Επεξεργασία καταθέσεων / αναλήψεων
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = isset($_POST['amount']) ? abs((int)$_POST['amount']) : 0;

    // ✅ Απόσυρση item
    if ($_POST['action'] === 'withdraw_item' && isset($_POST['bank_item_id'])) {
        $bank_item_id = (int)$_POST['bank_item_id'];
        $item = $conn->query("SELECT item_id FROM bank_items WHERE id = $bank_item_id AND player_id = $player_id")->fetch_assoc();

        if ($item) {
            $item_id = (int)$item['item_id'];
            $conn->query("DELETE FROM bank_items WHERE id = $bank_item_id");
            $conn->query("INSERT INTO player_items (player_id, item_id, equipped) VALUES ($player_id, $item_id, 0)");
            $message = "✅ Item withdrawn to your inventory.";
        } else {
            $message = "❌ Item not found or doesn't belong to you.";
        }
    }

    // ✅ Κατάθεση item
    if ($_POST['action'] === 'deposit_item' && isset($_POST['inv_id'])) {
        $inv_id = (int)$_POST['inv_id'];
        $deposit_cost = 25;

        $count_check = $conn->query("SELECT COUNT(*) AS total FROM bank_items WHERE player_id = $player_id");
        $current_count = $count_check->fetch_assoc()['total'] ?? 0;

        if ($current_count >= 50) {
            $message = "❌ Bank is full (50 items max).";
        } else {
            $check = $conn->query("
                SELECT pi.item_id, g.zloto
                FROM player_items pi
                JOIN gracze g ON pi.player_id = g.id
                WHERE pi.id = $inv_id AND pi.player_id = $player_id
            ");
            $item = $check->fetch_assoc();

            if (!$item) {
                $message = "❌ Item not found.";
            } elseif ($item['zloto'] < $deposit_cost) {
                $message = "❌ Not enough gold to deposit item (need $deposit_cost).";
            } else {
                $item_id = $item['item_id'];
                $conn->query("DELETE FROM player_items WHERE id = $inv_id");
                $conn->query("INSERT INTO bank_items (player_id, item_id) VALUES ($player_id, $item_id)");
                $conn->query("UPDATE gracze SET zloto = zloto - $deposit_cost WHERE id = $player_id");
                $user['zloto'] -= $deposit_cost;
                $message = "✅ Item deposited to the bank (cost: $deposit_cost gold).";
            }
        }
    }

    // ✅ Κατάθεση gold
    if ($_POST['action'] === 'deposit') {
        if ($amount > 0 && $amount <= $user['zloto']) {
            $conn->query("UPDATE gracze SET zloto = zloto - $amount, bank_gold = bank_gold + $amount WHERE id = $player_id");
            $user['zloto'] -= $amount;
            $user['bank_gold'] += $amount;
            $message = "✅ You deposited $amount gold.";
        } else {
            $message = "❌ Not enough gold to deposit.";
        }
    }

    // ✅ Ανάληψη gold
    if ($_POST['action'] === 'withdraw') {
        if ($amount > 0 && $amount <= $user['bank_gold']) {
            $conn->query("UPDATE gracze SET zloto = zloto + $amount, bank_gold = bank_gold - $amount WHERE id = $player_id");
            $user['zloto'] += $amount;
            $user['bank_gold'] -= $amount;
            $message = "✅ You withdrew $amount gold.";
        } else {
            $message = "❌ Not enough gold in bank.";
        }
    }
}
?>

<h2>🏦 Bank</h2>
<p><strong>Gold on hand:</strong> <?= $user['zloto'] ?> | <strong>In bank:</strong> <?= $user['bank_gold'] ?></p>

<?php if ($message): ?>
    <p style="color:blue;"><?= $message ?></p>
<?php endif; ?>

<!-- Gold Deposit/Withdraw -->
<form method="post">
    <input type="number" name="amount" min="1" required>
    <button name="action" value="deposit">💰 Deposit</button>
    <button name="action" value="withdraw">🏧 Withdraw</button>
</form>

<!-- Banked Items -->
<h3>📦 Stored Items</h3>
<?php
$res = $conn->query("
    SELECT bi.id AS bank_id, i.name
    FROM bank_items bi
    JOIN items i ON bi.item_id = i.id
    WHERE bi.player_id = $player_id
");

if ($res->num_rows === 0) {
    echo "<p>— No items in the bank —</p>";
} else {
    echo "<ul>";
    while ($item = $res->fetch_assoc()) {
        echo "<li>{$item['name']}
            <form method='post' style='display:inline'>
                <input type='hidden' name='bank_item_id' value='{$item['bank_id']}'>
                <button name='action' value='withdraw_item'>Withdraw</button>
            </form>
        </li>";
    }
    echo "</ul>";
}
?>

<!-- Deposit Item UI -->
<h3>🎒 Deposit Item to Bank (Cost: 25 gold)</h3>
<?php
$count_res = $conn->query("SELECT COUNT(*) AS total FROM bank_items WHERE player_id = $player_id");
$bank_count = $count_res->fetch_assoc()['total'] ?? 0;

$inv_res = $conn->query("
    SELECT pi.id AS inv_id, i.name
    FROM player_items pi
    JOIN items i ON pi.item_id = i.id
    WHERE pi.player_id = $player_id AND pi.equipped = 0
");

if ($inv_res->num_rows === 0) {
    echo "<p>— No items available to deposit —</p>";
} elseif ($bank_count >= 50) {
    echo "<p style='color:red;'>⛔ Bank is full (50 items max).</p>";
} else {
    echo "<ul>";
    while ($row = $inv_res->fetch_assoc()) {
        echo "<li>{$row['name']}
            <form method='post' style='display:inline'>
                <input type='hidden' name='inv_id' value='{$row['inv_id']}'>
                <button name='action' value='deposit_item'>Deposit</button>
            </form>
        </li>";
    }
    echo "</ul>";
}
?>

<br><a href="index.php">← Back to Dashboard</a>
