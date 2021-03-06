<?php

namespace Form;

use Entities\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Tests\Extension\Core\Type\CheckboxTypeTest;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CommentType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pseudo', TextType::class, [ 'label' => 'Votre pseudo : ' ],
            array(
                'constraints' => array(
                    new NotBlank(),
                    ),
            ))
            ->add('msg', TextareaType::class, [ 'label' => 'Votre commentaire : ' ], array(
                'constraints' => array(
                    new NotBlank()
                ),

            ))
            ->add('prioritaire', CheckboxType::class, ['required' => false]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Commentaire::class,
        ));
    }

    public function getName(){
        return 'form_comment';
    }

}