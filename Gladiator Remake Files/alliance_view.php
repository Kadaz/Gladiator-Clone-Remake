<?php
session_start();
require 'db.php';
require_once('var/ustawienia.php');
require_once('gora_strony.php');
require_once('menu_l.php');

// ----------------------
// Βρες alliance_id
// ----------------------
$alliance_id = null;

// Αν υπάρχει GET id, το χρησιμοποιούμε
if (isset($_GET['id'])) {
    $alliance_id = (int)$_GET['id'];
} else {
    // Αν δεν υπάρχει, βρίσκουμε από τον logged-in χρήστη
    if (!isset($_SESSION['id'])) {
        echo "<p>Δεν είστε συνδεδεμένος.</p>";
        exit;
    }

    $player_id = $_SESSION['id'];

    $stmt = $conn->prepare("
        SELECT am.alliance_id
        FROM guild_members gm
        JOIN alliance_members am ON gm.guild_id = am.guild_id
        WHERE gm.player_id = ?
    ");
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        $alliance_id = $row['alliance_id'];
    } else {
        echo "<p>Δεν ανήκετε σε κάποιο alliance.</p>";
        exit;
    }
}

// ----------------------
// Φέρε δεδομένα Alliance
// ----------------------
$stmt = $conn->prepare("SELECT * FROM alliances WHERE id = ?");
$stmt->bind_param("i", $alliance_id);
$stmt->execute();
$alliance = $stmt->get_result()->fetch_assoc();

if (!$alliance) {
    echo "<p>Το alliance δεν βρέθηκε.</p>";
    exit;
}

// ----------------------
// Guilds του Alliance
// ----------------------
$stmt = $conn->prepare("
    SELECT g.name 
    FROM guilds g
    JOIN alliance_members am ON am.guild_id = g.id
    WHERE am.alliance_id = ?
");
$stmt->bind_param("i", $alliance_id);
$stmt->execute();
$guilds_result = $stmt->get_result();
?>

<h2>🏛 Συμμαχία: <?php echo htmlspecialchars($alliance['name']); ?> [<?php echo htmlspecialchars($alliance['tag']); ?>]</h2>

<?php if (!empty($alliance['flag'])): ?>
    <img src="images/alliances/<?php echo htmlspecialchars($alliance['flag']); ?>" alt="Flag" width="100"><br><br>
<?php else: ?>
    <p>(Δεν έχει οριστεί σημαία.)</p>
<?php endif; ?>

<p><strong>Περιγραφή:</strong><br>
<?php echo nl2br(htmlspecialchars($alliance['description'])); ?></p>

<h3>🏰 Συμμετέχοντα Guilds:</h3>
<ul>
<?php
if ($guilds_result->num_rows > 0) {
    while ($g = $guilds_result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($g['name']) . "</li>";
    }
} else {
    echo "<li>Καμία guild δεν είναι συνδεδεμένη.</li>";
}
?>
</ul>

<a href="index.php">← Επιστροφή</a>
