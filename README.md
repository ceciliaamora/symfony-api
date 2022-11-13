## Server Connection
php -S localhost:8000 -t public

## Read the database config and create the database
php bin/console doctrine:database:create  

## Implement Migrations
php bin/console doctrine:migrations:migrate

## Loading Fixtures
php bin/console doctrine:fixtures:load
###### PS: By default the load command purges the database, removing all data from every table.

## Endpoints
### Events API
* List all events, GET method
/api/events
* Retrieve one event by provided id, GET method
/api/events/{id}
* Create event, POST method
/api/events
* Delete event by provided id, DELETE method
/api/events/{id}
* Update event by provided id, PATCH method
/api/events/{id}

### Lectures API
* List all lectures, GET method
/api/lectures
* Retrieve one lecture by provided id, GET method
/api/lectures/{id}
* Create lecture, POST method
/api/lectures
* Delete lecture by provided id, DELETE method
/api/events/{id}
* Update lecture by provided id, PATCH method
/api/lectures/{id}

### Users API
* List all users, GET method
/api/users
* Retrieve one user by provided id, GET method
/api/users/{id}
* Create user, POST method
/api/users
* Delete user by provided id, DELETE method
/api/users/{id}
* Update user by provided id, PATCH method
/api/users/{id}