<?php

namespace App\Controller;

use App\Entity\Entretien;
use App\Form\EntretienType;
use App\Repository\EntretienRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntretienController extends AbstractController
{
    #[Route('/entretien', name: 'app_entretien')]
    public function index(): Response
    {
        return $this->render('entretien/index.html.twig', [
            'controller_name' => 'EntretienController',
        ]);
    }
    #[Route('/entretien/add', name:'app_addEntretien')]
   
public function new(Request $request,ManagerRegistry $manager): Response
{
   $e= new Entretien();
        $form = $this->createForm(EntretienType::class,$e);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $manager->getManager()->persist($e);
            $manager->getManager()->flush();
            return $this->redirectToRoute('app_entretien');
        }
        return $this->renderForm('entretien/add.html.twig',['f'=>$form]);  
}
#[Route('/entretien/list', name:'app_listentretien')]
public function list(EntretienRepository $repo){
   $e = $repo->findAll();
   return $this->render('entretien/list.html.twig', [
       'entretiens' => $e
   ]);
}
}
