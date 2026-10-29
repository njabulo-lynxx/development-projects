# Student-Portal

A new Student Portal web application built from scratch as a learning and development project. This is one of the two software development projects I had to complete in my final year of college.

The goal is to create a cleaner, more modern and understandable Student Portal while strengthening my understanding of how HTML, CSS, JavaScript, PHP and MySQL work together. In short, I just want to completely understand and improve my understanding on web development.

---

## Project Goals

The project will:

* Provide a student-facing portal
* Provide an administration area
* Display student information
* Provide academic information and reports
* Allow appropriate student information to be managed
* Generate useful documents where necessary
* Provide a responsive and accessible interface
* Use a clean and maintainable project structure

The application will be developed incrementally rather than building the entire system at once.

---

## Development Approach

The application will be built in the following stages:

### 1. Planning and Documentation

Define:

* Project purpose
* Users and roles
* Main features
* Application structure
* Development roadmap

### 2. HTML Structure

Build the initial structure of the application using semantic HTML.

At this stage, the focus will be on:

* Page structure
* Navigation
* Headers
* Main content areas
* Forms
* Tables
* Reusable interface sections

No database functionality will be required yet.

### 3. CSS and Interface Design

Create the visual design of the application.

This stage will focus on:

* Layout
* Typography
* Spacing
* Colours
* Components
* Responsive design
* Mobile-first development

### 4. JavaScript

Introduce JavaScript where it provides useful client-side functionality.

Examples may include:

* Navigation interactions
* Form interactions
* Interface controls
* Validation
* Dynamic content

JavaScript will not be added simply for the sake of using JavaScript.

### 5. PHP

Introduce PHP after the basic interface has been established.

PHP will be used to:

* Process forms
* Create reusable server-side components
* Manage sessions
* Handle authentication
* Connect the application to the database

The PHP implementation will be developed gradually so that the relationship between the front end and back end remains understandable.

### 6. Database

Introduce MySQL after the application's basic structure and PHP foundation are ready.

The database will eventually store information such as:

* Student accounts
* Student profiles
* Academic information
* Authentication information
* Other required portal data

The database structure will be designed specifically for the new application rather than copied directly from the previous project.

### 7. Additional Features

Once the core application works, additional functionality can be introduced.

Potential features include:

* Student reports
* Registration documentation
* Administration tools
* Improved validation
* Additional security measures
* Other useful student-management features

---

## Application Users

The initial application will support three types of users:

### Guest

A visitor who has not authenticated.

Possible access:

* Landing page
* Login
* Registration or other publicly available information

### Student

An authenticated student.

Possible access:

* Dashboard
* Profile
* Academic information
* Reports
* Student-specific documents

### Administrator

An authenticated administrator.

Possible access:

* Administration dashboard
* Student management
* Student information
* Academic information
* Administrative reports

The exact permissions will be defined as the application develops.

---

## Technology

The project will use:

* HTML5
* CSS3
* JavaScript
* PHP
* MySQL

Additional libraries or technologies may be introduced when there is a clear reason to use them.

---

## Development Principles

The project will follow these principles:

### Build from scratch

The new Student-Portal will not be a direct refactor of the previous System Dev SA1 project.

The previous project may be used as a reference when useful.

### Understand before implementing

Code should be understood before it is added to the project.

When introducing PHP, the purpose of the syntax and the relationship between PHP and HTML should be understood rather than simply copying code.

### Keep the structure simple

The project should have a clear structure that makes it easy to locate files and understand their purpose.

### Build incrementally

Features will be added in small stages.

Each stage should produce something that can be tested before moving to the next stage.

### Avoid unnecessary complexity

Libraries, frameworks and additional technologies should only be introduced when they solve an actual problem.

---

## Planned Application Structure

The exact structure will evolve during development, but the application will be separated into logical areas such as:

```text
student-portal/
│
├── assets/
├── database/
├── includes/
├── pages/
├── actions/
├── documents/
└── libraries/
```

The purpose of each directory will be established before the application grows.

---

## Development Roadmap

* [x] Create new project
* [ ] Document project
* [ ] Plan application structure
* [ ] Create initial HTML structure
* [ ] Build navigation
* [ ] Build initial pages
* [ ] Create CSS foundation
* [ ] Make interface responsive
* [ ] Introduce JavaScript
* [ ] Introduce PHP
* [ ] Implement authentication
* [ ] Design database
* [ ] Connect PHP to MySQL
* [ ] Implement student functionality
* [ ] Implement administrator functionality
* [ ] Implement reports/documents
* [ ] Test application
* [ ] Improve security
* [ ] Finalise documentation

---

## Current Stage

**Stage: Planning and HTML structure**

The project currently contains no application code.

The first implementation stage is to build the application's HTML structure before introducing PHP, JavaScript or database functionality.

**Section 1: Initial HTML Structure completed 2026/09/28**
I have established:
* The HTML document foundation
* Header
* Site branding
* Navigation
* Main content
* Landing-page introduction
* Primary login action
* Footer
* Semantic HTML structure

**Section 2: HTML Application Structure completed 2026/09/28**
I have learned:
* semantic HTML structure
* reusable PHP templates
* require
* how PHP assembles a page
* the relationship between PHP and HTML
* shared vs page-specific content
* why use .php files even though the page contains very little PHP

*Current project state:*
```text
Student-Portal/
├── index.php
├── header.php
└── footer.php
```


