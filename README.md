
# Sport Events
I have used Laravel as back-end Php Framework and ( Vue.Js And TailwindCss for front-end ) .
I also used Laravel Sanctum for Authentication. 

Goal is to implement a calendar for sport events. Events may be added to the calendar and it should be possible to categorize the events based on sports.
Examples:
- Sat., 18.07.2019, 18:30, Football, Salzburg – Sturm
- Sun., 23.10.2019, 09:45, Ice Hockey, KAC - Capitals

### Video Introduction ,I say Definitely have a look at it !
 [Watch Video - Click Here ](https://payamblog.com/SportRadar.mp4) 
 
 ### Describing the project.
 
 ![Sport Radar ERD Image](https://payamblog.com/ERD_photo.png)
 
 As you can see in above picture, well we have different Sport Fields. and I assumed that maybe a team should can participate in different Sport fields, Like it participates in Football and also in Basketball , so I made the connection as many to many and we have a middle table named sport_team , that connects teams and sports together, this way teams can participate in more than just one sport field.
 
 We have events , that they have date , sport field of the event and the teams who have match together. I could add more stuff to it like the results, I could add them in the events table or make a seprate table for the results.

## How to Setup project

- run command : `composer install`
- run command : `npm install`
- run command : `php artisan key:generate`
- change `.env.example` File to `.env` you don't need to setup database because we don't use database in this project.
- set SANCTUM_STATEFUL_DOMAINS below APP_URL in .env file to your domain name.
- run command : `php artisan migrate`
- run command : `php artisan db:seed` ,It's important to generate user and password for admin
- run command : `npm rum watch`
- run command : `php artisan serve`

to run tests you can use this command in terminal (command line):

 `php artisan test`
 
 or
 
 `./vendor/bin/phpunit`

### Don't forget
to use Laravel Sanctum for authentication you neeed to set SANCTUM_STATEFUL_DOMAINS below APP_URL in .env file to your domain name.

# Made By :
Payam Ghader Kourehpaz [https://payamblog.com](https://payamblog.com)
