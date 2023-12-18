<?php

use GT\PrimeMatrix;
use PHPUnit\Framework\TestCase;

class PrimeMatrixTest extends TestCase
{

    public function testIsWholeNumberWithZero()
    {
        $primeMatrix = new PrimeMatrix(0);
        $this->assertTrue($primeMatrix->is_whole_number());
    }

    public function testIsWholeNumberWithVeryLargeNumber()
    {
        $primeMatrix = new PrimeMatrix(100000);
        $this->assertTrue($primeMatrix->is_whole_number());
    }

    public function testIsWholeNumberWithVeryLargeFloatEquivalentToInteger()
    {
        $primeMatrix = new PrimeMatrix(100000.0);
        $this->assertTrue($primeMatrix->is_whole_number());
    }

    public function testIsWholeNumberWithNullInput()
    {
        $primeMatrix = new PrimeMatrix(null);
        $this->assertFalse($primeMatrix->is_whole_number());
    }

    public function testIsWholeNumberWithBooleanInput()
    {
        $primeMatrix = new PrimeMatrix(true);
        $this->assertFalse($primeMatrix->is_whole_number());
    }

    public function testIsWholeNumberWithArrayInput()
    {
        $primeMatrix = new PrimeMatrix([]);
        $this->assertFalse($primeMatrix->is_whole_number());
    }

    public function testIsDoubleFloatWithZero()
    {
        $primeMatrix = new PrimeMatrix(5);
        $this->assertFalse($primeMatrix->is_double_float(0));
    }

    public function testIsDoubleFloatWithVerySmallFloat()
    {
        $primeMatrix = new PrimeMatrix(0.00001);
        $this->assertTrue($primeMatrix->is_double_float());
    }

    public function testIsDoubleFloatWithLargeFloat()
    {
        $primeMatrix = new PrimeMatrix(123456.789);
        $this->assertTrue($primeMatrix->is_double_float());
    }

    public function testIsDoubleFloatWithNegativeFloatValues()
    {
        $primeMatrix = new PrimeMatrix(-5.5);
        $this->assertTrue($primeMatrix->is_double_float());
    }

    public function testIsDoubleFloatWithNullInput()
    {
        $primeMatrix = new PrimeMatrix(5);
        $this->assertFalse($primeMatrix->is_double_float());
    }

    public function testIsDoubleFloatWithBooleanInput()
    {
        $primeMatrix = new PrimeMatrix(true);
        $this->assertFalse($primeMatrix->is_double_float());
    }

    public function testIsDoubleFloatWithArrayInput()
    {
        $primeMatrix = new PrimeMatrix([]);
        $this->assertFalse($primeMatrix->is_double_float());
    }

    public function testIsNegativeWithZero()
    {
        $primeMatrix = new PrimeMatrix(0);
        $this->assertFalse($primeMatrix->is_negative());
    }

    public function testIsNegativeWithPositiveNumber()
    {
        $primeMatrix = new PrimeMatrix(10);
        $this->assertFalse($primeMatrix->is_negative());
    }

    public function testIsNegativeWithVeryLargeNegativeNumber()
    {
        $primeMatrix = new PrimeMatrix(-1000000000);
        $this->assertTrue($primeMatrix->is_negative());
    }

    public function testIsNegativeWithNullInput()
    {
        $primeMatrix = new PrimeMatrix(null);
        $this->assertFalse($primeMatrix->is_negative());
    }

    public function testIsNegativeWithBooleanInput()
    {
        $primeMatrix = new PrimeMatrix(true);
        $this->assertFalse($primeMatrix->is_negative());
    }

    public function testIsNegativeWithFloatInput()
    {
        $primeMatrix = new PrimeMatrix(10.5);
        $this->assertFalse($primeMatrix->is_negative());
    }

    public function testIsNegativeWithStringInput()
    {
        $primeMatrix = new PrimeMatrix("string");
        $this->assertFalse($primeMatrix->is_negative());
    }

    public function testIsNegativeWithArrayInput()
    {
        $primeMatrix = new PrimeMatrix([]);
        $this->assertFalse($primeMatrix->is_negative());
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

    // test with 13 prime numbers
    public function testWithLargePrimeNumber()
    {
        $primeMatrix = new PrimeMatrix(13);
        $primeMatrix->generate_prime_numbers();
        
        // The first 13 prime numbers
        $expected_primes = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41];
        
        // Verify the generated prime numbers are as expected
        $this->assertEquals($expected_primes, $primeMatrix->prime_numbers);
    }

    // test with a very large prime numbers
    public function testGeneratePrimeNumbersWithVeryLargeNumber()
    {
        $largeNumber = 1000;
        $primeMatrix = new PrimeMatrix($largeNumber);
        $primeMatrix->generate_prime_numbers();
        $this->assertCount($largeNumber, $primeMatrix->prime_numbers);
    }

    // test with zero
    public function testGeneratePrimeNumbersWithZero()
    {
        $primeMatrix = new PrimeMatrix(0);
        $primeMatrix->generate_prime_numbers();
        $this->assertEmpty($primeMatrix->prime_numbers);
    }

    // test with three
    public function testGeneratePrimeNumbersWithThree()
    {
        $primeMatrix = new PrimeMatrix(3);
        $primeMatrix->generate_prime_numbers();
        $this->assertEquals([2, 3, 5], $primeMatrix->prime_numbers);
    }

}
