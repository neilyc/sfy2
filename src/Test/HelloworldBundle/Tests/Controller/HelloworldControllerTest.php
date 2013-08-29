<?php

namespace Test\HelloworldBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
//use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken as Token; 

class HelloworldControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(1, $crawler->filter('html:contains("Anonymous")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("user")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("admin")')->count());



        $crawler = $client->request('GET', '/secured/user');
        $this->assertEquals(1, $crawler->filter('html:contains("Redirect")')->count());

        $crawler = $client->request('GET', '/secured/admin');
        $this->assertEquals(1, $crawler->filter('html:contains("Redirect")')->count());
    }

    public function testhelloAction(){

    	$client = static::createClient(array(), array(
		    'PHP_AUTH_USER' => 'user',
		    'PHP_AUTH_PW'   => 'userpass',
		));

        $crawler = $client->request('GET', '/');
        $this->assertEquals(0, $crawler->filter('html:contains("Anonymous")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("user!")')->count());

        $crawler = $client->request('GET', '/secured/user');
        $this->assertEquals(0, $crawler->filter('html:contains("Redirect")')->count());
        $this->assertEquals(0, $crawler->filter('html:contains("Anonymous")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("user!")')->count());

        $crawler = $client->request('GET', '/secured/admin');
        $this->assertEquals(1, $crawler->filter('html:contains("Redirect")')->count());
    }

    public function testHelloAdminAction(){

    	$client = static::createClient(array(), array(
		    'PHP_AUTH_USER' => 'admin',
		    'PHP_AUTH_PW'   => 'adminpass',
		));

        $crawler = $client->request('GET', '/');
        $this->assertEquals(0, $crawler->filter('html:contains("Anonymous")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("admin!")')->count());

        $crawler = $client->request('GET', '/secured/user');
        $this->assertEquals(1, $crawler->filter('html:contains("Redirect")')->count());

        $crawler = $client->request('GET', '/secured/admin');
        $this->assertEquals(0, $crawler->filter('html:contains("Redirect")')->count());
        $this->assertEquals(0, $crawler->filter('html:contains("Anonymous")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("admin!")')->count());
    }
}