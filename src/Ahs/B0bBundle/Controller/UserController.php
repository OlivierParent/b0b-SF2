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

use Ahs\B0bBundle\Entity\User;
use Ahs\B0bBundle\Form\Type\LoginType;
use Ahs\B0bBundle\Form\Type\RegisterType;

class UserController extends Controller
{
    public function loginAction(Request $request)
    {
        $request->setLocale($request->getPreferredLanguage());

        $user = new User();

        $form = $this->createForm(new LoginType(), $user);

        if ($request->isMethod('POST')) { // Case sensitive!
            $form->bind($request);

            if ($form->isValid()) {

                $user = $this->getDoctrine()
                             ->getRepository('AhsB0bBundle:User')
                             ->findBy(array(
                                 'email'    => $user->getEmail(),
                                 'password' => $user->getPassword(),
                             ));

                //\Ahs\B0bBundle\B0b\Utility::debug($user);
                if ($user) {
                    return $this->redirect($this->generateUrl('ahs_b0b_homepage'));
                } else {
                    echo 'not oke';
                }
            }

        }

        return $this->render('AhsB0bBundle:User:login.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function registerAction(Request $request)
    {
        $request->setLocale($request->getPreferredLanguage());

        $user = new User();

        $form = $this->createForm(new RegisterType(), $user);

        if ($request->isMethod('POST')) { // Case sensitive!
            $form->bind($request);

            if ($form->isValid()) {

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user); // Manage entity User for persistance.
                $entityManager->flush();        // Persist all managed entities.

                return $this->redirect($this->generateUrl('ahs_b0b_homepage'));
            }
        }

        return $this->render('AhsB0bBundle:User:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}