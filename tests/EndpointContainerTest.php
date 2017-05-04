<?php

namespace seregazhuk\tests;

use Mockery;
use Mockery\MockInterface;
use PHPUnit_Framework_TestCase;
use seregazhuk\HeadHunterApi\Request;
use seregazhuk\HeadHunterApi\EndPoints\EndpointsContainer;
use seregazhuk\HeadHunterApi\Exceptions\WrongEndPointException;

class EndpointsContainerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EndpointsContainer
     */
    protected $container;

    /**
     * @var Request|MockInterface
     */
    protected $request;

    public function setUp()
    {
        /** @var Request $request */
        $this->request = Mockery::mock(Request::class);
        $this->container = new EndpointsContainer($this->request);
    }

    public function tearDown() {
        Mockery::close();
    }

    /** @test */
    public function getValidProvider()
    {
        $provider = $this->container->vacancies;
        $this->assertNotEmpty($provider);
    }

    /**
     * @test
     */
    public function getWrongProvider()
    {
        $this->expectException(WrongEndPointException::class);
        $this->container->getEndpoint('unknown');
    }

    /** @test */
    public function it_delegates_setters_to_request_object()
    {
        $host = 'value';
        $this->request->shouldReceive('setHost')
            ->once()
            ->with($host);

        $this->container->setHost($host);
    }
}

