<?php
namespace tests\Auth;

use Tests\Enum\Stubs\EnumList;

require_once( dirname( __DIR__ ) . '/autoloader.php' );

class EnumTest extends \PHPUnit_Framework_TestCase
{
    public function testEnumList()
    {
        $this->assertTrue(EnumList::isDefined(EnumList::ENUM));
        $this->assertTrue(EnumList::isDefined(EnumList::VALUE));
        $this->assertFalse(EnumList::isDefined('bad'));
        
        $this->assertEquals(2, count(EnumList::choices()));
        $this->assertEquals(2, count(EnumList::flipped()));
    }
    
    public function testUndocumentedFeature_FindValue()
    {
        $this->assertEquals('enum', EnumList::findValue('enumerated'));
        $this->assertEquals('enum', EnumList::findValue('ENUM'));
        $this->assertEquals('enum', EnumList::findValue('enum'));
    }
    
    public function testEnumValue()
    {
        $enum = EnumList::enum(EnumList::ENUM);
        $this->assertEquals('WScore\Enum\Enum', get_class($enum));
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
