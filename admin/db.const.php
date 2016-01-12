<?PHP
try {
     $pdo = new PDO("mysql:host=localhost;dbname=framework;charset=utf8", "root", "");
     $GLOBALS["pdo"] = $pdo;
} catch ( PDOException $e ){
     print $e->getMessage();
}