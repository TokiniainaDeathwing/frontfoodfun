<?php
// src/Controller/AdvertController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class IndexController
{
  // home page
  public function index(Environment $twig)
  {
    $content = $twig->render('accueil.html.twig');

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
