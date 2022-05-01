<?php

namespace App\Controller;

use App\Repository\MentionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MentionsController extends AbstractController
{
    /**
    * @Route("/mentions-legales", name="mentions", methods={"GET"})
    */
    public function index(MentionsRepository $mentionsRepository): Response
    {
        return $this->render('obligations/mentions.html.twig', [
            'mentions' => $mentionsRepository->findAll(),
        ]);
    }
}
