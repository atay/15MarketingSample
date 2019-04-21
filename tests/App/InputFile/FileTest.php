<?php

use PHPUnit\Framework\TestCase;

use App\InputFile\File;
use App\InputFile\Actions;

class FileTest extends TestCase
{
    public function testGetContent()
    {
        $file = new File("test");
        $this->assertSame($file->getContent(), "test");

        $sampleArray = [
            "key1" => "value1",
            "key2" => "value2",
        ];
        $file = new File($sampleArray);
        $this->assertSame($file->getContent(), $sampleArray);
    }

    public function testGetValueByPath()
    {
        $input = [
            "someKey" => [
                "anotherKey" => "value",
            ],
            "foo" => "bar",
        ];
        $file = new File($input);
        $this->assertSame($input['someKey'], $file->getValueByPath('someKey'));
        $this->assertSame($input['someKey']['anotherKey'], $file->getValueByPath('someKey.anotherKey'));
        $this->assertSame($input['foo'], $file->getValueByPath('foo'));
        $this->assertNull($file->getValueByPath("incorrectPath"));
        $this->assertNull($file->getValueByPath("someKey.anotherKey.doesNotExist"));
    }

    public function testPathExist()
    {
        $input = [
            "someKey" => [
                "anotherKey" => "value",
            ],
            "foo" => "bar",
        ];
        $file = new File($input);
        $this->assertTrue($file->pathExist('someKey'));
        $this->assertTrue($file->pathExist('someKey.anotherKey'));
        $this->assertTrue($file->pathExist('foo'));

        $this->assertFalse($file->pathExist("incorrectPath"));
        $this->assertFalse($file->pathExist("someKey.anotherKey.doesNotExist"));
    }

    public function testGetActionEnter()
    {
        $input = ["enter" => "foo"];
        $file = new File($input);
        $this->assertEquals(Actions::ENTER, $file->getAction());
    }

    public function testGetActionGetBalance()
    {
        $input = ["getbalance" => "foo"];
        $file = new File($input);
        $this->assertEquals(Actions::GET_BALANCE, $file->getAction());
    }
}
