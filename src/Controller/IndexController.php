<?php
// src/Controller/AdvertController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class IndexController
{
  public function index()
  {
    $content = "Notre propre Hello World !"

    return new Response($content);
  }
}
