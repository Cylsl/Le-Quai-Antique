<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Product;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/notre-carte', name: 'app_menu')]
    public function index(Request $request): Response
    {
        $menu = $this->entityManager->getRepository(Product::class)->findAll();


        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $menu = $this->entityManager->getRepository(Product::class)->findWithSearch($search);
        }


        return $this->render('menu/index.html.twig', [
            'menu' => $menu,
            'form' => $form->createView()
        ]);
    }
}
