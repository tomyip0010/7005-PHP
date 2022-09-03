<?php
namespace wp;
use Illuminate\Support\Facades\DB;

class Company {
  function __construct(){}    

  /* Get project with the given id */
  function get_company($id) {
    $sql = "SELECT * FROM Company AS C WHERE C.id = ?";
    $items = DB::select($sql, array($id));
    // If we get more than one item or no items display an error
    if (count($items) != 1) {
        die("Invalid query or result: $sql\n");
    }
    // Extract the first item (which should be the only item)
    $item = $items[0];
    return $item;
  }

  /* Find company with company_name */
  function find_company($company_name) {
    $sql = "SELECT * FROM Company AS C WHERE C.company_name LIKE ?";
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

  function add_company($company_name, $location) {
    $sql = "INSERT INTO Company (company_name, location) VALUES (?, ?)";
    DB::insert($sql, array(trim($company_name), trim($location)));
    $id = DB::getPdo()->lastInsertId();
    return $id;
  }

  /* Gets all projects */
  function get_company_project_ranks() {
    $sql = "SELECT C.id, C.company_name, COUNT(P.id) AS 'project_no'
            FROM Project AS P, Company AS C
            WHERE P.company_id = C.id
            GROUP BY C.id
            ORDER BY project_no DESC";
    $items = DB::select($sql);
    return $items;
  }
}

?>