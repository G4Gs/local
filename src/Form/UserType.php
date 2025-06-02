<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, [
                'attr' => [
                    'class' => 'home-input'
                ],
                'label_attr' => [
                    'class' => 'home-label'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'El correo es obligatorio.']),
                    new Email(['message' => 'Ingrese un correo válido.']),
                ]
            ])
            ->add('nombre', null, [
                'attr' => [
                    'class' => 'home-input'
                ],
                'label_attr' => [
                    'class' => 'home-label'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'El nombre es obligatorio.']),
                    new Regex([
                        'pattern' => '/^[\p{L}]+$/u',
                        'message' => 'El nombre solo debe contener letras.'
                    ]),
                ]
            ])
            ->add('apellido', null, [
                'attr' => [
                    'class' => 'home-input'
                ],
                'label_attr' => [
                    'class' => 'home-label'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'El apellido es obligatorio.']),
                    new Regex([
                        'pattern' => '/^[\p{L}]+$/u',
                        'message' => 'El apellido solo debe contener letras.'
                    ]),
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Usuario'=> 'ROLE_USER',
                    'Administrador'=> 'ROLE_SUPER_ADMIN', 
                    'Directivo'=> 'ROLE_ADMIN', 
                    'Docente' => 'ROLE_DOCENTE',  
                    'Estudiante' => 'ROLE_ESTUDIANTE',  
                ],
                'expanded' => false, 
                'multiple' => true,   
                'label' => '* Roles',
                'attr' => [
                    'class' => 'home-input'
                ],
                'label_attr' => [
                    'class' => 'home-label'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => '* Password',
                    'attr' => [
                        'class' => 'home-input'
                    ],
                    'label_attr' => [
                        'class' => 'home-label'
                    ]
                ],
                'second_options' => [
                    'label' => '* Repetir Password',
                    'attr' => [
                        'class' => 'home-input'
                    ],
                    'label_attr' => [
                        'class' => 'home-label'
                    ]
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
