<?php
namespace wp;
use Illuminate\Support\Facades\DB;

class Assignment {
  function __construct(){}    

  /* Gets all assignments */
  function get_assignments() {
    $sql = "SELECT * FROM Assignment AS A, Student AS S, Project AS P WHERE A.student_id = S.id AND A.project_id = P.id";
    $items = DB::select($sql);
    return $items;
  }

   /* Assign student to a project */
  function add_project_assignment($id, $studentId) {
    $sql = "INSERT INTO Assignment (project_id, student_id) VALUES (?, ?)";
    DB::insert($sql, array($id, $studentId));
    $id = DB::getPdo()->lastInsertId();
    return $id;
  }

  /* Remove all current assignments */
  function drop_all_assignment() {
    $sql = "DELETE FROM Assignment";
    $items = DB::select($sql);
    return $items;
  }
}

?>