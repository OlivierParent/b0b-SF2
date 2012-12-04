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
 * Klasse om het bloedalcoholgehalte te berekenen.
 *
 * @author     Olivier Parent
 * @copyright  Copyright (c) 2012 Artevelde University College Ghent
 */
namespace Ahs\B0bBundle\B0b;

use Ahs\B0bBundle\Entity\User;

class BloodAlcoholLevel
{
    /**
     * Gebruikerobject.
     *
     * @var Model\User
     */
    protected $_user; // Aanspreken met $this->User dankzij klasse Object\Object.
    /**
     * Aantal eenheden alcohol.
     *
     * @var integer
     */
    protected $_units; // Aanspreken met $this->Units dankzij klasse Object\Object.
    /**
     * Aantal uren
     *
     * @var integer
     */
    protected $_hours; // Aanspreken met $this->Hours dankzij klasse Object\Object.

    /**
     *
     * @var Symfony\Component\Translation\Translator
     */
    protected $_translator;


    /**
     * Magische methode voor de constructor.
     *
     * @param Model\User $user
     * @param integer    $units
     * @param integer    $hours
     */
    public function __construct(User $user, $units = 0, $hours = 0)
    {
        $this->setUser($user);
        $this->setUnits($units);
        $this->setHours($hours);
    }

    /**
     * Magische methode die uitgevoerd wordt op het ogenblik dat het object
     * naar een string gecast wordt.
     *
     * @return string
     */
    public function __toString()
    {
        $bal = $this->_calculate();

        $translator = $this->getTranslator();

        if       ($bal <= 0  ) {
            $bal = 0;
            $nickname = $translator->trans('Taxi b0b', array(), 'b0b');
            $comment  = $translator->trans('You’ll get home safely without any problems.', array(), 'b0b');
        } elseif ($bal <= 0.5) {
            $nickname = $translator->transChoice('Risky Ronald|Risky Rita', $this->getUser()->getGender() == 'm', array(), 'b0b');
            $comment  = $translator->trans('You’ll probably get home without too many scratches.', array(), 'b0b');
        } elseif ($bal <= 1.5) {
            $nickname = $translator->transChoice('Tipsy Timmy|Tipsy Trixy', $this->getUser()->getGender() == 'm', array(), 'b0b');
            $comment  = $translator->trans('Fun assured … up to the first bend.', array(), 'b0b');
        } elseif ($bal <= 3  ) {
            $nickname = $translator->transChoice('Wasted Wally|Wasted Wanda', $this->getUser()->getGender() == 'm', array(), 'b0b');
            $comment  = $translator->trans('You’re suicidal if you drive home with this b0b.', array(), 'b0b');
        } elseif ($bal <= 4  ) {
            $gender = $this->getUser()->getGender() == 'm';
            $nickname = $translator->transChoice('Tommy Totalloss|Tory Totalloss', $gender, array(), 'b0b');
            $comment  = $translator->transChoice('You’re safe. He won’t find his car tonight anyway.|You’re safe. She won’t find her car tonight anyway.', $gender, array(), 'b0b');
        } else {
            $gender = $this->getUser()->getGender() == 'm';
            $nickname = $translator->transChoice('Coma Correy|Coma Conny', $gender, array(), 'b0b');
            if ($this->getUnits() < 20) {
                $comment  = $translator->transChoice('Dump the bro in the trunk … together with the keys.|Dump the ho in the trunk … together with the keys.', $gender, array(), 'b0b');
            } else {
                $comment  = $translator->transChoice('Tha damn dog ain’t drivin’ no moh. 4 like 4evah.|Tha damn bitch ain’t drivin’ no moh. 4 like 4evah.', $gender, array(), 'b0b');
            }
        }

        // See: http://be.php.net/manual/en/function.sprintf.php
        $message = $translator->trans('<p>Blood Alcohol Level: %.2f ‰.<br>Bob’s nickname is: ’<strong>%s</strong>’!</p><p>%s</p>', array(), 'b0b');
        return sprintf($message, $bal, $nickname, $comment);
    }

    /**
     * Berekent het bloedalcoholgehalte (blood alcohol level).
     *
     * @return float
     */
    protected function _calculate()
    {
        // Het deel van het gewicht dat alcohol kan opnemen is geslachtsafhankelijk
        $ratio = ($this->getUser()->getGender() == 'm') ? 0.7 : 0.5;

        // Bloedalcoholgehalte berekenen en teruggeven
        return ($this->getUnits() * 10 ) / ($this->getUser()->getWeight() * $ratio)
             - ($this->getHours() - 0.5) * ($this->getUser()->getWeight() * 0.002 );
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function setUser($user)
    {
        $this->_user = $user;
    }

    public function getUnits()
    {
        return $this->_units;
    }

    public function setUnits($units)
    {
        $this->_units = $units;
    }

    public function getHours()
    {
        return $this->_hours;
    }

    public function setHours($hours)
    {
        $this->_hours = $hours;
    }

    public function getTranslator()
    {
        return $this->_translator;
    }

    public function setTranslator($translator)
    {
        $this->_translator = $translator;
    }
}