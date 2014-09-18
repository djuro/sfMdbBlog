<?php
namespace Acme\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

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

    public function getName()
    {
        return 'user';
    }
}