<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Categories;
use App\Form\ProduitFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/tableau-de-bord", name="show_dashboard", methods={"GET"})
     */
    public function showDashboard(EntityManagerInterface $entityManager): Response
    {
        $produits = $entityManager->getRepository(Produit::class)->findAll();
        $categories = $entityManager->getRepository(Categories::class)->findAll();

        return $this->render('admin/show_dashboard.html.twig', [
            'produits' => $produits,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/creer-un-article", name="create_article", methods={"GET|POST"})
     */
    public function createProduit(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $produit = new Produit();

        $form = $this->createForm(ProduitFormType::class, $produit)->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $file = $form->get('photo')->getData();
            
            $entityManager->persist($produit);
            $entityManager->flush();

            $this->addFlash('success', 'Bravo, votre article est bien en ligne !');

            return $this->redirectToRoute('show_dashboard');
        }

        return $this->render('admin/form/form_produit.html.twig',[
            'form' => $form->createView()
        ]);
    }
}