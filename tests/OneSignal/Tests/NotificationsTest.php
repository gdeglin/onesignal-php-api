<?php

namespace OneSignal\Tests;

use GuzzleHttp\Client as GuzzleClient;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use Http\Client\Common\HttpMethodsClient as HttpClient;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use OneSignal\Config;
use OneSignal\OneSignal;

class NotificationsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OneSignal
     */
    protected $api;

    protected function setUp()
    {
        $config = new Config();
        $config->setUserAuthKey($_SERVER['USER_AUTH_KEY']);
        $config->setApplicationId($_SERVER['APPLICATION_ID']);
        $config->setApplicationAuthKey($_SERVER['APPLICATION_AUTH_KEY']);

        $guzzle = new GuzzleClient();

        $client = new HttpClient(new GuzzleAdapter($guzzle), new GuzzleMessageFactory());
        $this->api = new OneSignal($config, $client);
    }


}
