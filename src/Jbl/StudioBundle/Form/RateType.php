<?php

namespace Jbl\StudioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RateType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('value')
        ;
    }

    public function getName()
    {
        return 'jbl_studiobundle_ratetype';
    }
}
