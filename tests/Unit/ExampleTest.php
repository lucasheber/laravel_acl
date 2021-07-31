<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }
    
    public function test_soma_10_mais_10() {
        $this->assertEquals(20, 10 + 10, "Lucas Heber");
    }
}
