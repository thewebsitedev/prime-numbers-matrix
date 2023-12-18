<?php

namespace GT;

/**
 * PrimeMatrix class
 * 
 * @package GT
 */
class PrimeMatrix
{
    public $number;
    public $prime_numbers = [];
    public $error;

    public function __construct($number)
    {
        $this->number = $number;
        // check if number exists
        if (false !== $this->number) {
            // make sure the input is a number
            if ($this->is_negative($this->number)) {
                $this->error = "Input must be a whole number, not a negative number or a string.";
                return;
            }
            //  make sure the input is not less than 1
            if ($this->number < 1) {
                $this->error = "Input must be a whole number greater than 0.";
                return;
            }
            // make sure the input is not a decimal
            if ($this->is_double_float($this->number)) {
                $this->error = "Input must be a whole number, not a decimal or a string.";
                return;
            }
            // make sure the input is a whole number
            if (!$this->is_whole_number($this->number)) {
                $this->error = "Input must be a whole number greater than 0.";
                return;
            }
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
     * @return bool
     */
    public function is_whole_number()
    {
        // Check if the number is numeric
        if ((is_int($this->number) || is_float($this->number))) {
            // Cast the number to a float and check if it's equal to its integer counterpart
            return (float)$this->number == (int)$this->number;
        }
        return false;
    }

    /**
     * Check if the input is a double float
     * Checks if the input has decimal places
     * 
     * @return bool
     */
    public function is_double_float()
    {
        // Check if the value is a float and has a fractional part
        return is_float($this->number) && ((float)$this->number != (int)$this->number);
    }

    /**
     * Check if the input is not negative
     * 
     * @return bool
     */
    public function is_negative()
    {
        return $this->number < 0;
    }

    /**
     * Generate prime numbers
     * 
     * @return array
     */
    public function generate_prime_numbers()
    {
        // if the input is greater than 0
        if ($this->number > 0) {
            // assign the input to a variable
            $n = $this->number;
            // set the upper limit
            $upperLimit = ($n < 6) ? 15 : intval($n * (log($n) + log(log($n))));
            // set all numbers to true
            $prime = array_fill(0, $upperLimit + 1, true);
            // set 0 and 1 to false
            for ($p = 2; $p * $p <= $upperLimit; $p++) {
                // if $prime[$p] is not changed, then it is a prime
                if ($prime[$p] == true) {
                    // update all multiples of $p
                    for ($i = $p * $p; $i <= $upperLimit; $i += $p)
                        // mark multiples of $p as non-prime
                        $prime[$i] = false;
                }
            }

            // store all prime numbers
            $this->prime_numbers = [];
            // 
            for ($p = 2; $p <= $upperLimit; $p++) {
                if ($prime[$p]) {
                    $this->prime_numbers[] = $p;
                    if (count($this->prime_numbers) >= $this->number) {
                        break;
                    }
                }
            }
        }
    }
}
