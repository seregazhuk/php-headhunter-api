<?php

namespace seregazhuk\tests;

use Mockery;
use PHPUnit_Framework_TestCase;
use seregazhuk\HeadHunterApi\Contracts\RequestInterface;
use seregazhuk\HeadHunterApi\EndPoints\EndpointsContainer;

class EndpointsContainerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EndpointsContainer
     */
    private $container;
    public function setUp()
    {
        $request = Mockery::mock(RequestInterface::class);
        $this->container = new EndpointsContainer($request);
    }

    public function tearDown() {
        Mockery::close();
    }

    /** @test */
    public function getValidProvider()
    {
        $provider = $this->container->getEndpoint('vacancies');
        $this->assertNotEmpty($provider);
    }
    /**
     * @test
     * @expectedException \seregazhuk\HeadHunterApi\Exceptions\WrongEndPointException
     */
    public function getWrongProvider()
    {
        $this->container->getEndpoint('unknown');
    }
}