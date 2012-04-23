<?php

namespace Jbl\StudioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PhoneType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('available', null, array('required' => false))
        ;
    }

    public function getName()
    {
        return 'jbl_studiobundle_phonetype';
    }
}
