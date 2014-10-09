<?php

namespace DeclareNounou\GestNounouBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContratControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // User registration
        $crawler = $client->request('GET','/fr/login');
        $this->assertGreaterThan(0,$crawler->filter('html:contains("Connexion")')->count());
        $form = $crawler->selectButton('Connexion')->form(array(
            '_username' => 'moi',
            '_password' => 'secret1',
        ));
        $client->submit($form);

        // Create a new entry in the database
        $crawler = $client->request('GET', '/contrat/');
        $this->assertCount(1, $crawler->filter('td:contains("Daudet Alphonse")'), 'Missing element td:contains("Daudet Alphonse")');
        $this->assertCount(1, $crawler->filter('td:contains("Duras Marguerite")'), 'Missing element td:contains("Duras Marguerite")');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /contrat/");
        $crawler = $client->click($crawler->selectLink('Ajouter un contrat')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Ajouter')->form(array(
            'DeclareNounou_gestnounoubundle_contrat[dateFin][day]'  => 2,
            'DeclareNounou_gestnounoubundle_contrat[heuresMensuelles]'  => '150',
            'DeclareNounou_gestnounoubundle_contrat[tarifHoraire]'  => '4.5',
            'DeclareNounou_gestnounoubundle_contrat[tarifRepas]'  => '2.5',
            'DeclareNounou_gestnounoubundle_contrat[tarifIndemnite]'  => '0.33',
        ));
        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertCount(1, $crawler->filter('td:contains("150")'), 'Missing element td:contains("120")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Modifier la fiche')->link());
        $form = $crawler->selectButton('Modifier')->form(array(
            'DeclareNounou_gestnounoubundle_contrat[heuresMensuelles]'  => '75',
        ));
        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertCount(1, $crawler->filter('[value="75"]'), 'Missing element [value="75"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Supprimer')->form());

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/75/', $client->getResponse()->getContent());
    }
}
