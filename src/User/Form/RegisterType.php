<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 09/10/2018
 * Time: 16:35
 */

namespace App\User\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    const PLACEHOLDER = 'placeholder';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    self::PLACEHOLDER => 'Your Username',
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                    'first_options' => [
                        'label' => 'Password',
                        'attr' => [
                            self::PLACEHOLDER => 'Your Password',
                        ],
                    ],
                    'second_options' => [
                        'label' => 'Password',
                        'attr' => [
                            self::PLACEHOLDER => 'Re-type Password',
                        ],
                    ],
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegisterModel::class,
        ]);
    }
}