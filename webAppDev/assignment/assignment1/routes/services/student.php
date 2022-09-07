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

  /* Get all applications of specified student */
  function get_student_applications($studetnId) {
    $sql = "SELECT * FROM Application AS A, Student AS S, Project AS P, Company AS C WHERE A.student_id = S.id AND A.project_id = P.id AND P.company_id = C.id AND S.id = ? ORDER BY A.priority ASC";
    $items = DB::select($sql, array($studetnId));
    return $items;
  }

  /* Gets all students */
  function get_students() {
    $sql = "SELECT * FROM Student AS S";
    $items = DB::select($sql);
    return $items;
  }

  /* Get student with the given id */
  function get_student($id) {
    $sql = "SELECT * FROM Student AS S WHERE S.id = ?";
    $items = DB::select($sql, array($id));
    // If we get more than one item or no items display an error
    if (count($items) != 1) {
      die("Invalid query or result: $sql\n");
    }
    // Extract the first item (which should be the only item)
    $item = $items[0];
    return $item;
  }

  /* Get student with the given id */
  function get_students_with_applications() {
    $sql = "SELECT * FROM Student AS S, Application AS A WHERE A.student_id = S.id GROUP BY S.id HAVING COUNT(A.id) > 0";
    $items = DB::select($sql);
    
    return $items;
  }
}

?>