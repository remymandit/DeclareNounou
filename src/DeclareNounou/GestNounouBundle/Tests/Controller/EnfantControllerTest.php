<?php

namespace DeclareNounou\GestNounouBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EnfantControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();
        
        // User registration
        $crawler = $client->request('GET','/fr/login');
        $this->assertGreaterThan(0,$crawler->filter('h3:contains("Connexion")')->count());
        $form = $crawler->selectButton('Connexion')->form(array(
            '_username' => 'moi',
            '_password' => 'secret',
        ));
        $client->submit($form);
        $crawler = $client->followRedirect();
        
        // Create a new entry in the database
        $crawler = $client->request('GET', '/enfant/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /enfant/");
        $crawler = $client->click($crawler->selectLink('Ajouter un enfant')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Ajouter')->form(array(
            'DeclareNounou_gestnounoubundle_enfant[nom]'  => 'Test',
            'DeclareNounou_gestnounoubundle_enfant[prenom]'  => 'Test',
        ));
        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertCount(2, $crawler->filter('td:contains("Test")'), 'Missing element td:contains("Test")');
        
        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Modifier la fiche')->link());
        $form = $crawler->selectButton('Modifier')->form(array(
            'DeclareNounou_gestnounoubundle_enfant[nom]'  => 'Foo',
            'DeclareNounou_gestnounoubundle_enfant[prenom]'  => 'Foo',
        ));
        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertCount(2, $crawler->filter('[value="Foo"]'), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Supprimer')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
        
    }
}
