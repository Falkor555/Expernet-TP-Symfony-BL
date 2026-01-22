<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $creneaux = $this->genererCreneauxHoraires();

        $builder
            ->add('dateLivraison', DateType::class, [
                'widget' => 'single_text',
                'label' => '📅 Date de livraison',
                'html5' => true,
                'attr' => [
                    'min' => (new \DateTime('tomorrow'))->format('Y-m-d'),
                    'class' => 'form-control',
                ],
                'help' => 'La Pâtisserie Ancelly est ouverte du mardi au dimanche (nous sommes fermés le lundi)'
            ])
            ->add('creneau', ChoiceType::class, [
                'mapped' => false,
                'label' => '⏰ Créneau horaire',
                'choices' => $creneaux,
                'attr' => [
                    'class' => 'form-select',
                ],
                'placeholder' => 'Choisir un créneau horaire',
                'help' => 'Vous pouvez récupérer votre commande de 6h00 à 18h30'
            ])
        ;

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $commande = $event->getData();
            $form = $event->getForm();
            $date = $commande->getDateLivraison();
            $creneau = $form->get('creneau')->getData();

            if ($date && $creneau) {
                $dateTime = new \DateTime($date->format('Y-m-d') . ' ' . $creneau);
                
                if ($dateTime->format('N') == 1) {
                    $form->get('dateLivraison')->addError(
                        new \Symfony\Component\Form\FormError('La pâtisserie est fermée le lundi.')
                    );
                    return;
                }
                
                $commande->setDateLivraison($dateTime);
                $commande->setHeureLivraison($dateTime);
            }
        });
    }

    private function genererCreneauxHoraires(): array
    {
        $creneaux = [];
        
        for ($hour = 6; $hour <= 18; $hour++) {
            foreach ([0, 30] as $minute) {
                if ($hour === 18 && $minute === 30) {
                    continue;
                }
                
                $time = sprintf('%02d:%02d', $hour, $minute);
                $label = sprintf('%02dh%02d', $hour, $minute);
                $creneaux[$label] = $time;
            }
        }
        
        return $creneaux;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
