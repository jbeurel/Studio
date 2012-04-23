<?php

namespace Jbl\StudioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class WeekType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
//             ->add('start')
//             ->add('end')
//             ->add('isFree')
            ->add('contact', 'entity', array('class' => 'JblStudioBundle:Contact', 'property' => 'lastName'))
		;
    }
    
    public function getDefaultOptions(array $options)
    {
    	return array(
	    	'data_class' => 'Jbl\StudioBundle\Entity\Week',
	    );
    }

    public function getName()
    {
        return 'jbl_studiobundle_weektype';
    }
}
