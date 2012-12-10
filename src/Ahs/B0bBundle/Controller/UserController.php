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
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContext;

use Ahs\B0bBundle\Entity\User;
use Ahs\B0bBundle\Form\Type\RegisterType;

class UserController extends Controller
{
    public function loginAction(Request $request)
    {
        $request->setLocale($request->getPreferredLanguage());

        $session = $request->getSession();
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(      SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('AhsB0bBundle:User:login.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }

    public function registerAction(Request $request)
    {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $request->setLocale($request->getPreferredLanguage());

        $user = new User();

        $form = $this->createForm(new RegisterType(), $user);

        if ($request->isMethod('POST')) { // Case sensitive!
            $form->bind($request);

            if ($form->isValid()) {

                // Hash password with Security Encoder Factory service
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
                $user->setPassword($password);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user); // Manage entity User for persistance.
                $entityManager->flush();        // Persist all managed entities.

                return $this->redirect($this->generateUrl('ahs_b0b_home'));
            }
        }

        return $this->render('AhsB0bBundle:User:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}