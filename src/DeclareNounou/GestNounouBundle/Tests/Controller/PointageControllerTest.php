<?php

namespace DeclareNounou\GestNounouBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PointageControllerTest extends WebTestCase
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
        $crawler = $client->request('GET', '/pointage/');
        $this->assertCount(2, $crawler->filter('td:contains("10:00 h")'), 'Mising element td:contains("10:00 h")');
        $this->assertCount(1, $crawler->filter('td:contains("2 janv. 2014")'), 'Mising element td:contains("2 janv. 2014")');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /pointage/");
        $crawler = $client->click($crawler->selectLink('Ajouter un pointage')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Ajouter')->form(array(
            'declarenounou_gestnounoubundle_pointage[datePointage][day]'  => 5,
            'declarenounou_gestnounoubundle_pointage[datePointage][year]'  => 2014,
            'declarenounou_gestnounoubundle_pointage[heureDebut][hour]'  => 8,
            'declarenounou_gestnounoubundle_pointage[heureDebut][minute]'  => 30,
            'declarenounou_gestnounoubundle_pointage[heureFin][hour]'  => 14,
            'declarenounou_gestnounoubundle_pointage[heureFin][minute]'  => 30,
            'declarenounou_gestnounoubundle_pointage[heuresRealiseesPointage]'  => '6',
            'declarenounou_gestnounoubundle_pointage[heuresComplementaires]'  => '2',
            'declarenounou_gestnounoubundle_pointage[heuresNormales]'  => '4',
        ));
        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertCount(1, $crawler->filter('td:contains("08:30")'), 'Missing element td:contains("08:30")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Modifier la fiche')->link());
        $form = $crawler->selectButton('Modifier')->form(array(
            'declarenounou_gestnounoubundle_pointage[heureDebut][hour]'  => 7,
        ));
        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertCount(1, $crawler->filter('td:contains("07:30")'), 'Missing element td:contains("07:30")');

        // Delete the entity
        $client->submit($crawler->selectButton('Supprimer')->form());

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/7/', $client->getResponse()->getContent());
    }
}
