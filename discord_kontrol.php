<?php

require "db_config.php";

if(!isset($_GET["username"])){

echo "ERROR";
exit;

}

$username = trim($_GET["username"]);

$stmt = $pdo->prepare(
"SELECT * FROM discord_users
WHERE username=:username"
);

$stmt->execute([
"username"=>$username
]);

if($stmt->rowCount()>0){

echo "OK";

}else{

echo "NOT_FOUND";

}

?>
