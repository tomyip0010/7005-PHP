<?php

use wp\Project;
use wp\Student;
use wp\Application;
use wp\Company;
require 'services/project.php';
require 'services/student.php';
require 'services/company.php';
require 'services/application.php';

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
function formValidation() {
    $availableSlot = request('availableSlot');
    $error = [];
    foreach(request()->except('_token', '_method') as $item => $value) {
        if (empty($value)) {
            $error[$item] = "Missing value\n";
        }
    }
    if (!empty($availableSlot) && !is_numeric($availableSlot)) {
        $error["availableSlot"] = "Nonnumeric value: $availableSlot\n";
    } elseif (!empty($availableSlot) && ($availableSlot < 3 || $availableSlot > 8 || $availableSlot != strval(intval($availableSlot)))) {
        $error["availableSlot"] = "Number entered must be between 3 to 8.\n";
    }

    return $error;
}

/** Home Page */
Route::get('/', function () {
    $projectServices = new Project();

    $projects = $projectServices -> get_projects();
    
    return view('home') -> with('projects', $projects);
});

/** Project Routes */
/** Get create project page */
Route::get('project/advertise', function () {
    $storedCompanyId = request() -> session() -> get('companyId');
    $company = array();
    $project = array();
    if (!empty($storedCompanyId)) {
        $companyServices = new Company();
        
        $existingCompany = $companyServices -> get_company($storedCompanyId);
        $company['company_name'] = $existingCompany -> company_name;
        $company['location'] = $existingCompany -> location;
    }
    return view('project/advertise') -> with('company', $company) -> with('project', $project) -> with('error', array());
});

/** Create new project */
Route::post('project/advertise', function () {
    $name = request('companyName');
    $location = request('location');
    $title = request('title');
    $relatedMajor = request('relatedMajor');
    $description = request('description');
    $availableSlot = request('availableSlot');
    
    $errors = formValidation();
    if (count($errors) > 0) {
        $company['company_name'] = $name;
        $company['location'] = $location;
        $project['title'] = $title;
        $project['relatedMajor'] = $relatedMajor;
        $project['description'] = $description;
        $project['availableSlot'] = $availableSlot;
        return view('project/advertise') -> with('company', $company) -> with('project', $project) -> withErrors($errors);
    }

    $companyServices = new Company();
    $projectServices = new Project();

    // Check if company exists or create a new one
    $company = $companyServices -> find_company($name);
    if (is_null($company)) {
        $companyId = $companyServices -> add_company($name, $location);
    } else {
        $companyId = $company -> id;
    }

    $projectId = $projectServices -> add_project($companyId, $location, $title, $relatedMajor, $description, $availableSlot);
    // If successfully created then display newly created project 
    if ($projectId) {
        request() -> session()-> put('companyId', $companyId);
        return redirect("project/$projectId");
    } else {
        die('Error adding new project');
    }
});

/** Get apply project page API */
Route::get('project/{projectId}/apply', function () {
    return view('project/apply') -> with('error', '');;
});

/** Apply project API */
Route::post('project/{projectId}/apply', function () {
    $projectId = request() -> projectId;
    $firstName = request('firstName');
    $lastName = request('lastName');
    $justification = request('justification');
    $priority = request('priority');

    $projectServices = new Project();
    $studentServices = new Student();
    $applicationServices = new Application();

    $project = $projectServices -> get_project($projectId);

    if (!($project -> id)) {
        die('Error project not found');
    }

    $student = $studentServices -> find_student($firstName, $lastName);

    if (is_null($student)) {
        $studentId = $studentServices -> add_student($firstName, $lastName);
    } else {
        $studentId = $student -> id;
    }

    $duplicatedApplication = $applicationServices -> check_application_duplication($projectId, $studentId);
    $studentApplicationNum = $studentServices -> get_student_applications($studentId);
    if (!empty($duplicatedApplication)) {
        $error = 'Error: You have already applied for this project.';
    } elseif (count($studentApplicationNum) >= 3) {
        $error = 'Error: 3 applications have already been made.';
    }
    if (!empty($error)) {
        return view('project/apply') -> with('error', $error);
    }

    $applicationServices -> add_application($projectId, $studentId, $justification, $priority);
    return redirect("project/$projectId");
});

/** Get project detail page API */
Route::get('project/{projectId}', function () {
    $projectId = request() -> projectId;

    $projectServices = new Project();

    $project = $projectServices -> get_project($projectId);
    $projectStudents = $projectServices -> get_project_students($projectId);

    return view('project/detail') -> with('projectId', $projectId) -> with('project', $project) -> with('students', $projectStudents);
});

/** Get edit project detail page API */
Route::get('project/edit/{projectId}', function () {
    $projectId = request() -> projectId;

    $projectServices = new Project();

    $project = $projectServices -> get_project($projectId);

    return view('project/edit') -> with('projectId', $projectId) -> with('project', $project);
});

/** Update Project Detail API */
Route::post('project/{projectId}', function () {
    $projectId = request() -> projectId;
    $title = request('title');
    $relatedMajor = request('relatedMajor');
    $description = request('description');
    $availableSlot = request('availableSlot');

    $projectServices = new Project();

    $project = $projectServices -> get_project($projectId);

    if (!($project -> id)) {
        die('Error project not found');
    }

    $errors = formValidation();
    if (count($errors) > 0) {
        return view('project/edit') -> with('project', $project) -> withErrors($errors);
    }

    $projectServices -> update_project($projectId, $title, $relatedMajor, $description, $availableSlot);
    return redirect("project/$projectId");
});

/** Delete Project API */
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

/** Get applicant detail page API */
Route::get('application/{applicationId}', function () {
    $applicationId = request() -> applicationId;

    $applicationServices = new Application();

    $application = $applicationServices -> get_application_detail($applicationId);
    
    return view('application/detail') -> with('application', $application);
});

/** Dashboard Routes */
Route::get('dashboard', function () {
    $companyServices = new Company();

    $companyAppRank = $companyServices -> get_company_project_ranks();
    return view('admin/dashboard') -> with('companies', $companyAppRank);
});

/** Assignmnet Requirement Docs Routes */
Route::get('requirement', function () {
    return response() -> file(storage_path('app/public/assignment.pdf'));
});
