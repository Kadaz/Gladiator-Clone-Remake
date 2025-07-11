<?php
/**  Returns a table with all the bonuses of the player's deity */
function get_deity_bonus(mysqli $conn, int $player_id): array {
    $q = $conn->prepare("
        SELECT d.bonus_type, d.bonus_value
        FROM gracze g
        JOIN deities d ON g.deity_id = d.id
        WHERE g.id = ?
    ");
    $q->bind_param("i", $player_id);
    $q->execute();
    $res = $q->get_result();
    $bonuses = [];
    while ($row = $res->fetch_assoc()) {
        $bonuses[$row['bonus_type']] = (int)$row['bonus_value'];
    }
    return $bonuses; // π.χ. ['damage'=>10,'xp'=>15,'gold'=>20,'crit_chance'=>5,'defense'=>8]
}

/**  Applies bonuses to base stats and returns new array */
function apply_deity_bonuses(array $stats, array $bonuses): array {
    // base: ['dmg'=>X,'def'=>Y,'xp'=>Z,'gold'=>G,'crit'=>C]
    if (isset($bonuses['damage']))       $stats['dmg']  += $bonuses['damage'];
    if (isset($bonuses['defense']))      $stats['def']  += $bonuses['defense'];
    if (isset($bonuses['crit_chance']))  $stats['crit'] += $bonuses['crit_chance'];
    if (isset($bonuses['xp']))           $stats['xp']   = (int)floor($stats['xp'] * (1+$bonuses['xp']/100));
    if (isset($bonuses['gold']))         $stats['gold'] = (int)floor($stats['gold']* (1+$bonuses['gold']/100));
    return $stats;
}
