<?php
namespace tests\Auth;

use Tests\Enum\Stubs\EnumList;

require_once( dirname( __DIR__ ) . '/autoloader.php' );

class EnumTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function callingStaticMethods()
    {
        $empty = EnumList::getEmptyInstance();
        $this->assertTrue($empty->isDefined(EnumList::ENUM));
        $this->assertTrue($empty->isDefined(EnumList::VALUE));
        $this->assertFalse($empty->isDefined('bad'));
        
        $this->assertEquals(2, count($empty->choices()));
        $this->assertEquals(2, count($empty->flipped()));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function usingInvalidValueThrowsAnException()
    {
        EnumList::enum('bad value');
    }

    /**
     * @test
     */
    public function undocumentedFeature_FindValue()
    {
        $this->assertEquals('enum', EnumList::findValue('enumerated'));
        $this->assertEquals('enum', EnumList::findValue('ENUM'));
        $this->assertEquals('enum', EnumList::findValue('enum'));
    }

    /**
     * @test
     */
    public function enumeratedObject()
    {
        $enum = EnumList::enum(EnumList::ENUM);
        $this->assertEquals('Tests\Enum\Stubs\EnumList', get_class($enum));
        $this->assertEquals('enumerated', $enum->label());
        $this->assertEquals('enum', (string) $enum);
        $this->assertTrue($enum->is(EnumList::ENUM));
        $this->assertFalse($enum->is(EnumList::VALUE));
        $this->assertEquals(2, count($enum->choices()));
        $this->assertEquals(2, count($enum->flipped()));
        
        $enum = EnumList::getEnum(EnumList::ENUM);
        $this->assertTrue($enum->is(EnumList::ENUM));
        $this->assertFalse($enum->isDefined(EnumList::VALUE));
        $this->assertEquals(1, count($enum->choices()));
        $this->assertTrue($enum->isEnum());
    }
}
