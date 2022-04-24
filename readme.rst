###################
Movies library web app
###################

The movies library web app developed using following the tech
- Codeigniter 3 with php
- JavaScript
- MySql
- Omdbapi

*******************
Features of web app
*******************
- Account creation usin email address.
- Login using pass and email address
- Web app don't accept the duplicate email address.
- Create playList and view playList
- Save movies in particulare playList
- Search movies by ttile name
    Note: The omdbapi only accept minimum 4 letter of title name 

**************************
Setup in xampp/lampp server
**************************
- Clone repo or download and extract the in the location of ``htdocs/``
- Create database and import database.sql file in your local system database
- Open ``application/config/database.php`` and change databasename, password and username as per your database settings.
- Open ``application/config/config.php`` and setup your base_url for the web app
- Run ``localhost/[Your folder name]`` on your browser.

**************************
Files intro
**************************
- ``[main_dir]/application/controllers/User.php `` This is main controller of the app.
- The omdbapi functionalities included inside the api model ``[main_dir]/application/models/MoviesApi.php``
- You can find auth functionalities inside the auth model ``[main_dir]/application/models/Auth.php``
- The basic functionalities of app included inside the basic model ``[main_dir]/application/models/Basic.php`` 
- The all views are available here  ``[main_dir]/application/views/public``
- The route of web app are available here ``[main_dir]/application/config/routes.php``

