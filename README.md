# Enumerated Class

Enum and list implementation

### Licence

MIT License

### Installation

```sh
composer require "wscore/enum: ^0.2.0"
```


Sample Code
-----------

### create a EnumList class

The intended way of creating a enumerated class is, 

1. define constants,
2. define static $choices array.

as in the example below. 

```php
use WScore\Enum\AbstractEnum;

class EnumList extends AbstractEnum
{
    const ENUM = 'enum';
    const VALUE = 'value';
    
    protected static $choices = [
        self::ENUM => 'enumerated',
        self::VALUE => 'value',
    ];
}
```

The `$choices` variable defines available values 
with labels (i.e. human readable string). 

### get enumerated object 

static function, `enum`, returns an instantiated enumerated 
object, which is `EnumInterface`

```php
$enum = EnumList::enum(EnumList::ENUM);
(string) $enum; // enum
$enum->label(); // enumerated
$enum->is(EnumList::ENUM); // true
```

### flipped enum list and keys

Some times, keys or flipped list of enumerated array is required 
(for validation or Symfony/Form, for instance). 

```php
$keys = EnumList::keys();    // returns keys of enumerated list. 
$flip = EnumList::flipped(); // returns array of key/value flipped.
```


subset of choices
-----------------

In some use cases, subset of enumerated values maybe available 
for choices.
 
For instance, active status may have 3 options for admin 
but has only 2 options for the end-user, as shown in 
the `ActiveList` class below. 

```php
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
```

To get the available choices, 

```php
$list = ActiveList::userChoice(); 
$keys = ActiveList::keys('userChoice');
$flip = ActiveList::flipped('userChoice');
```

### really restricting use of list

To really limit choices to the subset of 
the original `static::$choices`... 

```php
use WScore\Enum\AbstractEnum;

class EnumList extends AbstractEnum
{
    const ENUM = 'enum';
    const VALUE = 'value';
    protected static $choices = [
        self::ENUM => 'enumerated',
        self::VALUE => 'value',
    ];

    /**
     * @param string $value
     * @return EnumList
     */
    public static function getEnum($value)
    {
        $choices = self::$choices;
        unset($choices[self::VALUE]);
        return new EnumList($value, $choices);
    }
}
```

then, the following code will throw an \InvalidArgumentException. 

```php
$enum = EnumList::getEnum(EnumList::VALUE);
```
