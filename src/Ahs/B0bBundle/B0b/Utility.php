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
 * Abstracte klasse met statische utilitymethodes.
 *
 * @author     Olivier Parent
 * @copyright  Copyright (c) 2012 Artevelde University College Ghent
 */
namespace Ahs\B0bBundle\B0b;

class Utility
{
    /**
     * Bereken een hash-code voor een karakterstring op basis van de HMAC-methode.
     * Indien geen $algo opgegeven wordt, dan wordt de SHA-256 (Secure Hash
     * Algorithm 256-bit) gebruikt om een hash-code met 64 tekens te genereren.
     *
     * @static
     * @param string  $data Data that has to be hashed.
     * @param string  $algo Algorithm used, sha256 by default.
     * @param boolean $timed Add a microtime to the key.
     * @return string
     */
    public static function hash($data, $algo = 'sha256', $timed = false)
    {
        $key = 'Dit wordt nooit geraden!'; // Dit maakt de hash-code uniek voor deze toepassing, voorkomt aanvallen d.m.v. Rainbow Tables (http://nl.wikipedia.org/wiki/Rainbow_table)

        if ($timed) {
            // Zie: http://www.php.net/manual/en/function.microtime.php
            $key .= microtime();
        }
        // Zie: http://www.php.net/manual/en/function.hash-hmac.php
        return hash_hmac($algo, $data, $key); // Hash-based Message Authentication Code
    }

    public static function debug($var, $exit = true)
    {
        echo '<pre>';
        var_dump($var);
        if ($exit) exit;
    }
}