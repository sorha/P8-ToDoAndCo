<?php

namespace App\Tests\Controller;

use App\Tests\Controller\SecurityControllerTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function testListActionWithoutLogin()
    {
        // If the user isn't logged, should redirect to the login page
        $client = static::createClient();
        $client->request('GET', '/tasks');
        static::assertSame(302, $client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect();
        // Test if login field exists
        static::assertSame(1, $crawler->filter('input[name="_username"]')->count());
        static::assertSame(1, $crawler->filter('input[name="_password"]')->count());
    }

    public function testListAction()
    {
        $securityControllerTest = new SecurityControllerTest();
        $client = $securityControllerTest->testLogin();

        $crawler = $client->request('GET', '/tasks');
        static::assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testCreateAction()
    {
        $securityControllerTest = new SecurityControllerTest();
        $client = $securityControllerTest->testLogin();

        $crawler = $client->request('GET', '/tasks/create');
        static::assertSame(200, $client->getResponse()->getStatusCode());

        // Test if creation page field exists
        static::assertSame(1, $crawler->filter('input[name="task[title]"]')->count());
        static::assertSame(1, $crawler->filter('textarea[name="task[content]"]')->count());

        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'Nouvelle tâche';
        $form['task[content]'] = 'Ceci est une tâche crée par un test';
        $client->submit($form); 
        static::assertSame(302, $client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect();
        static::assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testEditAction()
    {
        $securityControllerTest = new SecurityControllerTest();
        $client = $securityControllerTest->testLogin();

        $crawler = $client->request('GET', '/tasks/1/edit');
        static::assertSame(200, $client->getResponse()->getStatusCode());

        // Test if creation page field exists
        static::assertSame(1, $crawler->filter('input[name="task[title]"]')->count());
        static::assertSame(1, $crawler->filter('textarea[name="task[content]"]')->count());
    }

    // Will delete a task created in the test database that is the same owner than the user logged it
    public function testDeleteTaskAction()
    {
        $securityControllerTest = new SecurityControllerTest();
        $client = $securityControllerTest->testLogin();

        $crawler = $client->request('GET', '/tasks/2/delete');
        static::assertSame(302, $client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect();

        // Test if success message is displayed
        static::assertContains("Superbe ! La tâche a bien été supprimée.", $crawler->filter('div.alert.alert-success')->text());
    }

    public function testDeleteTaskActionWhereItemDontExists()
    {
        $securityControllerTest = new SecurityControllerTest();
        $client = $securityControllerTest->testLogin();

        $crawler = $client->request('GET', '/tasks/-100/delete');
        static::assertSame(404, $client->getResponse()->getStatusCode());
    }
}