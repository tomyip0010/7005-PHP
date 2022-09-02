<?php

use wp\Project;
require 'project.php';

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Find company with company_name */
function find_company($company_name) {
    $sql = "SELECT * FROM Company AS C WHERE C.company_name = ?";
    $items = DB::select($sql, array($company_name));
    $itemLen = count($items);
    // If we get more than one item or no items display an error
    if ($itemLen > 1) {
        die("Invalid query or result: $query\n");
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
    DB::insert($sql, array($company_name, $location));
    $id = DB::getPdo()->lastInsertId();
    return $id;
}

/* Create new student */
function add_student($first_name, $last_name) {
    $sql = "INSERT INTO Student (first_name, last_name) VALUES (?, ?)";
    DB::insert($sql, array($first_name, $last_name));
    $id = DB::getPdo()->lastInsertId();
    return $id;
}

/* Create new application */
function add_application($projectId, $studentId, $justification, $priority) {
    $sql = "INSERT INTO Application (project_id, student_id, justification, priority) VALUES (?, ?, ?, ?)";
    DB::insert($sql, array($projectId, $studentId, $justification, $priority));
    $id = DB::getPdo()->lastInsertId();
    return $id;
} 

Route::get('/', function () {
    $projectServices = new Project();
    $projects = $projectServices -> get_projects();
    return view('home') -> with('projects', $projects);
});

/** Project Routes */

/** Get create project page */
Route::get('project/advertise', function () {
    return view('project/advertise');
});

/** Create new project */
Route::post('project/advertise', function () {
    $name = request('companyName');
    $location = request('location');
    $title = request('title');
    $relatedMajor = request('relatedMajor');
    $description = request('description');
    $availableSlot = request('availableSlot');

    // Check if company exists or create a new one
    $company = find_company($name);
    if (is_null($company)) {
        $companyId = add_company($name, $location);
    } else {
        $companyId = $company -> id;
    }
    $projectServices = new Project();
    $projectId = $projectServices -> add_project($companyId, $location, $title, $relatedMajor, $description, $availableSlot);
    // If successfully created then display newly created project 
    if ($projectId) {
        return redirect("project/$projectId");
    } else {
        die('Error adding new project');
    }
});

/** Get apply project page */
Route::get('project/{projectId}/apply', function () {
    return view('project/apply');
});

Route::post('project/{projectId}/apply', function () {
    $projectId = request() -> projectId;
    $projectServices = new Project();
    $project = $projectServices -> get_project($projectId);
    if (!($project -> id)) {
        die('Error project not found');
    }
    $firstName = request('firstName');
    $lastName = request('lastName');
    $justification = request('justification');
    $priority = request('pri$priority');
    $student = find_student($firstName, $lastName);
    if (is_null($student)) {
        $studentId = add_student($firstName, $lastName);
    } else {
        $studentId = $student -> id;
    }
    add_application($projectId, $studentId, $justification, $priority);
    return redirect("project/$projectId");
});

/** Get project detail page */
Route::get('project/{projectId}', function () {
    $projectId = request() -> projectId;
    $projectServices = new Project();
    $project = $projectServices -> get_project($projectId);
    $projectStudents = $projectServices -> get_project_students($projectId);
    return view('project/detail') -> with('project', $project) -> with('students', $projectStudents);
});

/** Get edit project detail page */
Route::get('project/edit/{projectId}', function () {
    $projectId = request() -> projectId;
    $projectServices = new Project();
    $project = $projectServices -> get_project($projectId);
    return view('project/edit') -> with('project', $project);
});

/** Update Project Detail */
Route::post('project/{projectId}', function () {
    $projectId = request() -> projectId;
    $projectServices = new Project();
    $project = $projectServices -> get_project($projectId);
    if (!($project -> id)) {
        die('Error project not found');
    }
    $title = request('title');
    $relatedMajor = request('relatedMajor');
    $description = request('description');
    $availableSlot = request('availableSlot');
    $projectServices -> update_project($projectId, $title, $relatedMajor, $description, $availableSlot);
    return redirect("project/$projectId");
});

/** Delete Project */
Route::get('project/delete/{projectId}', function () {
    $projectId = request() -> projectId;
    $projectServices = new Project();
    $project = $projectServices -> get_project($projectId);
    if (!($project -> id)) {
        die('Error project not found');
    }
    $projectServices -> delete_project($projectId);
    return redirect("/");
});

/** Dashboard Routes */
Route::get('dashboard', function () {
    return view('admin/dashboard');
});
