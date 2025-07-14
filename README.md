# Z-Engine Unfinal

**This is a partial fork of the [z-engine](https://github.com/lisachenko/z-engine) library, compatibile with PHP 8.4.**

This package allows you to:

- Extend final classes
- Create instances of abstract classes
- Add traits to existing classes dynamically

## Intended Use Cases

- **Unit Testing:**
  - Mock or extend classes declared as `final` or `abstract` in your tests.
  - Enable mocking frameworks to work with classes that would otherwise be unmockable.
- **Dynamic Trait Injection:**
  - Augment class functionality for testing 
  - Implement behaviors such as "friendly" classes that access each other's protected methods.

## Installation

```bash
composer require grikdotnet/z-unfinal
```

## Examples:

### Extend a final class

```php
use ZEngine\Core;
use ZEngine\Reflection\ReflectionClass;

Core::init();

// Get reflection for a final class
$reflectionClass = new ReflectionClass(FinalClass::class);

// Remove the final flag
$reflectionClass->setFinal(false);

// Now you can extend the class in your tests
class ExtendedClass extends FinalClass {
    // Test-specific functionality
}
```

### Create an instance of an abstract class

```php
use ZEngine\Core;
use ZEngine\Reflection\ReflectionClass;

Core::init();

$reflectionClass = new ReflectionClass(AbstractClass::class);
$reflectionClass->setAbstract(false);

// Now you can create an instance of the abstract class
$instance = new AbstractClass();
```

### Dynamically Add Traits to a Class

```php
use ZEngine\Core;
use ZEngine\Reflection\ReflectionClass;

Core::init();

$reflectionClass = new ReflectionClass(TargetClass::class);
$reflectionClass->addTraits(SomeTrait::class);

// Now TargetClass has all methods from SomeTrait
(new TestClass())->traitMethod()
```

## License

MIT. See [LICENSE](LICENSE) for details.

---

Original project: [lisachenko/z-engine](https://github.com/lisachenko/z-engine)


## Pre-requisites and initialization

- PHP 8 or higher, x64 non-thread-safe version
- FFI extension enabled
- To use in fcgi mode, call `Core::preload()` in your script specified by `opcache.preload`. Check `preload.php` for an example.

