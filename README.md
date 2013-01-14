     ******************************************************************************
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

Symfony2 Blood Alcohol Level calculator
=======================================

This is a demo application written in [Symfony2][1], based on [b0b][2].

1) Prerequisites
----------------
1. A running server stack such as [MAMP][3] or [XAMPP][4].

2. A working installation of [Git][5].

3. A working directory where you will store your project folder. This could be the web root of your local server.

4. A symbolic link to the PHP interpreter. In Mac OS X Terminal with MAMP already installed:

        $ cd /Applications/MAMP/htdocs/
        $ ln -s /Applications/MAMP/bin/php/php5.4.4/bin/php php

5. Composer. In Mac OS X Terminal, provided step 4 has been correctly completed:

        $ cd /Applications/MAMP/htdocs/
        $ curl -s https://getcomposer.org/installer | ./php

2) Installation
---------------

1. Go to your working directory

        $ cd /Applications/MAMP/htdocs/

2. Clone the GitHub project to your working directory:

        $ git clone https://github.com/OlivierParent/b0b-SF2.git b0b-SF2

3. Create the database schema with `app/src/Ahs/BobBundle/Resources/doc/Schema.sql`

4. Add [`app/config/parameters.yml`][6] to match your database configuration. 

5. Go to the project folder

        $ cd b0b-SF2

6. Install Symfony2 Standard Edition with composer

        $ ../php ../composer.phar install

7. Optionally, install the assets as a symbolic link

        $ ../php app/console assets:install --symlink

3) Test
-------
Open [`http://localhost/b0b-SF2/web/`][7] or [`http://localhost/b0b-SF2/web/app_dev.php`][8] in your browser to test the installation.

[1]:  http://symfony.com/
[2]:  https://github.com/OlivierParent/b0b
[3]:  http://www.mamp.info/
[4]:  http://www.apachefriends.org/
[5]:  http://git-scm.com/
[6]:  https://gist.github.com/4529627
[7]:  http://localhost/b0b-SF2/web/
[8]:  http://localhost/b0b-SF2/web/app_dev.php
