# Enumerated Class

Enum and list implementation

## Sample Code

#### 1. create a EnumList class


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

best to define values as constants, then set `$choices` 
as available values with labels (i.e. human readable string). 

#### 2. get enumerated object 

static function, `enum`, returns an instantiated enumerated 
object, which is `EnumInterface`

```php
$enum = EnumList::enum(EnumList::ENUM);
(string) $enum; // enum
$enum->label(); // enumerated
$enum->is(EnumList::ENUM); // true
```

#### 3. get empty instance

sometimes, one might want to access to the default `static::$choices` 
to check if certain value is defined. 

```php
$empty = EnumList::getEmptyInstance(EnumList::ENUM);
$empty->choices(); // array of choices
$empty->isDefined(EnumList::ENUM); // true
```

#### 4. subset of choices

sometimes, one might want to limit choices to the subset of 
the original `static::$choices`.

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
$enum = EnumList::enum(EnumList::VALUE);
```
