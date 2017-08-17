<?php
/**
 * @copyright  Copyright (C) 2013 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\DI\Tests;

use Joomla\DI\Container;
use PHPUnit\Framework\TestCase;
use Joomla\DI\ServiceProviderInterface;

/**
 * Tests for Container class.
 */
class ServiceProviderTest extends TestCase
{
    /**
     * @testdox When registering a service provider, its register() method is called with the container instance
     */
    public function testRegisterServiceProvider()
    {
        $container = new Container();

        $mock = $this->getMockBuilder(ServiceProviderInterface::class)
                     ->getMock()
        ;

        $mock->expects($this->once())
             ->method('register')
             ->with($container)
        ;

        /** @noinspection PhpParamsInspection */
        $container->registerServiceProvider($mock);
    }
}
