<?php

namespace Jbl\StudioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('address')
            ->add('phone')
            ->add('info')
        ;
    }

    public function getName()
    {
        return 'jbl_studiobundle_contacttype';
    }
}
