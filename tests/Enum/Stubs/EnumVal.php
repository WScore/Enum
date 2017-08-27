<?php
namespace Tests\Enum\Stubs;

use WScore\Enum\AbstractEnumValue;

class EnumVal extends AbstractEnumValue
{
    /**
     * @return bool
     */
    public function isEnum()
    {
        return $this->is(EnumList::ENUM);
    }
}