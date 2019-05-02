<?php
// src/Controller/AdvertController.php

namespace App\Controller;

use App\Service\PlatService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Environment;

class IndexController extends  AbstractController
{
  // home page
    private $servicePlat;
  public function index(Environment $twig)
  {

    $this->servicePlat = new PlatService($this->getDoctrine());
    $data=array();
    $data['specialites']=$this->servicePlat->getSpecialités();
   // var_dump($data);
    $content = $twig->render('accueil.html.twig',$data);

    return new Response($content);
  }

  // liste des plats
  public function menu_page(Environment $twig)
  {
    $content = $twig->render('menu.html.twig');

    return new Response($content);
  }

  // Contact
  public function contact_page(Environment $twig)
  {
    $content = $twig->render('contact.html.twig');

    return new Response($content);
  }

}
