// HTML & CSS & PHP & javascript & MySQL & myPHPadmin

// The design of the following database system for managing a social network website:
Each user is registered with the website with a username, password, first name, last name, and an
email. Username and email are unique. Each user is associated with a list of hobbies, selected
from the following list: hiking, swimming, calligraphy, bowling, movie, cooking, and dancing. A
user can follow a list of other users and can also be followed by another list of users.

// Moreover, a user can post a blog, modify the blog, and delete it afterward. Given a blog, another
user, and only another user can give a comment to the blog, modify the comment, or delete the
comment afterward. To ensure the quality of the website, each user can post at most 2 blogs a day,
and each user can give at most 3 comments in one day. For each blog, the user who posted the
blog cannot give any comment (no self-comment), and another user can give at most one
comment. Each blog is identified by a blogid, subject, description, and a list of tags for search
purposes. Each comment is identified by a commentid, a sentiment (positive or negative), and a
description.

//Implemented a user registration and login interface so that only a registered user can
login into the system. Prevented the SQL injection attack.
Sign up for a new user with information such as: username, password, password
confirmed, first name, last name, email. Duplicate username, and email detected
and fail the signup. Unmatching passwords detected, as well.
When web application run, users databse created automaticlly.
Implemented a button called “Initialize Database”. When a user clicks it, all
necessary tables will be created (or recreated) automatically, with each table be populated
with some tuples so that each query below will return some results.Data connection (Username “john”, and password “pass1234”).

//Implemented a GUI interface so that a user can insert a blog such as
Subject: The future of blockchain
Description: Blockchain is a buzz word nowadays. …
Tags: blockchain, bitcoin, decentralized
//The ids of the blogs generated automatically using the autoincrement feature of
MySQL. A user can only insert 2 blogs a day.

//Select a blog from the above list; one can write a comment like the following:
A dropdown menu to choose “Negative” or “positive,” and then a description such as
“This is a nice blog. I like the comparison between blockchain and the Internet.”.
A user can give at most 3 comments a day and, at most, one comment for
each blog and not to his own blog.

//Reports:
1. List all the blogs of user X, such that all the comments are positive for these blogs.
2. List the users who posted the most number of blogs on specific date; if there is a tie,
list all the users who have a tie.
3. List the users who are followed by both X and Y. Usernames X and Y are inputs
from the user.
4. Display all the users who never posted a blog.
5. Display all the users who posted some comments, but each of them is negative.
6. Display those users such that all the blogs they posted so far never received any
negative comments.
