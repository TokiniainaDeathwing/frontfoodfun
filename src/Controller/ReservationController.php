<?php

namespace App\Controller;

use App\Service\ReservationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(Environment $twig,Request $request)
    {
        $heure=$request->get('heure');
        $date=$request->get('date');
        $nom=$request->get('nom');

        $datetime=str_replace(".","-",$date);
        $datetime=$datetime." ".$heure.":00";
       // var_dump($datetime);

        $reservationservice=new ReservationService($this->getDoctrine());
        $reservationservice->reserver( new \DateTime($datetime),$nom);
        return $this->redirectToRoute('index_page');
    }
}
