<?php
// src/Controller/AdvertController.php

namespace App\Controller;

use App\Service\PlatService;
use App\Service\CategorieService;
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
    $data['random']=$this->servicePlat->getPlatRandom();
   // var_dump($data);
    $content = $twig->render('accueil.html.twig',$data);

    return new Response($content);
  }

  // liste des plats
  public function menu_page(Environment $twig,Request $request)
  {

    $this->servicePlat = new PlatService($this->getDoctrine());
    $serviceCategorie=new CategorieService($this->getDoctrine());
    $query=$request->query->get('query');
    $categorie=$request->query->get('categorie');
    $limit=$request->query->get('limit');
    $offset=$request->query->get('offset');
    if($limit==""){
        $limit=6;
    }
    if($offset==""){
        $offset=0;
    }
    if($query==null){
        $query="";
    }
    if($categorie==null){
        $categorie="";
    }
    $page=(int)($offset/$limit) ;
    $data=array();
    $data['nombre']=$this->servicePlat->countPlat($query,$categorie);
    $data['categories']=$serviceCategorie->getCategories();
    $data['results']=$this->servicePlat->rechercherPlat($query,$categorie,$limit,$offset);
    $data['limit']=$limit;
    $data['offset']=$offset;
    $data['query']=$query;
    $data['page_max']=(int)($data['nombre']/$limit)+1;
    $data['page']=$page;
    $data['categorie']=$categorie;
    //var_dump($data);
      $content = $twig->render('menu.html.twig',$data);
    return new Response($content);
  }

  // Contact
  public function contact_page(Environment $twig)
  {
    $content = $twig->render('contact.html.twig');

    return new Response($content);
  }

    // Fiche plat
    public function fiche_page(Environment $twig,Request $request)
    {

        $this->servicePlat = new PlatService($this->getDoctrine());
        $id=$request->get('id');
        $serviceCategorie=new CategorieService($this->getDoctrine());
        $data=array();
        $data['plat']=$this->servicePlat->getPlatById($id);
        $data['categories']=$serviceCategorie->getCategories();
        $data['images_plat']=$this->servicePlat->getImagePlat($id);
        $content = $twig->render('fiche.html.twig',$data);

        return new Response($content);
    }

}
