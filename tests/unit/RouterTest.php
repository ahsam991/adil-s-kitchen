<?php
/**
 * Unit Test for Router
 */

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    private $router;

    protected function setUp(): void
    {
        $this->router = new \Router();
    }

    /**
     * Test route registration with GET method
     */
    public function testAddGetRoute(): void
    {
        $this->router->get('/home', ['HomeController', 'index']);
        
        // Use reflection to check private property
        $reflection = new \ReflectionClass($this->router);
        $property = $reflection->getProperty('routes');
        $property->setAccessible(true);
        $routes = $property->getValue($this->router);
        
        $this->assertArrayHasKey('GET /home', $routes);
        $this->assertEquals(['HomeController', 'index'], $routes['GET /home']);
    }

    /**
     * Test route registration with POST method
     */
    public function testAddPostRoute(): void
    {
        $this->router->post('/cart/add', ['CartController', 'add']);
        
        $reflection = new \ReflectionClass($this->router);
        $property = $reflection->getProperty('routes');
        $property->setAccessible(true);
        $routes = $property->getValue($this->router);
        
        $this->assertArrayHasKey('POST /cart/add', $routes);
    }

    /**
     * Test that get() is alias for add('GET', ...)
     */
    public function testGetMethodAlias(): void
    {
        $this->router->get('/test', ['TestController', 'show']);
        $this->router->add('GET', '/test2', ['TestController', 'show2']);
        
        $reflection = new \ReflectionClass($this->router);
        $property = $reflection->getProperty('routes');
        $property->setAccessible(true);
        $routes = $property->getValue($this->router);
        
        $this->assertArrayHasKey('GET /test', $routes);
        $this->assertArrayHasKey('GET /test2', $routes);
    }

    /**
     * Test that post() is alias for add('POST', ...)
     */
    public function testPostMethodAlias(): void
    {
        $this->router->post('/test', ['TestController', 'store']);
        
        $reflection = new \ReflectionClass($this->router);
        $property = $reflection->getProperty('routes');
        $property->setAccessible(true);
        $routes = $property->getValue($this->router);
        
        $this->assertArrayHasKey('POST /test', $routes);
    }
}
