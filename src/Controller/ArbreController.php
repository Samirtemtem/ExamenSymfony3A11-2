<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Arbre;
use App\Repository\ParcRepository;
use App\Repository\ArbreRepository;
use App\Form\ArbreType;

class ArbreController extends AbstractController
{
    #[Route('/arbre', name: 'app_arbre')]
    public function index(): Response
    {
        return $this->render('arbre/index.html.twig', [
            'controller_name' => 'ArbreController',
        ]);
    }
    #[Route('/arbre/add', name: 'app_arbre_add')]

public function new(Request $request,ManagerRegistry $manager): Response
{
   $e= new Arbre();
        $form = $this->createForm(ArbreType::class,$e);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $manager->getManager()->persist($e);
            $manager->getManager()->flush();
            return $this->redirectToRoute('app_listarbre');
        }
        return $this->renderForm('arbre/add.html.twig',['f'=>$form]);  
}
#[Route('/arbre/list', name:'app_listarbre')]
public function list(ArbreRepository $repo){
   $e = $repo->findAll();
   return $this->render('arbre/list.html.twig', [
       'arbres' => $e
   ]);
}
}
