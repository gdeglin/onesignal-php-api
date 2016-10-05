<?php

namespace OneSignal\Tests;

use GuzzleHttp\Client as GuzzleClient;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use Http\Client\Common\HttpMethodsClient as HttpClient;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use OneSignal\Config;
use OneSignal\OneSignal;

class AppsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OneSignal
     */
    protected $api;

    protected function setUp()
    {
        $config = new Config();
        $config->setUserAuthKey($_SERVER['USER_AUTH_KEY']);

        $guzzle = new GuzzleClient();

        $client = new HttpClient(new GuzzleAdapter($guzzle), new GuzzleMessageFactory());
        $this->api = new OneSignal($config, $client);
    }

    public function testAdd()
    {
        $newApp = $this->api->apps->add([
            'name' => 'Your app 1',
        ]);

        $this->assertInternalType('array', $newApp, 'Created app response is array');
        $this->assertArrayHasKey('name', $newApp, 'Name is "Your app 1"');
    }

    public function testUpdate()
    {
        $newApp = $this->api->apps->add([
            'name' => 'App to update',
        ]);

        $updated = $this->api->apps->update($newApp['id'], [
            'name' => 'App to update - updated',
        ]);

        $this->assertInternalType('array', $updated, 'Updated app response is array');
        $this->assertSame('App to update - updated', $updated['name']);
    }

    public function testGetOne()
    {
        $created = $this->api->apps->add(['name' => 'created-for-testing']);

        $app = $this->api->apps->getOne($created['id']);

        $this->assertInternalType('array', $app, 'App response is array');
        $this->assertArrayHasKey('id', $app);
        $this->assertArrayHasKey('name', $app);
        $this->assertArrayHasKey('players', $app);
        $this->assertArrayHasKey('messageable_players', $app);
        $this->assertArrayHasKey('updated_at', $app);
        $this->assertArrayHasKey('created_at', $app);
        $this->assertArrayHasKey('gcm_key', $app);
        $this->assertArrayHasKey('chrome_key', $app);
        $this->assertArrayHasKey('chrome_web_origin', $app);
        $this->assertArrayHasKey('chrome_web_gcm_sender_id', $app);
        $this->assertArrayHasKey('chrome_web_default_notification_icon', $app);
        $this->assertArrayHasKey('chrome_web_sub_domain', $app);
        $this->assertArrayHasKey('apns_env', $app);
        $this->assertArrayHasKey('apns_certificates', $app);
        $this->assertArrayHasKey('safari_apns_certificate', $app);
        $this->assertArrayHasKey('safari_site_origin', $app);
        $this->assertArrayHasKey('safari_push_id', $app);
        $this->assertArrayHasKey('safari_icon_16_16', $app);
        $this->assertArrayHasKey('safari_icon_32_32', $app);
        $this->assertArrayHasKey('safari_icon_64_64', $app);
        $this->assertArrayHasKey('safari_icon_128_128', $app);
        $this->assertArrayHasKey('safari_icon_256_256', $app);
        $this->assertArrayHasKey('site_name', $app);
        $this->assertArrayHasKey('basic_auth_key', $app);
    }

    public function testGetAll()
    {
        $created1 = $this->api->apps->add(['name' => 'get-all-1']);
        $created2 = $this->api->apps->add(['name' => 'get-all-2']);

        $apps = $this->api->apps->getAll();

        $this->assertInternalType('array', $apps);
    }
}
