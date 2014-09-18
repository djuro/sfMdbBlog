<?php
namespace Acme\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname','text',array('required'=>true))
            ->add('lastname', 'text',array('required'=>true))
            ->add('email', 'text',array('required'=>true))
            ->add('password', 'text',array('required'=>true));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\BlogBundle\Form\Model\User',
        ));
    }

    public function getName()
    {
        return 'user';
    }
}