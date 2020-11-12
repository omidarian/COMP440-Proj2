DROP TABLE IF EXISTS `comments`; 
DROP TABLE IF EXISTS `blogstags`;
DROP TABLE IF EXISTS `blogs`;
DROP TABLE IF EXISTS `follows`;
DROP TABLE IF EXISTS `hobbies`;


create table hobbies(
	username varchar(20),
	hobby varchar(50),
	primary key (username, hobby),
    foreign key (username) references users (username)
);


create table follows(
	leader	varchar(20), 
	follower	varchar(20), 
	primary key (leader,follower),
    foreign key (leader) references users (username),
    foreign key (follower) references users (username)
);


create table blogs(
	blogid	int not null Auto_increment, 
	subject	varchar(150) not null,
    description varchar(250),
    postuser varchar(20) not null,
    pdate date,
    primary key (blogid),
    foreign key (postuser) references users (username)
);


create table blogstags(
	blogid int not null,
    tag varchar(50),
    primary key (blogid,tag),
    foreign key (blogid) references blogs (blogid)
);


create table comments(
	commentid int not null Auto_increment,
	sentiment	varchar(20),
    description varchar(250),
    cdate date,
    blogid int not null,
    author varchar(20) not null,
	primary key (commentid),
    foreign key (blogid) references blogs (blogid),
    foreign key (author) references users (username)
);


/***********************/
/* insert sample data */

delete from comments;
delete from blogstags;
delete from blogs;
delete from follows;
delete from hobbies;


insert into hobbies values('Ben', 'hiking');
insert into hobbies values('Ben', 'swimming');
insert into hobbies values('Ben', 'calligraphy');
insert into hobbies values('Mery', 'bowling');
insert into hobbies values('Mery', 'movie');
insert into hobbies values('Shery', 'cooking');
insert into hobbies values('Lily', 'dancing');

insert into follows values('Ben', 'Mery');
insert into follows values('Ben', 'Lily');
insert into follows values('Mery', 'Ben');
insert into follows values('Shery', 'Lily');

insert into blogs (subject, description, postuser, pdate) values('Today is nice day', 'Today is nice day because is sunny and I like the sunny day. We are going to the beach.','Ben', '20/11/10');
insert into blogs (subject, description, postuser, pdate) values('My second post', 'Today is sunny again and I like the sunny day. We are going to the beach.','Ben', '20/11/11');
insert into blogs (subject, description, postuser, pdate) values('Brand Icons Design Using Css', 'Lorem ipsum dolor sit amet, id nec conceptam conclusionemque. Et eam tation option. Utinam salutatus ex eum. Ne mea dicit tibique facilisi, ea mei omittam explicari conclusionemque, ad nobis propriae quaerendum sea.','Mery', '20/10/02');
insert into blogs (subject, description, postuser, pdate) values('Cool Big Social Counter Button With Bootstrap', 'Lorem ipsum dolor sit amet, id nec conceptam conclusionemque. Et eam tation option. Utinam salutatus ex eum.','Mery', '20/10/03');
insert into blogs (subject, description, postuser, pdate) values('A STATEMENT FROM LAFORUM PRESIDENT', 'It is time to pick a side. The Los Angeles Forum for Architecture and Urban Design takes an unequivocal stand against racism and makes a greater and permanent commitment to change.','Lily', '20/10/04');

insert into blogstags values(1, 'Today');
insert into blogstags values(1, 'Sunny');
insert into blogstags values(1, 'Beach');
insert into blogstags values(2, 'second');
insert into blogstags values(2, 'again');
insert into blogstags values(3, 'Social');
insert into blogstags values(4, 'From');
insert into blogstags values(4, 'Statement');

insert into comments (sentiment, description, cdate, blogid, author) values( 'Positive', 'I like your post. I like sunny day too.', '20/10/01', '1', 'Lily');
insert into comments (sentiment, description, cdate, blogid, author) values( 'Negative', 'I dont like the sun at all and i dont like you Ben.', '20/10/02', '1', 'Mery');
insert into comments (sentiment, description, cdate, blogid, author) values( 'Positive', 'I hate every thing form you but I like you.', '20/10/03', '3', 'Lily');
insert into comments (sentiment, description, cdate, blogid, author) values( 'Positive', 'Could you please add more post about PRESIDENT.', '20/10/04', '5', 'Shery');

