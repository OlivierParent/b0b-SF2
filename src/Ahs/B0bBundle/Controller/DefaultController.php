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
namespace Ahs\B0bBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ahs\B0bBundle\B0b\BloodAlcoholLevel;
use Ahs\B0bBundle\Entity\User;
use Ahs\B0bBundle\Form\Type\HomeType;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $request->setLocale($request->getPreferredLanguage());


        $user = $this->get('security.context')
                     ->getToken()
                     ->getUser();

        if (is_object($user)) {
            $data = array(
                'gender' => $user->getGender(),
                'weight' => $user->getWeight(),
            );
        } else {
            $data = array();
        }

        $form = $this->createForm(new HomeType(), $data);

        if ($request->isMethod('POST')) { // Case sensitive!
            $form->bind($request);

            $post = $request->request->get('home');

            $user = new User($post['gender'], $post['weight']);

            $bal = new BloodAlcoholLevel($user, $post['units'], $post['hours']);
            $bal->setTranslator($this->get('translator'));
        } else {
            $bal = null;
        }

        return $this->render('AhsB0bBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
            'bal'  => $bal,
        ));
    }
}