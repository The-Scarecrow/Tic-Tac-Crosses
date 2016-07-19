<?php
/**
 * Request footprint:
 * GET actions/poll.php
 *     ?game=<game id>
 *     &player=<player id>
 */


define('ON_SERVER', true);

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