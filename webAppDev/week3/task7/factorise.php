<?php
/*
 * Script to print the prime factors of a single positive integer
 * sent from a form.
 * BAD STYLE: Does not use templates.
 */
include "includes/defs.php";

# Set $number to the value entered in the form.
$number = $_GET['number'];
$error = '';
$factorList = readFactors();

# Check $number is nonempty, numeric and between 2 and PHP_MAX_INT = 2^31-1.
# (PHP makes it difficult to do this naturally; see the manual.)
if (empty($number)) {
    $error = "Error: Missing value\n";
    // exit;
} else if (!is_numeric($number)) {
    $error = "Error: Nonnumeric value: $number\n";
    // exit;
} else if ($number < 2 || $number != strval(intval($number))) {
    $error = "Error: Invalid number: $number\n";
    // exit;
} else {
    # Set $factors to the array of factors of $number.
    $factors = factors($number);
    # Set $factors to a single dot-separated string of numbers in the array.
    $factors = join(" . ", $factors);
    storeFactors("$number = $factors");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Factors</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles/wp.css">
  </head>
  
  <body>  
    <h1>Factorisation</h1>

    <?php
      if ($error) {
        echo "<p class='alert'>$error</p>";
      } else {
        echo "$number = $factors";
      }
    ?>
    <?php
      if (!$error && count($factorList) > 0) {
    ?>
      <br />
      <table class="bordered mt-5">
        <thead>
          <tr>
            <th>Record</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($factorList as $factor) {
              print 
                  "<tr><td>{$factor}</td></tr>";
            }
          ?>
        </tbody>
      </table>
    <?php } ?>

    <h2><i>Another factorisation</i></h2>
    <form method="get" action="factorise.php">
      <p>Number to factorise: <input type="text" name="number" value="<?= htmlspecialchars($number) ?>">
      <p><input type="submit" value="Factorise it!">
    </form>
    <hr>
    <p>
    Sources:
    <a href="show.php?file=factorise.php">factorise.php</a>
    <a href="show.php?file=includes/defs.php">includes/defs.php</a>
    </p>
  </body>
</html>
