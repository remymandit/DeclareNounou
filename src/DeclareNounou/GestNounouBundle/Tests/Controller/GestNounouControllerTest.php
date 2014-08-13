<?php
namespace DeclareNounou\GestNounouBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GestNounouControllerTest extends WebTestCase
{
    /**
     * test the redirection to the login page
     */
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET','/');
        $this->assertTrue($client->getResponse() instanceof \Symfony\Component\HttpFoundation\RedirectResponse);
        $this->assertRegExp('/login/',$client->getResponse()->headers->get('location'));
    }
    /**
     * test support language fr on the login page
     */
    public function testFrLoginIndex()
    {
        $client = static::createClient();
        $fr_crawler = $client->request('GET', '/fr/login');
        $this->assertGreaterThan(0,$fr_crawler->filter('html:contains("Connexion")')->count());
    }
}
?>
