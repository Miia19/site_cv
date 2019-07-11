<?php
 require_once( 'Autoload.php');

 $controller = new controller\CompetenceController();
 $controller->handleRequest();

 $controller = new controller\ExperienceController();
 $controller->handleRequest();

 $controller = new controller\FormationController();
 $controller->handleRequest();
