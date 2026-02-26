# Taskey

Taskey is a basic task management application that allows users to
create, view, edit, and delete tasks. (this is done using CRUD operations with a connected database like SQLite)
Each task has attributes such as:
- title
- description
- priority
- status
- timestamps

Users can organize tasks into projects for better management.

---

## Maestro

Taskey is built using the Maestro Framework.
Maestro is a lightweight PHP framework that follows the MVC (Model, View and Controller) architectural pattern,
making it easy to develop and maintain web applications.

---

## Running Taskey Locally

In bash, type the following:

```
git clone <your-repo-url>
````
to install the following command:
```
php -S localhost:8000 -t public
```

# Tutorial

This project includes a multi‑day learning journey where you build both 
the Maestro framework and the Taskey application from scratch.

# Day 0

Before we begin, welcome to the Taskey tutorial! 
Over the next several days, we’ll build a simple task management web application
from scratch using PHP. 
We will develop a framework called “Maestro” along the way, 
learning key concepts of web development, OOP, and design patterns. 
Using Maestro, we’ll implement features required for Taskey.

## Maestro framework Overview

Maestro is a lightweight PHP framework designed to help you understand the fundamentals 
of web application development. 
It provides a simple structure for handling HTTP requests, routing, 
controllers, views, and data persistence.

## Taskey web application Overview

Taskey is a basic task management application that allows users to create,
view, edit, and delete tasks. Each task has attributes such as title,
description, priority, status, and timestamps. 
Users can organise tasks into projects for better management.

## User Stories

- As a user, I want to view a list of tasks so that I can see what needs to be done.
- As a user, I want to create new tasks so that I can keep track of my work.
- As a user, I want to edit existing tasks so that I can update their details.
- As a user, I want to delete tasks so that I can remove completed or irrelevant items.
- As a user, I want to view task details so that I can see all information about a specific task.
- As a user, I want to organise tasks into projects so that I can manage related tasks together.


## Prerequisites

Before starting this tutorial, ensure you have the following installed:
- PHP 8.2 or higher
- Composer <br>
  You should also have:
- Familiarity with PHP and OOP concepts
- Basic understanding of HTTP
- Understanding of class diagrams and sequence diagrams

# Day 1

## Part 0: The Beginning

##### Objective: <br>
Set up a new Git repository with a basic structure.<br>
Concepts:<br>
- Git repository
• 	
Goals
• 	Initialise a new Git repository
• 	Create a  that excludes IDE files, Twig cache, Composer vendor/lock, env files, and SQLite databases
• 	Add a minimal README.md with project name and author
• 	Commit and push to a new GitHub repository
Fragment

# Authors
 - [Frans Blauw](https://github.com/FransBlauw)
 - [Valeria Stamenova](https://github.com/v-stamenova)