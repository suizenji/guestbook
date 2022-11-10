<?php

namespace App\Tests\Controller;

use Symfony\Component\Panther\PantherTestCase;

class PantherConferenceControllerTest extends PantherTestCase
{
    public function testIndex()
    {
        // $_SERVER['PANTHER_NO_HEADLESS'] = true;

        $baseUri = substr($_SERVER['SYMFONY_PROJECT_DEFAULT_ROUTE_URL'], 0, -1);

        $client = static::createPantherClient([
            'panther_no_headless' => true,
            'external_base_uri' => $baseUri,
            'browser' => PantherTestCase::FIREFOX,
        ], [], [
            'capabilities' => ['acceptInsecureCerts' => true],
            'chromedriver_arguments' => [
                '--no-sandbox',
                '--log-path=var/browser.log',
                '--log-level=DEBUG',
                '--disable-dev-shm-usage',
            ],
        ]);

        /** \Symfony\Component\Panther\DomCrawler\Crawler $crawler */
        $crawler = $client->request('GET', '/');

        // file_put_contents('index.html', $crawler->html());
        $this->assertSelectorTextContains('h2', 'Give your feedback');
    }
}
