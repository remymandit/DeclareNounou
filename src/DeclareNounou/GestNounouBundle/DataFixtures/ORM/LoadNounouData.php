<?php
namespace DeclareNounou\GestNounouBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DeclareNounou\GestNounouBundle\Entity\Nounou;

class LoadNounouData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //create test nounous
        $nounou1 = new Nounou();
        $nounou1->setNom('Duras');
        $nounou1->setPrenom('Marguerite');
        $nounou1->setAdresse('5 rue ici');
        $nounou1->setCodePostal('75000');
        $nounou1->setVille('Paris');
        $nounou1->setDateNaissance(new \DateTime('1975-01-01'));
        $nounou1->setUser($this->getReference('user1'));

        $nounou2 = new Nounou();
        $nounou2->setNom('Goya');
        $nounou2->setPrenom('Chantal');
        $nounou2->setAdresse('2 place là');
        $nounou2->setCodePostal('57000');
        $nounou2->setVille('Metz');
        $nounou2->setDateNaissance(new \DateTime('1960-02-02'));
        $nounou2->setUser($this->getReference('user2'));

        $manager->persist($nounou2);
        $manager->persist($nounou1);
        $manager->flush();

        $this->addReference('nounou1', $nounou1);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }
}
