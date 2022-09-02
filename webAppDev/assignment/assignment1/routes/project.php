<?php
namespace wp;
use Illuminate\Support\Facades\DB;

class Project {
  function __construct(){}    

  /* Find student with firstname and lastname */
  function find_student($first_name, $last_name) {
    $sql = "SELECT * FROM Student AS S WHERE S.first_name = ? AND S.last_name = ?;";
    $students = DB::select($sql, array($first_name, $last_name));
    $studentLen = count($students);
    // If we get more than one student or no students display an error
    if ($studentLen > 1) {
        die("Invalid query or result: $query\n");
    } elseif ($studentLen == 0) {
        return NULL;
    } else {
        // Extract the first student (which should be the only student)
        $student = $students[0];
        return $student;
    }
  }
}

?>