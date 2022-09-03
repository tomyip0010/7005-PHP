<?php
namespace wp;
use Illuminate\Support\Facades\DB;

class Application {
  function __construct(){}    

  /* Create new application */
  function add_application($projectId, $studentId, $justification, $priority) {
    $sql = "INSERT INTO Application (project_id, student_id, justification, priority) VALUES (?, ?, ?, ?)";
    DB::insert($sql, array($projectId, $studentId, $justification, $priority));
    $id = DB::getPdo()->lastInsertId();
    return $id;
  }

  /* Get application with the given id */
  function get_application_detail($id) {
    $sql = "SELECT * FROM Application AS A, Student AS S, Project AS P, Company AS C WHERE P.company_id = C.id AND P.id = A.project_id AND S.id = A.student_id AND A.id = ?";
    $items = DB::select($sql, array($id));
    // If we get more than one item or no items display an error
    if (count($items) != 1) {
        die("Invalid query or result: $sql\n");
    }
    // Extract the first item (which should be the only item)
    $item = $items[0];
    return $item;
  }

  function check_application_duplication($projectId, $studentId) {
    $sql = "SELECT * FROM Application AS A WHERE A.project_id = ? AND  A.student_id = ?";
    $items = DB::select($sql, array($projectId, $studentId));

    return $items;
  }
}

?>