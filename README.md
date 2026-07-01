# Beginner CRUD Guide

This project is a simple PHP CRUD system with three modules:
- Users
- Products
- Items

## What CRUD means
- Create: add new records
- Read: view records
- Update: edit records
- Delete: remove records

## How to run
1. Start XAMPP Apache and MySQL.
2. Open phpMyAdmin.
3. Create a database named crud_php.
4. Import the file database.sql.
5. Open http://localhost/Garcia4/

## Project folders
- users: manages user data
- products: manages product data
- items: manages item data
- config: database connection
- assets: CSS files

## Beginner tip
Each folder follows the same pattern:
- index.php shows the list
- create.php shows the form
- store.php saves data
- edit.php shows the edit form
- update.php saves edits
- view.php shows details
- delete.php removes data
