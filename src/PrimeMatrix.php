<?php

namespace GT;

class PrimeMatrix {
    public $number;
    public $prime_numbers = [];
    public $error;

    public function __construct($number) {
        $this->number = $number;
        // check if number exists
        if (false !== $this->number) {
            // make sure the input is a number
            if ($this->is_negative($this->number)) {
                $this->error = "Input must be a whole number, not a negative number or a string.";
                return;
            }
            if ($this->is_double_float($this->number)) {
                $this->error = "Input must be a whole number, not a decimal or a string.";
                return;
            }
            if (!$this->is_whole_number($this->number)) {
                $this->error = "Input must be a whole number greater than 0.";
                return;
            }
        } else {
            // if number does not exist
            $this->error = "Please enter a number";
            return;
        }
        // if there are no errors
        if (empty($this->error)) {
            // generate the matrix
            $this->generate_prime_numbers($this->number);
        }
    }

    /**
     * Check if the input is a whole number
     * Checks if the input is a number, greater than 0 and has no decimal places
     * 
     * @param $n - number of prime numbers to be generated
     * @return bool
     */
    public function is_whole_number($n)
    {
        // Check if the number is numeric and greater than 0
        if ((is_int($n) || is_float($n)) && $n > 0) {
            // Cast the number to a float and check if it's equal to its integer counterpart
            return (float)$n == (int)$n;
        }
        return false;
    }

    /**
     * Check if the input is a double float
     * Checks if the input has decimal places
     * 
     * @param $n - number to be checked
     * @return bool
     */
    public function is_double_float($n)
    {
        // Check if the value is a float and has a fractional part
        return is_float($n) && ((float)$n != (int)$n);
    }

    /**
     * Check if the input is not negative
     * 
     * @param $n - number to be checked
     * @return bool
     */
    public function is_negative($n)
    {
        return $n < 0;
    }

    /**
     * Check if the input is a prime number
     * 
     * @param $n - number to be checked
     * @return bool
     */
    public function is_prime_number($n)
    {
        // convert to integer
        $n = (int) $n;
        // 1 is not a prime number
        if ($n <= 1) {
            $this->error = "Please enter a number";
            return false;
        }
        // 2 is the only even prime number
        if ($n === 2) {
            return true;
        }
        // anything other than 2 that is even is not a prime number
        if ($n % 2 === 0) {
            return false;
        }
        // closest integer to the square root of the input
        // if a number is not divisible by any number up to its square root, it is a prime number.
        $ceil = ceil(sqrt($n));
        // check all odd numbers from 3 to the square root of the input
        for ($i = 3; $i <= $ceil; $i = $i + 2) {
            // check divisibility
            if ($n % $i === 0) {
                // If `$n` is divisible by any `$i`, it is not a prime number
                return false;
            }
        }

        return true;
    }

    /**
     * Generate prime numbers
     * 
     * @return array
     */
    public function generate_prime_numbers() {
        $i = 2;
        // loop until the number of prime numbers is equal to the input
        while (count($this->prime_numbers) < $this->number) {
            if ($this->is_prime_number($i)) {
                $this->prime_numbers[] = $i;
            }
            $i++;
        }
    }
}