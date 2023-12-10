<?php
// ../config/config.php
class config
{
    private static $pdo = null;

    public static function getConnection()
    {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO(
                    'mysql:host=localhost;dbname=testing',
                    'root',
                    '',
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
                //echo "connected successfully";
            } catch (Exception $e) {
                die('Error: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
