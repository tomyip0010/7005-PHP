<?php
namespace wp;
use Illuminate\Support\Facades\DB;

class Student {
  function __construct(){}    

  /* Find student with firstname and lastname */
  function find_student($first_name, $last_name) {
    $sql = "SELECT * FROM Student AS S WHERE S.first_name LIKE ? AND S.last_name LIKE ?;";
    $students = DB::select($sql, array(trim($first_name), trim($last_name)));
    $studentLen = count($students);
    // If we get more than one student or no students display an error
    if ($studentLen > 1) {
        die("Invalid query or result: $sql\n");
    } elseif ($studentLen == 0) {
        return NULL;
    } else {
        // Extract the first student (which should be the only student)
        $student = $students[0];
        return $student;
    }
  }

  /* Create new student */
  function add_student($first_name, $last_name) {
    $sql = "INSERT INTO Student (first_name, last_name) VALUES (?, ?)";
    DB::insert($sql, array($first_name, $last_name));
    $id = DB::getPdo()->lastInsertId();
    return $id;
  }

  function get_student_applications($studetnId) {
    $sql = "SELECT * FROM Application AS A, Student AS S WHERE A.student_id = S.id AND S.id = ?";
    $items = DB::select($sql, array($studetnId));
    return $items;
  }
}

?>