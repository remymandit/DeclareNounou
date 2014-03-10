<?php
namespace DeclareNounou\GestNounouBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DeclareNounou\UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //create test users
        $user1 = new User();
        $user1->setEmail('moi@example.fr');
        $user1->setPlainPassword('secret1');
        $user1->setUsername('moi');
        $user1->setEnabled(true);
        
        $user2 = new User();
        $user2->setEmail('toi@example.fr');
        $user2->setPlainPassword('secret2');
        $user2->setUsername('toi');
        $user2->setEnabled(true);
        
        $manager->persist($user1);
        $manager->persist($user2);
        $manager->flush();
        
        $this->addReference('user1', $user1);
        $this->addReference('user2', $user2);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
?>