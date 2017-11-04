<?php
namespace Tests\Enum\Stubs;

use WScore\Enum\AbstractEnum;

class ActiveList extends AbstractEnum
{
    const ACTIVE = 'active';
    const CANCEL = 'cancel';
    const HOLD   = 'hold';
    
    protected static $choices = [
        self::ACTIVE => 'activated',
        self::CANCEL => 'canceled',
        self::HOLD   => 'hold-on',
    ];

    /**
     * @return array
     */
    public static function userChoice()
    {
        return [
            self::ACTIVE => 'activated',
            self::CANCEL => 'canceled',
        ];
    }
}
