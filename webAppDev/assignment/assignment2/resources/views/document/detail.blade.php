@extends('layouts.app')

@section('title')
  7005ICT ‐ Assignment 2
@endsection

@section('content')
  <div class="my-4">
    <h4>1.	ER Diagram</h4>
    <div class="p-4 mb-4">
      <img src="{{asset('img/ERD.png')}}" class="w-75 mb-4" alt="ERD" />
      <p>
        My ERD consists of 5 tables including User, Order, Dish, Image, and Favourite.
      </p>
      <p>
        This application is built upon several assumptions:
      </p>
      <ul>
        <li>-Only customer can place orders</li>
        <li>-Customer can only place order on single restaurant each time</li>
        <li>-Any user can upload image for dishes</li>
      </ul>
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
    <h4>3.	Reflect on the process you have applied to develop your solution (e.g. how did you get started, did you do any planning, how often do you test your code, how did you solve the problems you come across). </h4>
    <div class="p-4 mb-4">
      <p>
        The project starts with the construction of ERD by going through all the requirements. With the relationship between the tables in mind, then lists out all necessary methods involves within each Entity: get all / get one /update / delete. Plan the number of the page view involved and then draft the required routes with the basic implementation of PHP blade inheritance to ensure everything goes fine piece by piece in each stage. Prepare and populate the necessary data to the database to carry out testing for each small implementation. Starting from the user register, login and then handle customer and restaurant user type to construct the API logic bit by bit and carry out testing during the processes. By developing the components bit by bit and running sufficient tests before progress to another one. When there is issue, isolating the piece of functions and print out the intermediate values by dd() helps to debug the trouble.
      </p>
    </div>
  </div>

  <div class="my-4">
    <h4>4. If you have completed the recommendation feature, describe how you have implemented this feature.  </h4>
    <div class="p-4 mb-4">
      <p>
        The platform is established recently and still in the early stage. There is not much information introduced to gather the reviews on dishes and restaurants. The only thing to rely on is the order placed by customer. The recommendation system is built upon the idea that people with the similar taste will tends to order the same kind of dishes. This implies that by using favorited dishes and the dishes in orders as the common factor, searching the orders which consists of the largest number of common factors will allow the system to predict the customer’s flavor.
      </p>
    </div>
  </div>

@endsection