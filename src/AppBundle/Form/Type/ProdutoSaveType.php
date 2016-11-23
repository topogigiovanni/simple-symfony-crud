<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProdutoSaveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomeProduto', null, array(
                'required' => true,
            ))
            ->add('idCategoriaProduto', EntityType::class, array(
			    'class' => 'AppBundle:CategoriaProduto',
			    'choice_label' => 'nomeCategoria',
			    'choice_value' => 'idCategoriaPlanejamento',
			    'label' => 'categoria'
			))
            ->add('valorProduto', MoneyType::class, array(
                'required' => true,
                'currency' => 'BRL',
                'label' => 'valor'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'data_class' => 'AppBundle\Entity\Produto'
        ));
    }

    public function getName()
    {
        return 'produto_save_type';
    }
}