<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotNull;

class PostType extends AbstractType
{
    /**
     * Undocumented function
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("title",TextType::class,[
                "label"=>"Titre :", 
            ])
            ->add("content",TextareaType::class,[
                "label"=>"Article :"
            ])
            ->add("file",FileType::class,[
                "required"=> false,
                "mapped"=> false,
                "constraints"=> [
                    new Image(),
                    new NotNull([
                        "groups"=> "create",
                    ])
                ],
            ])
            
            ;
    }
    /**
     * Undocumented function
     *
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("data_class",Post::class);
    }
}