<?php
namespace model;

class FormationEntityRepository{

    private $db;
    private $table;
    public function __construct(){}
    
    public function getDb(){

        if( !$this->db ){

            try{

                $xml = simplexml_load_file('app/config3.xml');
                $this->table = $xml->table;

                try{
                    $this->db = new \PDO("mysql:dbname=". $xml->db . ";host=". $xml->host, $xml->user, $xml->password, array(\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION,
                    \PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8'
                    ) );
                }
                catch(\PDOException $e){

                    die("Problème de connexion bdd : " . $e->getMessage() );
                }


            }
            catch(Exception $e){

                die("Problème de fichier de configuration xml !");
            }
        }
        return $this->db;
    }
    //---------------------------------------------------------------------------------//
    public function selectAll(){

        $q = $this->getDb()->query('SELECT * FROM '.$this->table);

        $r = $q->fetchAll(\PDO::FETCH_OBJ);

        if(!$r){
            return false;
        }
        else{
            return $r;
        }
    }
    //---------------------------------------------------------------------------------//

}

