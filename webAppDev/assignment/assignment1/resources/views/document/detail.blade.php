@extends('layouts.master')

@section('title')
  7005ICT ‐ Assignment 2
@endsection

@section('content')
  <div class="my-4">
    <h4>1.	ER Diagram</h4>
    <div class="p-4 mb-4">
      <img src="{{asset('img/ERD.png')}}" class="w-75 mb-4" alt="ERD" />
      <p>
        My ERD consists of 5 tables including Project, Application, Assignment, Student and Company. In the beginning, company table is extracted out into an independent table to cope with companies reside in different location with the same name. But it turns out company name is unique in this project.
      </p>
    </div>
  </div>

  <div class="my-4">
    <h4>2.	Describe what you were able to complete, what you were not able to complete. </h4>
    <div class="p-4 mb-4">
      <p>
        I have tried to complete all the requirements and everything seems to be working during my testing. 
      </p>
    </div>
  </div>

  <div class="my-4">
    <h4>3.	Reflect on the process you have applied to develop your solution (e.g. how did you get started, did you do any planning, how often do you test your code, how did you solve the problems you come across). What changes would you make for assignment 2 to improve your process?  </h4>
    <div class="p-4 mb-4">
      <p>
        The project starts with the construction of ERD by going through all the requirements. With the relationship between the tables in mind, then lists out all necessary methods involves within each Entity: get all / get one /update / delete. Plan the number of the page view involved and then draft the required routes with the basic implementation of PHP blade inheritance to ensure everything goes fine piece by piece in each stage. Prepare and populate the necessary data to the database to carry out testing for each small implementation. Starting from the listing of the project in the Home page to construct the API logic bit by bit and carry out testing during the processes. Have the unit testing for each functionalities to ensure it complies with the requirements.
      </p>
    </div>
  </div>

  <div class="my-4">
    <h4>4. If you have completed Task 15, you need to explain your method and justify how your assignment implementation satisfies the most number of students. </h4>
    <div class="p-4 mb-4">
      <p>
        The task is done by looping through the list of students one by one, checking if they had applied for any project. By retrieving the applications made by the student in the order of the priority set, then going through each application. Get the project of the corresponding application, check the available position within the project by subtracting the avalabileSlot property in the project with the number of assigned from the Assignment table. If there is still available slot, then assign student to the project, otherwise go to the next application by the student.
      </p>
    </div>
  </div>

@endsection