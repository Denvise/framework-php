<?php

namespace Form;

use Entities\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditType extends AbstractType{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add('titre', TextType::class,
            array(
                'attr' => array(
                    'placeholder' => '',
                ),
                'constraints' => array(
                    new NotBlank(),
                ),
            ))
            ->add('contenu', TextareaType::class, array(
                'attr' => array(
                'placeholder' => '',
                ),
                'constraints' => array(
                    new NotBlank()
                )
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Article::class,
        ));
    }

    public function getName(){
        return 'form_editarticle';
    }

}