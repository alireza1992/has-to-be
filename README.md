## Challenge 2 (suggestions) :
1- Using nouns instead of verbs in the endpoints paths. (/rate could be /ratings)
2- Wrapping all the data in one place and adding message and using standard HTTP codes in the response
3- Caching (could be implemented on this api based on inputs by caching the output for the same inputs)
4- Versioning ( /v1 or /v2 etc)
5- Apply Rate Limit in case of unwanted attacks
6- Using api documentation tools like Swagger

***
## How to run the application
1- Run git clone from the github repository.
2- Run "docker-compose build app" to build the application.
3- Run docker-compose up -d to make the containers up and running.

***
## How to run testsuite
For running unit tests, inside of the php container run :
1- ./vendor/bin/phpunit path/to/test/file

***
## Things that could be included but did not due to avoid over engineering
1- Design patterns

2- Implementing migrations for saving the total price (that could be used for caching as well)

3- Log system for any possible future data analysis

***
## Things to consider
1- For following git flow, each step has been committed separately 
2- There are two branches : master and feature/rating_process
