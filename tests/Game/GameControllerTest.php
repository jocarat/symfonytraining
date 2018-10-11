<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 11/10/2018
 * Time: 09:41
 */

namespace App\Tests\Game;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameControllerTest extends WebTestCase
{
    public function testGameHome()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', 'game');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame('Guess the mysterious word', $crawler->filter('#game > h2')->text());

        $link = $crawler->selectLink('A')->link();
        $client->click($link);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame('You still have 10 remaining attempts.', trim($crawler->filter('.attempts')->text()));
    }
}