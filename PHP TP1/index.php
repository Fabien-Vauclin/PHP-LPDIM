<?php
use App\model\Database;
use App\model\TaskRepository;

require 'vendor/autoload.php';
define("DATABASE_FILE", "./data.db");
$table = "tasks";
$tasks = [];
if (!file_exists(DATABASE_FILE)) {
    $database = new SQLite3(DATABASE_FILE);
    $database->exec(<<<SQL
        create table $table 
        (
            id INTEGER
                constraint tasks_pk
                    primary key autoincrement,
            name TEXT,
            checked INTEGER default 0
        );
        INSERT INTO $table (id, name, checked) VALUES (1, 'Task to be done', 0);
        INSERT INTO $table (id, name, checked) VALUES (2, 'Task done', 1);
        
SQL
    );
    header("Location: /");
}
$database = new SQLite3(DATABASE_FILE);
?>

<?php

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "uncheck":
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $database->exec(<<<SQL
UPDATE $table set checked=0 WHERE id=$id;
SQL
                );
            }
            header("Location: /");
            break;
        case "check":
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $database->exec(<<<SQL
UPDATE $table set checked=1 WHERE id=$id;
SQL
                );
            }
            header("Location: /");
            break;
        case "delete":
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $database->exec(<<<SQL
DELETE FROM $table WHERE id=$id;
SQL
                );
            }
            header("Location: /");
            break;
        case "add":
            if (isset($_GET["name"])) {
                $name = $_GET["name"];
                $name = addslashes($name);
                $database->exec(<<<SQL
                INSERT INTO $table (name) values('$name')
SQL
                );
            }
            header("Location: /");
            break;
        default:
            echo "An error has occured";
            die();
    }
}


$query = $database->query(<<<SQL
    SELECT * FROM $table ORDER BY checked DESC;
SQL
);
if (!$query)
    die("Impossible to execute query.");

while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
    $tasks[] = $row;
}
?>

