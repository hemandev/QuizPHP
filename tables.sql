create table attemp_answer
(
	id int auto_increment
		primary key,
	attempt_id int null,
	question_id int null,
	answer varchar(30) null,
	result int null,
	constraint attemp_answer_id_uindex
		unique (id)
)
;

create index attemp_answer_question_id_fk
	on attemp_answer (question_id)
;

create index attemp_answer_user_test_attempts_id_fk
	on attemp_answer (attempt_id)
;

create table question
(
	id int auto_increment
		primary key,
	question text null,
	op1 varchar(30) null,
	op2 varchar(30) null,
	op3 varchar(30) null,
	op4 varchar(30) null,
	ans varchar(30) null,
	question_category int null,
	constraint question_id_uindex
		unique (id)
)
;

create index question_tests_id_fk
	on question (question_category)
;

alter table attemp_answer
	add constraint attemp_answer_question_id_fk
		foreign key (question_id) references question (id)
;

create table tests
(
	id int auto_increment
		primary key,
	test_name varchar(30) null,
	category int null,
	constraint tests_id_uindex
		unique (id)
)
;

alter table question
	add constraint question_tests_id_fk
		foreign key (question_category) references tests (id)
;

create table user
(
	id int auto_increment
		primary key,
	email varchar(30) not null,
	password varchar(30) not null,
	f_name varchar(30) null,
	l_name varchar(30) null,
	phone_no varchar(12) null,
	address text null,
	constraint user_id_uindex
		unique (id),
	constraint user_email_uindex
		unique (email)
)
;

create table user_test_attempts
(
	id int auto_increment
		primary key,
	user_id int null,
	test_id int null,
	questions text null,
	current_question int null,
	score int null,
	attempt_status varchar(30) null,
	count int default '1' null,
	constraint user_test_attempts_id_uindex
		unique (id),
	constraint user_test_attempts_user_id_fk
		foreign key (user_id) references user (id)
			on update cascade,
	constraint user_test_attempts_tests_id_fk
		foreign key (test_id) references tests (id)
			on update cascade
)
;

create index user_test_attempts_tests_id_fk
	on user_test_attempts (test_id)
;

create index user_test_attempts_user_id_fk
	on user_test_attempts (user_id)
;

alter table attemp_answer
	add constraint attemp_answer_user_test_attempts_id_fk
		foreign key (attempt_id) references user_test_attempts (id)
;

