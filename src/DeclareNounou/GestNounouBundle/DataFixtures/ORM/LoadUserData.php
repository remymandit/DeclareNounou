<?php
namespace DeclareNounou\GestNounouBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DeclareNounou\UserBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //create a test User
        $user = new User();
        $user->setEmail('moi@example.fr');
        $user->setPlainPassword('secret');
        $user->setUsername('moi');
        $user->setEnabled(true);
        $manager->persist($user);
        $manager->flush();
    }    
}
?>
