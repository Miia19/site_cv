<?php

namespace controller;

class ExperienceController{
    
    public $db;
    public function __construct(){

        $e = new Error; // gestion des erreurs. Pas besoin d'écrire : controller\Error car le fichier se trouve déjà à l'intérieur

        $this->db = new \model\ExperienceEntityRepository;
    }
    //---------------------------------------------------------------------------------//
    public function redirect($location){

        header('Location : '.$location);
    }
    //---------------------------------------------------------------------------------//
    public function handleRequest(){

        $op = isset($_GET['exp']) ? $_GET['exp'] : Null;

        try{

            if( !$op || $op == 'list'){
                $this->listExperience();
            }
            elseif( $op == 'show'){

                $this->showExperience();
            }
            else{

                $this->showError( "Page not found", 'Page for operation'. $op .'was not found.');
            }
        }
        catch(Exception $e){

            $this->showError("Application erro", $e->getMessage() );
        }
    }
    //---------------------------------------------------------------------------------//
    public function listExperience(){

        $orderby = isset( $_GET['orderby'])?$_GET['orderby'] : NULL;
        $experiences = $this->db->selectAll($orderby);

        include 'view/experiences/experiences.php';
    }

    //---------------------------------------------------------------------------------//
    public function showExperience(){

        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        
        if(!$id){

            throw new Exception('Internal error.');
        }
        $contact = $this->db->select($id);

		include 'view/experiences/experience.php';
    }
}