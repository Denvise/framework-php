<?php

namespace Form;

use Entities\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class CommentType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pseudo', TextType::class,
            array(
                'constraints' => array(
                    new NotBlank(),
                    ),
            ))
            ->add('commentaire', TextareaType::class, array(
                'constraints' => array(
                    new NotBlank()
                )
            ));

    }

}