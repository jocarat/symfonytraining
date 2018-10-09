<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 09/10/2018
 * Time: 16:35
 */

namespace App\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\Model\ContactModel;

class ContactType extends AbstractType
{
    const PLACEHOLDER = 'placeholder';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'required' => false,
                'attr' => [
                    self::PLACEHOLDER => 'Your Firstname',
                ],
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    self::PLACEHOLDER => 'Your Lastname',
                ],
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    self::PLACEHOLDER => 'Your E-Mail Address',
                ],
            ])
            ->add('subject', TextType::class, [
                'attr' => [
                    self::PLACEHOLDER => 'Subject of your message ',
                ],
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    self::PLACEHOLDER => 'Your message',
                ],
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactModel::class,
        ]);
    }
}