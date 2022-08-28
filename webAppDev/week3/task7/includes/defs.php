<?php
/* 
 * factors($n) returns an array of prime factors of valid integer $n. 
 * Precondition: 2 <= n <= MAHP_MAX_INT = 2^31-1.
 * Note that it is executed for its _value_ not for its _effect_.
 */
function factors($n) {
    $factors = array(); # initialise $factors to be an empty array
    $cand = 2;
    while ($n > 1 && $cand*$cand <= $n) {
        while ($n > 1 && $n % $cand == 0) {
            $factors[] = $cand; # append $cand to the array $factors
            $n = $n / $cand;
        }
        $cand++;
    }
    if ($n > 1) {
        $factors[] = $n; # append $n to the array $factors
    }
    return $factors;
}

/*
* Append the factorisation to file for record
*/
function storeFactors($line) {
    $file = 'factorisation.txt';
    if (file_exists($file)) {
        $fp_out = fopen('factorisation.txt', "a"); 
        fputs($fp_out, $line.PHP_EOL);
    } else {
        $fp_out = fopen('factorisation.txt', "w"); 
        fputs($fp_out, $line.PHP_EOL);
    }
    fclose($fp_out);
}

/*
* Read the factor records from the file
*/
function readFactors() {
    $factors = [];
    $file = 'factorisation.txt';
    if (file_exists($file)) {
        $fp_in = fopen($file, "r");
        while (!feof($fp_in)) { 
            $line = fgets($fp_in, 4096);
            if (!empty($line)) {
                $factors[] = $line;
            }
        } 
    }
    return $factors;
}
?>
