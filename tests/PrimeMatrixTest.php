<?php

use GT\PrimeMatrix;
use PHPUnit\Framework\TestCase;

class PrimeMatrixTest extends TestCase
{
    public function testIsWholeNumber()
    {
        $primeMatrix = new PrimeMatrix(5);
        $this->assertTrue($primeMatrix->is_whole_number(5));
        $this->assertTrue($primeMatrix->is_whole_number(5.0)); // Whole number as float
        $this->assertFalse($primeMatrix->is_whole_number(3.5)); // Number with a decimal part
        $this->assertFalse($primeMatrix->is_whole_number(-1));  // Negative number
        $this->assertFalse($primeMatrix->is_whole_number('5')); // String input
    }

    public function testIsDoubleFloat()
    {
        $primeMatrix = new PrimeMatrix(5);
        $this->assertTrue($primeMatrix->is_double_float(5.1));
        $this->assertFalse($primeMatrix->is_double_float(5));
    }

    public function testIsNegative()
    {
        $primeMatrix = new PrimeMatrix(5);
        $this->assertTrue($primeMatrix->is_negative(-1));
        $this->assertFalse($primeMatrix->is_negative(5));
    }

    public function testIsPrimeNumber()
    {
        $primeMatrix = new PrimeMatrix(5);
        $this->assertTrue($primeMatrix->is_prime_number(5));
        $this->assertFalse($primeMatrix->is_prime_number(4));
    }

    // test prime number generation
    public function testGeneratePrimeNumbers()
    {
        $primeMatrix = new PrimeMatrix(5);
        $primeMatrix->generate_prime_numbers();
        $this->assertEquals([2, 3, 5, 7, 11], $primeMatrix->prime_numbers);
    }

    // test with a negative number
    public function testConstructorWithNegativeNumber()
    {
        $primeMatrix = new PrimeMatrix(-5);
        $this->assertEquals("Input must be a whole number, not a negative number or a string.", $primeMatrix->error);
    }

    // test with a decimal number
    public function testConstructorWithDecimalNumber()
    {
        $primeMatrix = new PrimeMatrix(5.5);
        $this->assertEquals("Input must be a whole number, not a decimal or a string.", $primeMatrix->error);
    }

    // test with a string
    public function testConstructorWithStringInput()
    {
        $primeMatrix = new PrimeMatrix("string");
        $this->assertEquals("Input must be a whole number greater than 0.", $primeMatrix->error);
    }

    // test with a valid prime number
    public function testConstructorWithValidPrimeNumber()
    {
        $primeMatrix = new PrimeMatrix(5);
        $this->assertEmpty($primeMatrix->error);
        $this->assertEquals(5, $primeMatrix->number);
    }

    // test with the smallest prime number
    public function testWithSmallestPrimeNumber()
    {
        $primeMatrix = new PrimeMatrix(1);
        $primeMatrix->generate_prime_numbers();
        $this->assertEquals([2], $primeMatrix->prime_numbers);
    }

    // test with a large prime number
    public function testWithLargePrimeNumber()
    {
        $primeMatrix = new PrimeMatrix(13);
        $primeMatrix->generate_prime_numbers();
        
        // The first 13 prime numbers
        $expected_primes = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41];
        
        // Verify the generated prime numbers are as expected
        $this->assertEquals($expected_primes, $primeMatrix->prime_numbers);
    }

}
