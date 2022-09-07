@extends('layouts.master')

@section('title')
  Assignment Document
@endsection

@section('content')
  <h2>2703ICT ‐ Assignment 2</h2>
  <div>
    <p>Due Date: 5pm Friday 7 October 2022 (Week 11)</p>
    <p>Weight: 50%</p>
    <p>Individual Assignment</p>
  </div>

  <div>
    <h5>Introduction</h5>
    <p>
      In assignment 2, we will create a food ordering portal (e.g. Menulog, Deliveroo, Uber Eats). With this 
      portal, restaurants can list the dishes they want to sell. Customers can order selected dishes.
    </p>
  </div>

  <div>
    <h5>Details</h5>
    Your implementation must use Laravel’s migrations, seeders, models, ORM/Eloquent, route, 
    controllers, validator, and view/blade. You have some freedom in designing your website, however, it 
    must satisfy the following requirements: 
    <ul>
      <li>
        1. Users can register with this website. When registering, users must provide their name, email, 
        password, and address.  Furthermore, users must register as either a: 
        a. Restaurant, or 
        b. Member (customer).
      </li>
      <li>
        2. Registered users can login. Users should be able to login (or get to the login page) from any 
        page. Once logged in, the username and the user type (Restaurant or Member) will be 
        displayed at the top of every page. A logged in user should be able to log out. 
      </li>
      <li>
        3. Only the restaurant can add dishes to the list of dishes sold by his/her restaurant. They can 
        also update and delete existing dishes. A dish must have a name, description, and a price. A 
        dish name must be unique and be more than 3 characters. The description can be left empty. A 
        price must be a positive value. 
      </li>
      <li>
        4. List‐detail. All users (including those that are not logged in) can see a list of registered 
        restaurants. They can click into any restaurant to see the dishes this restaurant sells. 
      </li>
      <li>
        5. Pagination should be implemented for either the list of restaurant or dishes. You can decide 
        how many restaurant/dishes per page. However, you need to have sufficient data to show your 
        pagination works.  
      </li>
      <li>
        6. Single purchase. Only members/customers can purchase a dish. Since we do not deal with 
        payment gateways in this course, when user clicks on purchase, we simply assume the 
        payment is successful, and save the purchase order in the database. Then it will display the 
        dish purchased, the price, and the delivery address (which is the customer’s address) to let the 
        user know that the purchase is successful. 
      </li>
      <li>
        7. A restaurant can see a list of orders customers have placed on his/her restaurant. An order 
        should consist of the name and address of the customer, that dish (name) that was ordered, 
        and the date that the order was placed. 
      </li>
      <li>
        8. Input validation must be performed for all input. If invalid input is detected, the appropriate 
        error message must be displayed, along with the previous entered value. 
      </li>
    </ul>
    <div>
      The above are the basic requirements. Below are the more advanced requirements. We recommend 
      students first complete the basic requirements (make a backup copy of your assignment) before 
      attempting the more advanced requirements: 
    </div>
    <ul>
      <li>
        9. When restaurant add a new dish, the dish name must be unique for that restaurant, not 
        across restaurants. This is an extension of requirement 3. 
      </li>
      <li>
        10. There is a page which lists the top 5 most popular (most ordered) dishes in the last 30 days. It 
        also shows how many times each dish is ordered. 
      </li>
      <li>
        11. Any logged in user can upload photos for a dish (upload can be one photo at a time). When 
        displaying a dish, all the uploaded photos for that dish and the name of the uploader will be 
        displayed. 
      </li>
      <li>
        12. In addition to requirement 6 (single purchase), consumers can add multiple dishes to a cart, 
        see the contents in the cart, the cost of this cart (the sum of all dishes), remove any unwanted 
        dishes, before purchasing these dishes.  Once purchased, the cart will be emptied. With this, 
        requirement 7 also has the ability to show multiple dishes per order. 
      </li>
      <li>
        13. Restaurants can run promotion where selected dishes from that restaurant is discounted by a 
        certain percentage (e.g. 10% discount). There is a way for the restaurant to select which dish is 
        on promotion, and the percentage of discount (this could be done via the update page). When 
        displaying dishes on promotion, their original price, discounted price, and the percentage of 
        discount will be displayed. 
      </li>
      <li>
        14. There is another user type called administrator. There is only one administrator which is 
        created through seeder. The purpose of administrator is to approve new restaurant (users). 
        After a new restaurant user (account) is registered, s/he cannot add/remove dishes from 
        his/her restaurant until this account is approved by the administrator. There is a page where 
        the administrator can go to see a list of new restaurant accounts that require approval, and to 
        approve these accounts. 
      </li>
      <li>
        15. Customers can save their favourite dishes. There is a way for customers to easily see their 
        favourite dishes. Note: a customer should not be able to favourite the same dish more than 
        once. 
      </li>
      <li>
        16. After a customer has favourited 5 or more dishes, the application will show this user some 
        recommend dishes that the user may like. The recommended dish(es) should not be one of 
        the favourites but is based on the user’s favourite dishes and possibility other factors. You have 
        the freedom to design and implement this feature. You can even collect additional information 
        from customers and restaurant to support this feature. You will be judged on the quality of the 
        recommendation, creativity/innovation, and also technical competence. 
      </li>
    </ul>
    <div>
      Hint: If you are not able to properly implement user registration of different user types, you can still 
      seed the users, restaurants, and dishes so you can implement other functionalities. 
    </div>
    <h5>Technical requirements</h5>
    <ul>
      <li>Use Laravel’s migration for database table creation. </li>
      <li>Use Laravel’s seeder to insert default test data into the database. There should be enough 
initial data to thoroughly test the retrieval, update, and deletion functionalities you have 
implemented. </li>
      <li>Use Laravel’s ORM/Eloquent to perform database operations. Only partial mark will be 
awarded for implementations using SQL or query builder. </li>
      <li>Proper security measures must be implemented. </li>
      <li>You must NOT implement any client side (html/Javascript) validation, so your server-side 
validation can be tested. </li>
      <li>Good coding practice is expected. This includes: </li>
      <ul>
        <li>Naming:  using consistent, readable, and descriptive names for files, functions, variables etc.  </li>
        <li>Readability: correct indenting/spacing of code. </li>
        <li>Commenting: there should at least be a short description for each function. </li>
        <li>View: proper use of template and template inheritance. </li>
      </ul>
    </ul>
    <h5>Documentation </h5>
    <p>Provide the following documentation in no more than 1 page:  </p>
    <ul>
      <li>An ER diagram for the database. Note: many-to-many relationships must be broken down into 
one-to-many. </li>
      <li>Describe what you were able to complete, what you were not able to complete.  </li>
      <li>Reflect on the process you have applied to develop your solution (e.g. how did you get started, 
did you do any planning, how often do you test your code, how did you solve the problems you 
come across).  </li>
      <li>If you have completed the recommendation feature, describe how you have implemented this 
feature. </li>
    </ul>
    <div>This documentation should also be provided as a page in your website and linked to from the 
navigation menu. </div>
    <div>For further details of the requirements, refer to the marking rubric. All requirements from both the 
assignment specification and marking rubric must be satisfied. </div>
    <h5>Submission Requirements </h5>
    <div>You must submit the following items for the assignment: </div>
    <ul>
      <li>A compressed file containing ALL source files in your submission (including all PHP code), but 
excludes the vendor and node_modules directories.  </li>
      <ul>
        <li>This file must be submitted via the LMS through the assignment 2 link. 
Note: Delete the vendor and node_modules directories before you compress the files. (Restore 
the vendor directory before your demonstration with the command: composer update. The 
node_modules directory can be restored by the command: npm install). Use the zip command 
to compress your assignment directory (see Lecture 1-3).  </li>
      </ul>
      <li>A PDF file containing your documentations. </li>
    </ul>
    <div>Note: You are responsible for regularly backing up your work. Hence, if you lose your file due to not 
backing up, then expect to be heavily penalised. </div>
    <h5>Assignment Demonstration and Marking </h5>
    <div>After you have completed your peer review, you must demonstrate and explain your work to your 
tutor in Week 12 lab to have your submission marked by your tutor. </div>
    <u>If you do not demonstrate your assignment to your tutor, your submission will be regarded as 
incomplete, hence you will not receive a mark for this assessment item! </u>
    <div>During the demonstration, you need to show the last modified date of your file (on Elf, run the 
command: ls ‐la in your routes directory). </div>
    <b>Warning: We take student academic misconduct very seriously! </b>
  </div>


@endsection