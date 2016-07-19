<!DOCTYPE html>
<?php
session_start();

$game_id = "";
$player_id = "";

if (array_key_exists('info', $_POST) && $_POST['info'] === "true") {
    $_SESSION['game'] = intval($_POST['game']);
    $_SESSION['player'] = intval($_POST['player']);
    header('Location: index.html');
} else {
    if (array_key_exists('game', $_SESSION)) $game_id = $_SESSION['game'];
    if (array_key_exists('player', $_SESSION)) $player_id = $_SESSION['player'];
}
?>
<html>
<head>
    <title>Setup Game</title>
</head>
<body>
    Please provide some info:
    <form action="setup.php" method="post">
        <input type="hidden" name="info" value="true">
        <input type="number" name="game" placeholder="Game ID" value="<?php echo htmlentities($game_id); ?>">
        <input type="number" name="player" placeholder="Player ID" value="<?php echo htmlentities($player_id); ?>">
        <button type="submit">Go</button>
    </form>
</body>
</html>