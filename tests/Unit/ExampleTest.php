<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function __construct()
    {
        date_default_timezone_set(env('TIME_ZONE'));
        $this->today = date('Y-m-d H:i:s', time());
       $this->creator=env('Super');
       $this->creator3=env('Banned');
       $this->creator4=env('Reported');
  
        
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
    public function test_data(){
        $this->assertEquals(200, $response->result());
    }
}
