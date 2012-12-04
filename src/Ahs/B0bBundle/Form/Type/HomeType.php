<?php
/******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                        aaaAAaaa            HHHHHH                          *
 *                     aaAAAAAAAAAAaa         HHHHHH                          *
 *                    aAAAAAAAAAAAAAAa        HHHHHH                          *
 *                   aAAAAAAAAAAAAAAAAa       HHHHHH                          *
 *                   aAAAAAa    aAAAAAA                                       *
 *                   AAAAAa      AAAAAA                                       *
 *                   AAAAAa      AAAAAA                                       *
 *                   aAAAAAa     AAAAAA                                       *
 *                    aAAAAAAaaaaAAAAAA       HHHHHH                          *
 *                     aAAAAAAAAAAAAAAA       HHHHHH                          *
 *                      aAAAAAAAAAAAAAA       HHHHHH                          *
 *                         aaAAAAAAAAAA       HHHHHH                          *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *      a r t e v e l d e  u n i v e r s i t y  c o l l e g e  g h e n t      *
 *                                                                            *
 *                                                                            *
 *                                 MEMBER OF GHENT UNIVERITY ASSOCIATION      *
 *                                                                            *
 *                                                                            *
 ******************************************************************************
 *
 * @author     Olivier Parent
 * @copyright  Copyright (c) 2012 Artevelde University College Ghent
 */
namespace Ahs\B0bBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class HomeType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $units = array();
        $units[] = '-';
        for ($i = 1; $i <= 30; $i++) {
            $units[] = $i;
        }

        $builder->add('gender', new GenderType(), array(
                     'expanded' => true,
                     'label' => 'b0b is',
                ))
                ->add('weight', 'text', array(
                    'attr' => array(
                        'maxlength' => 3,
                    ),
                    'label' => 'and weighs',
                ))
                ->add('units'        , 'choice', array(
                    'choices' => $units,
                    'label' => 'b0b drank',
                ))
                ->add('hours'  , 'text', array(
                    'attr' => array(
                        'maxlength' => 2,
                    ),
                    'label' => 'in',
                ))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'home';
    }
}