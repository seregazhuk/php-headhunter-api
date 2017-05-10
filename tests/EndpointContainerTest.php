<?php

namespace seregazhuk\tests;

use Mockery;
use Mockery\MockInterface;
use PHPUnit_Framework_TestCase;
use seregazhuk\HeadHunterApi\Request;
use seregazhuk\HeadHunterApi\EndPoints\Vacancies;
use seregazhuk\HeadHunterApi\EndPoints\EndpointsContainer;
use seregazhuk\HeadHunterApi\Exceptions\HeadHunterApiException;
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
    public function it_returns_a_provider_instance()
    {
        $provider = $this->container->vacancies;
        $this->assertInstanceOf(Vacancies::class, $provider);
    }

    /**
     * @test
     */
    public function it_throws_exception_when_trying_to_access_wrong_provider()
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

    /** @test */
    public function it_throws_exception_when_accessing_request_setter_that_doesnt_exist()
    {
        $this->expectException(HeadHunterApiException::class);
        $this->container->setProperty('value');
    }
}

