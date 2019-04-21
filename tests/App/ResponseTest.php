<?php

use PHPUnit\Framework\TestCase;
use App\Response;

class ResponseTest extends TestCase
{
    public function testAddArray()
    {
        $input = [
            '@attributes' => [
                "foo" => "bar",
            ],
            "foo2" => [
                "foo3" => "bar3",
                "foo4" => "bar4",
            ],
        ];

        $expected = new \SimpleXMLElement('<service/>');
        $expected->addAttribute("foo", "bar");
        $foo2 = $expected->addChild("foo2");
        $foo2->addChild("foo3", "bar3");
        $foo2->addChild("foo4", "bar4");

        $response = new Response;
        $response->addArray($input);

        $this->assertEquals($expected, $response->getData());

    }
}