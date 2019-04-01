# Introduction
This project is prepared for company X as part of interview process. The project is to build RESTful API that provides anagrams.

# Design Overview
I utilized MVC and dependency injection architecture for this project. Most of modern frameworks are doing this making them lightweight.

# Directory Structure
```
.
├── .env > config parameters
├── README.md
├── app
│   ├── configs > configuration classes, includes list of services for the dependency injection.
│   ├── controllers > controller classes
│   ├── lib > helper classes
│   ├── models > database schema definition
│   ├── routes > router class
│   ├── services > business logic
│   └── validators > validators for API requests
├── logs > logs every requests to a file
├── node_modules > installed after running npm install
├── data > mongodb directory / updated dictionary.txt (with header type)
├── package-lock.json
├── package.json
├── server.js > run 'node server' to start!
└── tests > test files in ruby
```

# Coding Standard
Airbnb JavaScript Style Guide (https://github.com/airbnb/javascript)

# Requirements (listed versions I have on my local machine)
- node (10.8.0)
- npm (6.2.0)
- ruby (2.3.3)
- mongodb (4.0.6)

# Getting Started
install dependencies
> npm install

start mongodb by executing below command in the project root folder
>  mongod --dbpath data/db

load dictionary to the database
> mongoimport -d MT -c dictionaries --type csv --file data/dictionary.txt --columnsHaveTypes --headerline

Start node server, please make sure nothing is running on port 3000. To change port please update .env file
> node server

# API Routes

## Get
Get anagrams for aerst
> http://localhost:3000/anagrams/aerst.json

Get statistics (longest, shortest word, etc)
> http://localhost:3000/words/stats.json

## Post
Add words to the database
> http://localhost:3000/words.json

## Delete
Delete bear from the database
> http://localhost:3000/words/bear.json

Delete all words
> http://localhost:3000/words.json

# Things I learned while working on this project
## mongoDB
I probably should not have used mongoDB, I spent too much time on it! :( but hey I learned a lot!

### Lesson learned
running import from txt file could add NaN and Infinity data types to the database.
'infinity' string actually gets added as infinity data type. So, I had to change the import to account for this
 
infinity data type gets added using this command
> mongoimport -d MT -c dictionaries --type csv --file data/dictionary.txt -f word

with this no infinity yay!
> mongoimport -d MT -c dictionaries --type csv --file data/dictionary.txt --columnsHaveTypes --headerline

## Javascript
- use async/await is much better than callbacks and promises

# Things to improve on
- Improve query speed on mongoDB
- Add standard sanitization on the request body/params/query

# Tests 
Ruby test has been added to package.json, to run execute:
> npm test

to test via curl (e.g.)
>  curl -i -X POST -d '{"words":["read", "dear", "dare"]}' http://localhost:3000/words.json -H "Content-Type: application/json"s
