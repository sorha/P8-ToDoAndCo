<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testListActionWithoutLogin()
    {
        // If the user isn't logged, should redirect to the login page
        $client = static::createClient();
        $client->request('GET', '/users');
        static::assertSame(302, $client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect();
        // Test if login field exists
        static::assertSame(1, $crawler->filter('input[name="_username"]')->count());
        static::assertSame(1, $crawler->filter('input[name="_password"]')->count());
    }
}
