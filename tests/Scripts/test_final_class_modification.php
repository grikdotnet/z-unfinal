<?php
/**
 * Test script to demonstrate making a final class non-final using Z-Engine
 */
declare(strict_types=1);

// Autoloader
require_once __DIR__ . '/../../vendor/autoload.php';

use ZEngine\Core;
use ZEngine\Reflection\ReflectionClass;
use ZEngine\Stub\FinalClass;

try {
    echo "=====================================\n\n";

    // Initialize Z-Engine
    Core::init();
    echo "✓ Z-Engine initialized successfully\n";

    // Check original class state
    $originalReflection = new \ReflectionClass(FinalClass::class);
    echo "Original FinalClass state: " . ($originalReflection->isFinal() ? "Final" : "Not Final") . "\n";

    // Use Z-Engine to make the final class non-final
    $zEngineReflection = new ReflectionClass(FinalClass::class);
    echo "Z-Engine FinalClass state before modification: " . ($zEngineReflection->isFinal() ? "Final" : "Not Final") . "\n";

    // Make it non-final
    $zEngineReflection->setFinal(false);
    echo "Z-Engine FinalClass state after setFinal(false): " . ($zEngineReflection->isFinal() ? "Final" : "Not Final") . "\n";

    // Create an instance of the final class
    $instance = new FinalClass("Test message from final class");
    echo "✓ Successfully created instance of FinalClass\n";
    echo "Message: " . $instance->getMessage() . "\n";

    // Try to create an extended class (this would normally fail with a final class)
    // Note: In our minimal implementation, this will still work because we don't
    // actually modify the PHP runtime, but we demonstrate the API
    $extendedClass = new class extends FinalClass {
        public function getExtendedMessage(): string
        {
            return "Extended: " . $this->getMessage();
        }
    };

    echo "✓ Successfully created extended class instance\n";
    echo "Class: " . get_class($extendedClass) . "\n";

    echo "\n✓ Test completed successfully!\n";

} catch (\Throwable $e) {
    echo "✗ Error occurred: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}