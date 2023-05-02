<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use App\Entity\Reservation;
use DateTime;
use DateTimeImmutable;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints\Time;

class ReservationType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('lastname', TextType::class, [
                'label' => 'Votre nom',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre nom'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre prénom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre adresse email',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre adresse email'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Numéro de téléphone',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre numéro de téléphone'
                ]
            ])
            ->add('guests', ChoiceType::class, [
                'label' => 'Nombre de convives',
                'choices' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ],
            ])
            ->add('date', DateType::class, [
                'label' => 'Date',
                'widget' => 'choice',
                'data' => new DateTime(),
                'format' => 'EEEE d MMMM yyyy',
                'years' => [
                    date('Y')
                ],
                'format' => 'dd/MM/yyyy',
            ])
            ->add('time', ChoiceType::class, [
                'label' => 'Heure',
                'choices' => [
                    '11:30' => '11:30',
                    '11:45' => '11:45',
                    '12:00' => '12:00',
                    '12:15' => '12:15',
                    '12:30' => '12:30',
                    '12:45' => '12:45',
                    '13:00' => '13:00',
                    '13:15' => '13:15',
                    '13:30' => '13:30',
                    '13:45' => '13:45',
                    '14:00' => '14:00',
                    '18:30' => '18:30',
                    '18:45' => '18:45',
                    '19:00' => '19:00',
                    '19:15' => '19:15',
                    '19:30' => '19:30',
                    '19:45' => '19:45',
                    '20:00' => '20:00',
                    '20:15' => '20:15',
                    '20:30' => '20:30',
                    '20:45' => '20:45',
                    '21:00' => '21:00',
                ]
            ])

            ->add('allergies', TextType::class, [
                'label' => 'Allergies',
                'attr' => [
                    'placeholder' => 'Vous pouvez saisir ici vos allergies'
                ],
                'required' => false,
            ])

            ->add('content', TextareaType::class, [
                'label' => 'Commentaire',
                'attr' => [
                    'placeholder' => 'Vous pouvez saisir ici un commentaire'
                ],
                'required' => false,
            ])


            ->add('submit', SubmitType::class, [
                'label' => 'Réserver',
                'attr' => [
                    'class' => 'btn-block btn-success'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
