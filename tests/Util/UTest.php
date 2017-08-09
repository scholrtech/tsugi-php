<?php

require "src/Util/U.php";

use \Tsugi\Util\U;

class UTest extends PHPUnit_Framework_TestCase
{
    public function testGet() {
        $this->assertFalse(U::goodFolder(' '));
        $this->assertFalse(U::goodFolder('a b'));
        $this->assertTrue(U::goodFolder('ab'));
        $this->assertFalse(U::goodFolder('1a'));
        $this->assertFalse(U::goodFolder('ai!'));
        $this->assertFalse(U::goodFolder('ASJHJGAai!'));
        $this->assertTrue(U::goodFolder('ASJHJGAai'));
        $this->assertTrue(U::goodFolder('ASJ-JGAai'));
        $this->assertTrue(U::goodFolder('ASJ_JGAai'));
        $this->assertFalse(U::goodFolder('-ASJ_JGAai'));
        $this->assertFalse(U::goodFolder('_ASJ_JGAai'));
    }

    public function testRest() {
        // Note this is normally $_SERVER['REQUEST_URI'] so there is not http:// ...
        $this->assertEquals(U::get_rest_path('/py4e/lessons/intro'), '/py4e/lessons/intro');
        $this->assertEquals(U::get_rest_path('/py4e/lessons/intro/'), '/py4e/lessons/intro');
        $this->assertEquals(U::get_rest_path('/py4e/lessons/intro?x=2'), '/py4e/lessons/intro');
        $this->assertEquals(U::get_rest_path('/py4e/lessons/intro/?x=2'), '/py4e/lessons/intro');

        $this->assertEquals(U::get_rest_parent('/py4e/lessons/intro'), '/py4e/lessons');
        $this->assertEquals(U::get_rest_parent('/py4e/lessons/intro/'), '/py4e/lessons');
        $this->assertEquals(U::get_rest_parent('/py4e/lessons/intro?x=2'), '/py4e/lessons');
        $this->assertEquals(U::get_rest_parent('/py4e/lessons/intro/?x=2'), '/py4e/lessons');
    }

}
