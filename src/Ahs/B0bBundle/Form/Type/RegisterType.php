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
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('givenname'     , 'text', array(
                    'attr' => array('placeholder' => 'Given name')
                ))
                ->add('familyname'    , 'text', array(
                    'attr' => array('placeholder' => 'Family name')
                ))
                ->add('email'         , 'email', array(
                    'attr' => array('placeholder' => 'Email address')
                ))
                ->add('password'      , 'repeated', array(
                    'type'           => 'password',
                    'first_name'     => 'password',
                    'second_name'    => 'confirm',
                    'first_options'  => array (
                        'label' => 'Password',
                        'attr'  => array('placeholder' => 'Password'),
                     ),
                    'second_options' => array (
                        'label' => 'Password (repeat)',
                        'attr'  => array('placeholder' => 'Password (repeat)'),
                     ),
                     'invalid_message' => 'The passwords are not identical.',
                ))
                ->add('gender', new GenderType(), array(
                     'expanded' => true,
                ))
                ->add('weight', 'text', array(
                    'attr' => array(
                        'maxlength' => 3,
                    ),
                ))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'register';
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' => array('registration'),
        ));
    }
}