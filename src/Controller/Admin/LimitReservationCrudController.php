<?php

namespace App\Controller\Admin;

use App\Entity\LimitReservation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class LimitReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LimitReservation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('limite', 'Limite de réservation par heure ')
                ->setHelp('Entrez le nombre maximum de réservations autorisées'),
        ];
    }
}
