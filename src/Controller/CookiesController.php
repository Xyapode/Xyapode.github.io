<?php

namespace App\Controller;

use App\Repository\CookiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CookiesController extends AbstractController
{
    /**
     * @Route("/cookies", name="cookies", methods={"GET"})
     */
    public function index(CookiesRepository $cookiesRepository): Response
    {
        return $this->render('obligations/cookies.html.twig', [
            'cookies' => $cookiesRepository->findAll(),
        ]);
    }
}
