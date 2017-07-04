<?php
/*

*/
class AccesoDatos
{
    /* Propiedades */
    private static $ObjetoAccesoDatos;
    private $objetoPDO;
 
    /* Constructors */
    private function __construct()
    {
        try { 
                $dsn = "mysql:host=localhost;dbname=login_pdo;charset=utf8";
                $usuario = "root";
                $driver_options = array(
                                        PDO::ATTR_EMULATE_PREPARES => false,
                                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                                        );

                $this->objetoPDO = new PDO($dsn, $usuario, '',$driver_options);
                $this->objetoPDO->exec("SET CHARACTER SET utf8");
            } 
        catch (PDOException $e) { 
            print "Error!: " . $e->getMessage(); 
            die();
        }
    }

    // Evita que el objeto se pueda clonar
    public function __clone()
    { 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR); 
    } 

    /* RetornarConsulta */
    public function RetornarConsulta($sql)
    { 
        return $this->objetoPDO->prepare($sql); 
    }
    
    /* RetornarUltimoIdInsertado */
     public function RetornarUltimoIdInsertado()
    { 
        return $this->objetoPDO->lastInsertId(); 
    }
 
    /* dameUnObjetoAcceso */ 
    public static function dameUnObjetoAcceso()
    { 
        if (!isset(self::$ObjetoAccesoDatos)) {          
            self::$ObjetoAccesoDatos = new AccesoDatos(); 
        } 
        return self::$ObjetoAccesoDatos;        
    }
 

}
