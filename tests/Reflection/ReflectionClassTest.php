<?php
/**
 * Z-Engine framework - Minimal ReflectionClass Tests
 *
 * @copyright Copyright 2019, Lisachenko Alexander <lisachenko.it@gmail.com>
 */
declare(strict_types=1);

namespace ZEngine\Reflection;

use PHPUnit\Framework\TestCase;
use ZEngine\Stub\AbstractClass;
use ZEngine\Stub\FinalClass;
use ZEngine\Stub\TestClass;
use ZEngine\Stub\TestTrait;

class ReflectionClassTest extends TestCase
{
    private ReflectionClass $refClass;

    public function testSetNonAbstract()
    {
        $this->refClass = new ReflectionClass(AbstractClass::class);
        $this->refClass->setAbstract(false);
        $this->assertFalse((new \ReflectionClass(AbstractClass::class))->isAbstract());
        $instance = new AbstractClass();
        $this->assertInstanceOf(AbstractClass::class, $instance);
    }

    public function testSetNonFinal()
    {
        $this->refClass = new ReflectionClass(FinalClass::class);
        $this->refClass->setFinal(false);
        $this->assertFalse($this->refClass->isFinal());
        $instance = new class extends TestClass {};
        $this->assertInstanceOf(TestClass::class, $instance);
    }

    public function testAddTraits()
    {
        $this->refClass = new ReflectionClass(TestClass::class);
        $this->refClass->addTraits(TestTrait::class);
        $this->assertTrue(method_exists(TestClass::class,'foo'));
        $this->assertEquals(1,(new TestClass())->foo(1));
    }
}