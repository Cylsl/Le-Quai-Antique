<?php


namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Classe\Mail_reservation;
use App\Entity\LimitReservation;



class ReservationController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route("/reservation", name: "app_reservation")]


    public function reservation(Request $request, EntityManagerInterface $entityManager): Response
    {

        $reservation = new Reservation();
        $user = $this->getUser();

        // Vérifier si l'utilisateur est connecté

        if ($user) {
            $reservation->setUser($user)
                ->setFirstname($user->getFirstname())
                ->setEmail($user->getEmail())
                ->setLastname($user->getLastname());
            if ($user->getAllergies() !== null) {
                $reservation->setAllergies($user->getAllergiesAsString());
            } else {
                $reservation->setUser(null);
            }
        }

        /* Récupérer la limite de réservation depuis l'entité SeuilReservation
        $limitReservation = $this->entityManager->getRepository(LimitReservation::class)->find(1);
        $limite = $limitReservation->getLimite();

        // Compter le nombre de réservations existantes
        $countReservations = $this->entityManager->getRepository(Reservation::class)->count([]);

        // Vérifier si la limite de réservation est dépassée
        if ($countReservations >= $limite) {
            return $this->render('reservation/reservation_limit.html.twig', [
                'reservation' => $reservation
            ]);
        } */




        $form = $this->createForm(ReservationType::class, $reservation);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $time = $reservation->getTime();
                $date = $reservation->getDate();
                $limitReservation = $this->entityManager->getRepository(LimitReservation::class)->find(1);
                $limite = $limitReservation->getLimite();

                $reservations = $this->entityManager->getRepository(Reservation::class)->findBy(['time' => $time, 'date' => $date]);
                $reservationCount = count($reservations);
                if ($reservationCount >= $limite) { // Exemple de seuil de réservation à 5 réservations par heure
                    $this->addFlash('notice', 'Le nombre maximum de réservations pour cette heure a été atteint.');
                    // Afficher le formulaire
                    return $this->render('reservation/reservation.html.twig', [
                        'form' => $form->createView(),
                    ]);
                }

                // Enregistrer la réservation
                $entityManager->persist($reservation);
                $entityManager->flush();

                $mail = new Mail_reservation();
                $content = "Bonjour " . $reservation->getFirstname() . "<br/><br/> Votre réservation est confirmée <br/><br/><br/> Nous avons hâte de vous retrouver dans notre restaurant !";
                $mail->send($reservation->getEmail(), $reservation->getFirstname(), 'Réservation Le Quai Antique', $content);

                // Afficher un message de confirmation
                return $this->render('reservation/reservation_success.html.twig', [
                    'reservation' => $reservation
                ]);
            }
        }

        // Afficher le formulaire
        return $this->render('reservation/reservation.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
