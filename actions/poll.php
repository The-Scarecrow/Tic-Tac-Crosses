<?php
/**
 * Request footprint:
 * GET actions/poll.php
 *     ?game=<game id>
 *     &player=<player id>
 */

require('../server/setup.php');

// make sure we have the required parameters
if (!array_key_exists('game', $_GET) || !array_key_exists('player', $_GET)) {
    http_response_code(500);
    die(json_encode([
        "success" => false,
        "error" => [
            "name" => "ParamMissingError",
            "description" => "Missing 'game' or 'player' GET parameters"
        ]
    ]));
}

session_start();

// make sure the parameters match with our session values
$game_id = intval($_GET['game']);
$player_id = intval($_GET['player']);

if (!array_key_exists('game', $_SESSION) || !array_key_exists('player', $_SESSION)
    || $game_id !== $_SESSION['game'] || $player_id !== $_SESSION['player']) {
    http_response_code(500);
    die(json_encode([
        "success" => false,
        "error" => [
            "name" => "SessionMismatchError",
            "description" => "Please ensure that cookies are enabled"
        ]
    ]));
}

// close session to avoid hanging other requests
session_write_close();

require('../server/connection.php');

// todo: validate game and player
Database::get();

// start poll loop
$startTime = time();
while (time() - $startTime < 30) {
    // todo: query for messages, put into $messages
    $messages = [];

    if (count($messages)) {
        die(json_encode([
            "success" => true,
            "messages" => $messages
        ]));
    }

    // wait for .1 of a second before repeating
    usleep(100000);
}

die(json_encode([
    "success" => true,
    "messages" => []
]));