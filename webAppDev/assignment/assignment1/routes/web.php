<?php

use wp\Project;
use wp\Student;
use wp\Application;
use wp\Company;
use wp\Assignment;
require 'services/project.php';
require 'services/student.php';
require 'services/company.php';
require 'services/application.php';
require 'services/assignment.php';

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

/** Server side validation for company advertise form */
function formValidation() {
	$name = request('companyName');
  $location = request('location');
  $title = request('title');
  $relatedMajor = request('relatedMajor');
  $description = request('description');
  $availableSlot = request('availableSlot');
  $requestParams = ['companyName' => $name, 'location' => $location, 'title' => $title,
    'relatedMajor' => $relatedMajor, 'description' => $description, 'availableSlot' => $availableSlot];
	$error = [];

	/** Check if all field are filled */
	foreach($requestParams as $item => $value) {
		if (empty($value)) {
			$error[$item] = "Missing value\n";
		}
	}
	/** Check if the available slot is a number and within 3 to 8 */
	if (!empty($availableSlot) && !is_numeric($availableSlot)) {
		$error["availableSlot"] = "Nonnumeric value: $availableSlot\n";
	} elseif (!empty($availableSlot) && ($availableSlot < 3 || $availableSlot > 8 || $availableSlot != strval(intval($availableSlot)))) {
		$error["availableSlot"] = "Number entered must be between 3 to 8.\n";
	}

	return $error;
}

/** 
 * Home Page 
 * */
Route::get('/', function () {
  $projectServices = new Project();

  $projects = $projectServices -> get_projects();
  
  return view('home') -> with('projects', $projects);
});

/** 
 * Project Routes 
 * */
/** Get create project page */
Route::get('project/advertise', function () {
  /** Get stored companyId in the session cache */
  $storedCompanyId = request() -> session() -> get('companyId');
  $company = array();
  $project = array();

  /** retreive the company detail if there is a cached companyId */
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
  
  /** Server side form validation */
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

  /** Add a new project */
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

  /** Check if project exist */
  $project = $projectServices -> get_project($projectId);

  if (!($project -> id)) {
    die('Error project not found');
  }

  /** Check if student record exists ELSE create a new student */
  $student = $studentServices -> find_student($firstName, $lastName);

  if (is_null($student)) {
    $studentId = $studentServices -> add_student($firstName, $lastName);
  } else {
    $studentId = $student -> id;
  }

  /** Check if there is an application to the project by the student */
  $duplicatedApplication = $applicationServices -> check_application_duplication($projectId, $studentId);
  /** Check if the student already made 3 applicaations */
  $studentApplicationNum = $studentServices -> get_student_applications($studentId);
  
  if (!empty($duplicatedApplication)) {
    $error = 'Error: You have already applied for this project.';
  } elseif (count($studentApplicationNum) >= 3) {
    $error = 'Error: 3 applications have already been made.';
  }

  /** Check if errors */
  if (!empty($error)) {
    return view('project/apply') -> with('error', $error);
  }

  /** Apply student application */
  $applicationServices -> add_application($projectId, $studentId, $justification, $priority);
  return redirect("project/$projectId");
});

/** Get project assignment API */
Route::get('project/assignment', function () {
  $assignmentServices = new Assignment();

  $assignments = $assignmentServices -> get_assignments();

  return view('project/assignment') -> with('assignments', $assignments);
});

/** Post to assign student to project */
Route::post('project/assignment', function () {
  $projectServices = new Project();
  $studentServices = new Student();
  $assignmentServices = new Assignment();
  $projectServices = new Project();

  $students= $studentServices -> get_students();
  $projects = $projectServices -> get_projects();

  /** Reset all existing assignment */
  $assignmentServices -> drop_all_assignment();

  /** Going through all student */
  foreach($students as $student) {
    /** Get all applications of each student order by priority */
    $applications = $studentServices -> get_student_applications($student -> id);

    /** Going through each application */
    foreach($applications as $application) {
      $projectId = $application -> project_id;

      /** Check if the project still have available slot */
      $project = $projectServices -> get_project($projectId);
      $assignCount = count($projectServices -> get_project_assignments($projectId));
      $projectAvailableSlot = ($project -> available_slot) - $assignCount;

      /** If TRUE then assign the student to the project ELSE go to next priority application */
      if ($projectAvailableSlot > 0) {
        $assignmentId = $assignmentServices -> add_project_assignment($projectId, $student -> id);
        break;
      } else {
        continue;
      }
    }
  }

  /** Get all assignments records */
  $assignments = $assignmentServices -> get_assignments();
  
  return view('project/assignment') -> with('assignments', $assignments);
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
    return view('project/edit') -> with('projectId', $projectId) -> with('project', $project) -> withErrors($errors);
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

/** 
 * Company Routes 
 * */
Route::get('companies', function () {
  $companyServices = new Company();

  $companyAppRank = $companyServices -> get_company_project_ranks();
  return view('company/list') -> with('companies', $companyAppRank);
});

/** 
 * Students Routes 
 * */
Route::get('students', function () {
  $studentServices = new Student();

  // $studentList = $studentServices -> get_students();
  $students = $studentServices -> get_students_with_applications();

  return view('student/list') -> with('students', $students);
});

/** Student Detail Routes */
Route::get('student/detail/{studentId}', function () {
  $studentId = request() -> studentId;
  $studentServices = new Student();

  $student = $studentServices -> get_student($studentId);
  $studentApplications = $studentServices -> get_student_applications($studentId);
  return view('student/detail') -> with('student', $student) -> with('applications', $studentApplications);
});

/** Assignmnet Requirement Docs Routes */
Route::get('requirement', function () {
  return view('document/detail');
});
