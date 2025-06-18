<?php
/**
 * Integration test for final class modification using Z-Engine
 */
declare(strict_types=1);

namespace ZEngine\Integration;

use PHPUnit\Framework\TestCase;

class FinalClassModificationTest extends TestCase
{
    private string $scriptPath;

    protected function setUp(): void
    {
        $this->scriptPath = __DIR__ . '/../Scripts/test_final_class_modification.php';
        $this->assertFileExists($this->scriptPath, 'Test script must exist');
    }

    /**
     * Test that the final class modification script runs and produces expected output
     */
    public function testFinalClassModificationScript()
    {
        // Execute the script in a separate PHP process and capture both output and exit code
        $command = 'php ' . escapeshellarg($this->scriptPath) . ' 2>&1; echo "EXIT_CODE:$?"';
        $output = shell_exec($command);

        // Extract exit code from output
        $exitCode = 0;
        if (preg_match('/EXIT_CODE:(\d+)/', $output, $matches)) {
            $exitCode = (int)$matches[1];
            // Remove the exit code line from output for cleaner assertions
            $output = preg_replace('/EXIT_CODE:\d+\s*$/', '', $output);
        }

        // Assert that we got output
        $this->assertNotNull($output, 'Script should produce output');
        $this->assertNotEmpty($output, 'Script output should not be empty');

        // Check that Z-Engine initialized successfully
        $this->assertStringContainsString('✓ Z-Engine initialized successfully', $output);

        // Check that the original class state is detected as Final
        $this->assertStringContainsString('Original FinalClass state: Final', $output);

        // Check that Z-Engine can read the final state
        $this->assertStringContainsString('Z-Engine FinalClass state before modification: Final', $output);

        // Check that Z-Engine reports the class as non-final after modification
        $this->assertStringContainsString('Z-Engine FinalClass state after setFinal(false): Not Final', $output);

        // Check that we can create an instance of the final class
        $this->assertStringContainsString('✓ Successfully created instance of FinalClass', $output);
        $this->assertStringContainsString('Message: Hello from FinalClass!', $output);

        // Check that extending the class (after Z-Engine modification) does not cause a fatal error
        // in this test environment, as Z-Engine's setFinal(false) might be an API demonstration
        // or the test environment doesn't reflect a true runtime modification that would prevent extension.
        $this->assertStringNotContainsString('Fatal error', $output, 'Script output should not contain "Fatal error"');

        // The exit code should be 0, indicating successful script execution without fatal errors.
        $this->assertEquals(0, $exitCode, 'Script should exit with code 0, indicating success.');
    }

}