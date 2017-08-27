# Enumerated Class

Enum and list implementation

## Sample Code

#### 1. create a EnumList class


```php
use WScore\Enum\AbstractEnumList;

class EnumList extends AbstractEnumList
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
as valid values with labels (i.e. human readable string). 

#### 2. get enumerated object 

static function, `enum`, returns an instantiated enumerated 
object, which is `EnumInterface`

```php
$enum = EnumList::enum(EnumValue::ENUM);
(string) $enum; // enum
$enum->label(); // enumerated
```
