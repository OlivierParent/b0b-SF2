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

namespace Ahs\B0bBundle\Entity;

use Ahs\B0bBundle\B0b\Utility;
use Doctrine\ORM\Mapping as ORM; // Import ORM annotations prefix

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(name="usr_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(name="usr_givenname", type="string", length=255)
     * @var string Given name
     */
    protected $givenname;

    /**
     * @ORM\Column(name="usr_familyname", type="string", length=255)
     * @var string Family name
     */
    protected $familyname;

    /**
     * @ORM\Column(name="usr_email", type="string", length=255)
     * @var string Email address
     */
    protected $email;

    /**
     * @ORM\Column(name="usr_password", type="string", columnDefinition="CHAR(64) NOT NULL")
     * @var string Hashed password
     */
    protected $password;
    protected $passwordRaw;

    /**
     * @ORM\Column(name="usr_gender", type="string", columnDefinition="ENUM('m', 'f') NOT NULL")
     * @var string Gender
     */
    protected $gender;

    /**
     * @ORM\Column(name="usr_weight", type="float")
     * @var float Weight
     */
    protected $weight;

    public function __construct($weight = null, $gender = null)
    {
        $this->setWeight($weight);
        $this->setGender($gender);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getGivenname()
    {
        return $this->givenname;
    }

    public function setGivenname($givenname)
    {
        $this->givenname = $givenname;
    }

    public function getFamilyname()
    {
        return $this->familyname;
    }

    public function setFamilyname($familyname)
    {
        $this->familyname = $familyname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPasswordRaw()
    {
        return $this->getPassword();
    }

    public function setPasswordraw($password)
    {
        $this->setPassword(Utility::hash($password));
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getRemember()
    {
        return $this->remember;
    }

    public function setRemember($remember)
    {
        $this->remember = $remember;
    }
}