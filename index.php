<?php
// Room data
$rooms = [
    ["RoomNumber" => "R101", "Description" => "Meeting / Discussion Room (max 5 people)"],
    ["RoomNumber" => "R102", "Description" => "Study Room (personal space — only 1 person)"],
    ["RoomNumber" => "R103", "Description" => "Small Meeting Room (max 3 people)"],
    ["RoomNumber" => "R201", "Description" => "Classroom (larger room for activities, classes, or tests)"],
    ["RoomNumber" => "R202", "Description" => "Function Room (larger room for activities, events, or tests)"],
    ["RoomNumber" => "R203", "Description" => "Workshop Room (larger room with equipment)"],
];

// Search logic
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$results = [];
$hasSearched = false;

if ($search !== '') {
    $hasSearched = true;
    foreach ($rooms as $room) {
        if (stripos($room['RoomNumber'], $search) !== false ||
            stripos($room['Description'], $search) !== false) {
            $results[] = $room;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Management System - PHP</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f5f7fa; margin: 0; padding: 20px; }
        .container { max-width: 900px; margin: auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 30px; }
        h1 { color: #0078d4; border-bottom: 3px solid #0078d4; padding-bottom: 10px; }
        h2 { color: #333; margin-top: 30px; }
        .lead { color: #555; margin-bottom: 20px; }
        form { display: flex; gap: 10px; margin-bottom: 20px; }
        input[type="text"] { flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 14px; }
        button { padding: 10px 20px; background: #0078d4; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
        button:hover { background: #005fa3; }
        .alert { padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .alert-info { background: #e7f3fe; border-left: 4px solid #0078d4; color: #0c5460; }
        .alert-warn { background: #fff3cd; border-left: 4px solid #ffc107; color: #856404; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #0078d4; color: #fff; }
        tr:hover { background: #f1f1f1; }
        code { background: #eee; padding: 2px 6px; border-radius: 3px; font-family: Consolas, monospace; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Room Management System (PHP)</h1>
        <p class="lead">Search by room number (e.g., <code>R10</code>) or description (e.g., <code>meeting</code>, <code>study</code>).</p>

        <form method="get">
            <input type="text" name="search" placeholder="e.g., R10, meeting, study room..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Search</button>
        </form>

        <?php if ($hasSearched): ?>
            <?php if (!empty($results)): ?>
                <div class="alert alert-info">
                    <strong>Search results for "<?= htmlspecialchars($search) ?>":</strong>
                    <ul style="margin-top: 10px;">
                        <?php foreach ($results as $r): ?>
                            <li><strong><?= htmlspecialchars($r['RoomNumber']) ?></strong> — <?= htmlspecialchars($r['Description']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php else: ?>
                <div class="alert alert-warn">
                    No rooms found matching "<?= htmlspecialchars($search) ?>".
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <h2>All Rooms</h2>
        <table>
            <thead>
                <tr><th style="width: 25%;">Room Number</th><th>Description</th></tr>
            </thead>
            <tbody>
                <?php foreach ($rooms as $room): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($room['RoomNumber']) ?></strong></td>
                        <td><?= htmlspecialchars($room['Description']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>