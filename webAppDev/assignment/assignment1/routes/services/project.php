<?php
namespace wp;
use Illuminate\Support\Facades\DB;

class Project {
  function __construct(){}    

  /* Gets all projects */
  function get_projects() {
    $sql = "SELECT P.id, P.title, P.company_name, P.available_slot, (SELECT COUNT(*) FROM Application AS A WHERE A.project_id = P.id) AS 'application_no'
            FROM Project AS P";
    $items = DB::select($sql);
    return $items;
  }

  /* Get project with the given id */
  function get_project($id) {
    $sql = "SELECT * FROM Project AS P WHERE P.id = ?";
    $items = DB::select($sql, array($id));
    // If we get more than one item or no items display an error
    if (count($items) != 1) {
        die("Invalid query or result: $sql\n");
    }
    // Extract the first item (which should be the only item)
    $item = $items[0];
    return $item;
  }

  /* Create new project */
  function add_project($companyName, $location, $title, $relatedMajor, $description, $availableSlot) {
    $sql = "INSERT INTO Project (company_name, location, title, related_major, description, available_slot) VALUES (?, ?, ?, ?, ?, ?)";
    DB::insert($sql, array($companyName, $location, $title, $relatedMajor, $description, $availableSlot));
    $id = DB::getPdo()->lastInsertId();
    return $id;
  }

  /* Update project detail */
  function update_project($projectId, $title, $relatedMajor, $description, $availableSlot) { 
    $sql = "UPDATE Project SET title = ?, related_major = ?, description = ?, available_slot = ? WHERE id = ?";   
    DB::update($sql, array($title, $relatedMajor, $description, $availableSlot, $projectId));
  }

  /* Delete project */
  function delete_project($id) {
    $deleteApplicationSql = "DELETE FROM Application AS A WHERE A.project_id = ?;";
    $deleteAssignmentSql = "DELETE FROM Assignment AS A WHERE A.project_id = ?;";
    $deleteProjectSql = "DELETE FROM Project WHERE id = ?"; 
    DB::delete($deleteApplicationSql, array($id)); 
    DB::delete($deleteAssignmentSql, array($id)); 
    DB::delete($deleteProjectSql, array($id)); 
  }

  /* Gets all students applied for a specific project */
  function get_project_students($id) {
    $sql = "SELECT S.id, S.first_name, S.last_name, A.priority, A.id AS applicationId FROM Project AS P, Student AS S, Application AS A WHERE A.project_id = P.id AND A.student_id = S.id and P.id = ?;";
    $items = DB::select($sql, array($id));
    return $items;
  }

  /* Gets all applications of a specific project */
  function get_project_applications($id) {
    $sql = "SELECT * FROM Project AS P, Application AS A WHERE A.project_id = P.id and P.id = ?;";
    $items = DB::select($sql, array($id));
    return $items;
  }

  /* Gets existing project assignment */
  function get_project_assignments($id) {
    $sql = "SELECT * FROM Project AS P, Assignment AS A WHERE A.project_id = P.id and P.id = ?;";
    $items = DB::select($sql, array($id));
    return $items;
  }

  /* Find company with company_name */
  function find_company($company_name) {
    $sql = "SELECT * FROM Project AS P WHERE P.company_name LIKE ?";
    $items = DB::select($sql, array(trim($company_name)));
    $itemLen = count($items);
    // If we get more than one item or no items display an error
    if ($itemLen > 1) {
      die("Invalid query or result: $sql\n");
    } elseif ($itemLen == 0) {
      return NULL;
    } else {
      // Extract the first item (which should be the only item)
      $item = $items[0];
      return $item;
    }
  }

  /* Gets all projects */
  function get_company_project_ranks() {
    $sql = "SELECT COUNT(*) AS 'project_no', P.id, P.company_name
            FROM Project AS P
            GROUP BY P.company_name
            ORDER BY project_no DESC";
    $items = DB::select($sql);
    return $items;
  }
}

?>