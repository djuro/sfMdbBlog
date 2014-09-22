<?php
namespace Acme\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text',array('required'=>true))
            ->add('body', 'textarea',array('required'=>true))
            ->add('tags', 'text',array('required'=>true))
            ->add('slug','text',array('required'=>true));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\BlogBundle\Form\Model\Post',
        ));
    }

    public function getName()
    {
        return 'post';
    }
}