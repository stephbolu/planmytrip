<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

require('vendor/autoload.php');


final class StepTest extends WebTestCase{

    public function testCanBeCreatedFromValidParam(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/step', 
            array(
                'comment'   => 'commentTest',
                'rank'      => '1',
                'duration'  => '1',
                'idJourney' => '1',
                'idCity'    => '1'
            )
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //$data = json_decode($client->getResponse()->getBody(), true);
        //$this->assertEquals($stepId, $data['stepId']);
    }

}