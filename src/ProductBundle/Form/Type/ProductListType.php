<?php

namespace ProductBundle\Form\Type;

use ProductBundle\Entity\ProductList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProductListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('description');
        $builder->add('products', CollectionType::class, array(
            'entry_type' => ProductType::class,
            'allow_add'    => true,
        ));
        
        $builder->add('save', SubmitType::class, array('label' => 'SAVE'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ProductList::class,
        ));
    }
}

