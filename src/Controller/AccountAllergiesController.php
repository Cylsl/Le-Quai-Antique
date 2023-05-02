<?php

namespace App\Controller;

use App\Entity\Allergies;
use App\Form\AllergiesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountAllergiesController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/compte/allergies', name: 'app_account_allergies')]
    public function index(): Response
    {
        return $this->render('account/allergies.html.twig');
    }

    #[Route('/compte/ajouter-une-allergie', name: 'app_account_allergies_add')]
    public function add(Request $request): Response
    {
        $allergie = new Allergies();
        $form = $this->createForm(AllergiesType::class, $allergie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $allergie->setUser($this->getUser());
            $this->entityManager->persist($allergie);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_account_allergies');
        }
        return $this->render('account/allergies_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/compte/modifier-une-allergie/{id}', name: 'app_account_allergies_edit')]
    public function edit(Request $request, $id): Response
    {
        $allergie = $this->entityManager->getRepository(Allergies::class)->findOneById($id);

        if (!$allergie || $allergie->getUser() != $this->getUser()) {
            return $this->redirectToRoute('app_account_allergies');
        }

        $form = $this->createForm(AllergiesType::class, $allergie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->flush();
            return $this->redirectToRoute('app_account_allergies');
        }
        return $this->render('account/allergies_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/compte/supprimer-une-allergie/{id}', name: 'app_account_allergies_delete')]
    public function delete(Request $request, $id): Response
    {
        $allergie = $this->entityManager->getRepository(Allergies::class)->findOneById($id);

        if ($allergie && $allergie->getUser() == $this->getUser()) {

            $this->entityManager->remove($allergie);
            $this->entityManager->flush();
        }
        return $this->redirectToRoute('app_account_allergies');
    }
}
