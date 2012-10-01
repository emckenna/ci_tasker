
# Plan

* set up users
* assume no auth
* simple editing of users
* create task model
* task CRUD
* invites
* rules
* stats

## Assumptions
 * tasks are in hour increments.

## Notes
 * DB and vhost config information are under the setup directory.
 * .htaccess added for cleaner URL.

# Scheduling Application

Design and implement a scheduling application given a multiuser environment. Each user has their own task list and can do the following actions.

This application should be written in a PHP framework, ideally in Code Igniter, but any other common MVC framework is fine.

The database choice has to be either MySQL or PostgreSQL. Please provide the database schema that can be loaded into the database that you have chosen.

This application should have a test suite of your choice, (i.e. testing framework provided by the MVC framework, UnitTest, Regression testing, or whatever seems fit)

## Actions

### Tasks

* Display tasks for a given user
* Display upcoming tasks (today, this week)
* Schedule a new task for a given user
* Edit a task for a given user
* Delete a task for a given user

### Invitations

* Accept Invitation to a task
* Reject Invitation to a task

### Statistics

* Show number of hours spent on tasks for a given year/month by a given user
* Show number of hours spent on tasks for a given year/month for all users
* People connected to the user for a given user 

### Rules

* Tasks may never be conflicting
    * A task is conflicting if it shares a time slot with a different task on a users task list
* A user may only act upon his own items
    * User cannot create/edit/delete for a different user
* A connection is when a user was invited or has invited someone for a task
* If a shared task is deleted from the creator's calendar, it should be removed from all users
* If a shared task is deleted from the invitees calendar, it should constitute a rejection response
* If a shared task is updated with a new date, it should require a fresh response and the old responses are forgotten.

￼￼
## Definitions

### Task

* Start Time/Date
* End Time/Date
* Recurrence
    * Daily, Weekly, Monthly, One time
* Description
* Invitees (other users)
* Attendees (users that accepted the task in their calendar)

### User

* First Name
* Last Name

