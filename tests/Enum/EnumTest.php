<?php
namespace tests\Auth;

use Tests\Enum\Stubs\EnumValue;

require_once( dirname( __DIR__ ) . '/autoloader.php' );

class EnumTest extends \PHPUnit_Framework_TestCase
{
    public function testEnumList()
    {
        $this->assertTrue(EnumValue::isDefined(EnumValue::ENUM));
        $this->assertTrue(EnumValue::isDefined(EnumValue::VALUE));
        $this->assertFalse(EnumValue::isDefined('bad'));
        
        $this->assertEquals(2, count(EnumValue::choices()));
        $this->assertEquals(2, count(EnumValue::flipped()));
    }
    
    public function testUndocumentedFeature_FindValue()
    {
        $this->assertEquals('enum', EnumValue::findValue('enumerated'));
        $this->assertEquals('enum', EnumValue::findValue('ENUM'));
        $this->assertEquals('enum', EnumValue::findValue('enum'));
    }
    
    public function test0()
    {
        $enum = EnumValue::enum(EnumValue::ENUM);
        $this->assertEquals('WScore\Enum\Enum', get_class($enum));
        $this->assertEquals('enumerated', $enum->label());
        $this->assertEquals('enum', (string) $enum);
        $this->assertTrue($enum->is(EnumValue::ENUM));
        $this->assertFalse($enum->is(EnumValue::VALUE));
        $this->assertEquals(2, count($enum->choices()));
        $this->assertEquals(2, count($enum->flipped()));
        
        $enum = EnumValue::getEnum(EnumValue::ENUM);
        $this->assertTrue($enum->is(EnumValue::ENUM));
        $this->assertFalse($enum->isDefined(EnumValue::VALUE));
        $this->assertEquals(1, count($enum->choices()));
    }
}
