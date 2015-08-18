<?php

namespace DeclareNounou\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DeclareNounouUserBundle extends Bundle
{
    /**
     * héritage du bundle FOSUser.
     *
     * @return string
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
