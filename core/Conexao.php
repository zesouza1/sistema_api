<?php

define('SGBD','mysql');
define('HOST','localhost');
define('DBNAME','produtos');
define('CHARSET', 'utf8');
define('USER','root');
define('PASSWORD','');
define('SERVER', 'windows');
define('PORTA_DB',3306);

class Conexao{
    private static $pdo;

    private function __construct(){
        //TENTA INSTANCIAR AI SEU ******
    }


    private static function existsExtension(){ //apenas para ver a extensao
        switch(SGBD):
            case 'mysql':
                $extensao = 'pdo_mysql';
                break;
        endswitch;

        if (empty($extensao) || !extension_loaded($extensao)):
            echo "Extensao PDO ' {$extensao}' não está habilitada!";
        endif;
        }
   
    
    public static function getInstance(){
        self::existsExtension();
        if(!isset(self::$pdo)){
            try{
                switch(SGBD):
                    case 'mysql':
                        $opcoes = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
                        self::$pdo = new \PDO("mysql:host=". HOST. "; dbname=". DBNAME .";", USER,PASSWORD,$opcoes);
                        break;
                endswitch;

                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); //configura para exibir erros de conexao
            }catch(\PDOException $e){
                throw new \PDOException($e->getMessage());
            }catch(\Exception $e){
                throw new \Exception($e->getMessage());
            }
        }
        return self::$pdo;
    }
}

require '../model/ProdutoModel.php';
$model = new ProdutoModel();