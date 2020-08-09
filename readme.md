#Natural HR - Coding challenge

###Brief
Create a user registration and login system with the ability to upload a file, utilising vanilla PHP.

####Index
Built an index file to perform lightweight routing, incorporating class/file validation, for request handling by breaking down request URL.
.htaccess directs all traffic through index.php

####Folder Structure
Built core application within an application folder, with a simplified rendition of an MVC pattern.

####Authentication
Used a signed token stored as a cookie for user authentication. If not present or expired, user will be presented with the login/signup page.

###Signup
Basic details, with email validation and minimum 8 character password.

###File upload
Simple file upload via ajax, with some basic file type restrictions.
Provided list of all uploaded files.

###Database
Used a simple MySQL database to track user and user file records. Connected by the user id integer.

###To do for production environment
To migrate to a production environment the following would need actioning:
* SSL connection to database with verified CA cert
* Ability to view and delete uploaded files
* User management system - create/update/delete user records
* Database migration tool
