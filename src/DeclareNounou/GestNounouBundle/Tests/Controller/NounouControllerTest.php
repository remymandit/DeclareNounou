<?php

namespace DeclareNounou\GestNounouBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NounouControllerTest extends WebTestCase
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
        
        // Create a new entry in the database
        $crawler = $client->request('GET', '/nounou/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /nounou/");
        $crawler = $client->click($crawler->selectLink('Ajouter une nourrice')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Ajouter')->form(array(
            'DeclareNounou_gestnounoubundle_nounou[nom]'  => 'Test',
            'DeclareNounou_gestnounoubundle_nounou[prenom]'  => 'Test',
            'DeclareNounou_gestnounoubundle_nounou[adresse]'  => '5 rue du four',
            'DeclareNounou_gestnounoubundle_nounou[codePostal]'  => '55400',
            'DeclareNounou_gestnounoubundle_nounou[ville]'  => 'Etain',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertCount(2, $crawler->filter('td:contains("Test")'), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Modifier la fiche')->link());
        $form = $crawler->selectButton('Modifier')->form(array(
            'DeclareNounou_gestnounoubundle_nounou[nom]'  => 'Foo',
            'DeclareNounou_gestnounoubundle_nounou[prenom]'  => 'Foo',
        ));
        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertCount(2, $crawler->filter('[value="Foo"]'), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Supprimer')->form());

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }
}
