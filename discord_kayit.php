<?php

require "db_config.php";

if(!isset($_POST["username"])){

echo "ERROR";
exit;

}

$username = trim($_POST["username"]);

$stmt = $pdo->prepare(
"INSERT INTO discord_users(username)
VALUES(:username)
ON DUPLICATE KEY UPDATE
registered_at=CURRENT_TIMESTAMP"
);

$stmt->execute([
"username"=>$username
]);

echo "OK";

?>
