<?php
namespace GdproMonologTest\UnitTest\Controller;

use GdproMonolog\Controller\ExampleController;

class ExampleControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $controller;

    protected $viewModelMock;

    public function setUp()
    {
        $this->viewModelMock = $this->getMock('Zend\View\Model\ViewModel');

        $this->controller = new ExampleController(
            $this->viewModelMock
        );
    }

    public function testIndexActionGood()
    {
        $result = $this->controller->indexAction();

        $this->assertEquals($this->viewModelMock, $result);
    }
}
