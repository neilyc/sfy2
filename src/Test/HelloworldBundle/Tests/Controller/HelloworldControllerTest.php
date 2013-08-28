<?php

namespace Test\HelloworldBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HelloworldControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $this->assertGreaterThan(0, $crawler->filter('html:contains("troger")')->count());
    }
}