<?php

namespace App\Form;

use App\Entity\Korisnici;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email' , EmailType::class ,['label'=>'Email:', 'attr' => array('class' => 'form-control')])
            ->add('Lozinka', RepeatedType::class, [
                 'type' => PasswordType::class,
                  'invalid_message' => 'Lozinke se moraju podudarati!',
                 'options'=>['attr' => array('class' => 'form-control')],
                'label'=>'Lozinka:',
                'mapped' => false,
                'required' => true,
                'first_options'  => ['label' => 'Lozinka'],
                'second_options' => ['label' => 'Ponovljena lozinka'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Unesite lozinku',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Lozinka treba imati minimalno {{ limit }} znakova',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('Status', ChoiceType::class, [
              'empty_data' => 'izvnredni',
              'choices'  => [
                'izvanredni studij' => 'izvanredni',
                'redovni studij' => 'redovni',
                    ]


  ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Korisnici::class,
        ]);
    }
}
