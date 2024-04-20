create database if not exists Registry_Department;
use Registry_Department;
#drop database Registry_Department;

drop table if exists Students;
create table Students
(
	studentID int auto_increment,
    fname varchar(20) not null,
    mname varchar(25) not null,
    lname varchar(20) not null,    
	Semail varchar(50) not null,
    Pemail varchar(50),    
    address varchar(60) not null,
    Mtele varchar(12) not null,
    Htele varchar(12) not null,
    Wtele varchar(12) not null,    
	nextOfKin varchar(50) not null,
    nextOfKinContact varchar(12) not null,    
    program varchar(20) not null,
    GPA float(3,2) default 0.0,
    primary key (studentID)   
) auto_increment = 20241000;

insert into Students(fname,mname,lname,Semail,Pemail,address,Mtele,Htele,Wtele,nextOfKin,nextOfKinContact,program) values
("Dan","Leon","Jones","dan@school.sch","dan@home.hm","Home, LakeView Ave","876-123-4567","876-987-6543","876-102-0304","Winsome Jones","876-456-7890","Psychology"),
("Paula","Donna","March","paula@school.sch","paula@home.hm","Apt, Waterloo Street","876-765-4321","876-345-6789","876-506-0708","Pete March","876-901-2345","Mathematics"),
("Viola","Windy","Davy","v@school.sch","v@home.hm","Hut, Park Way","876-345-2345","876-789-7890","876-908-0809","Trevor Windy Snr","876-369-0963","Law"),
("Jeffery","Ludlow","Homer","jeff@school.sch","jeff@home.hm","Shack, HillTop","876-567-6767","876-876-8766","876-102-9384","Tiasha Pinnock","876-910-1010","Law"),
("Ruth","Mina","Lyons","ruthie@school.sch","ruth@home.hm","Apt 3, River Heightd","876-654-9876","876-324-1509","876-981-2345","Dennis Lyons","876-210-9012","Psychology"),
("Donovan","Delroy","Davis","dono@school.sch","dono@home.hm","Villa, Uptown Road","876-665-5443","876-996-6330","876-558-8022","Jina Wills","876-770-4411","Mathematics");
select * from Students  where studentID = 20241000;

drop table if exists Lecturers;
create table Lecturers
(
	lecturerID int not null,
	title varchar(10) not null,
    fname varchar(20) not null,
    lname varchar(20) not null,    
	department varchar(20) not null,
    position varchar(20),    
    primary key (lecturerID)   
);

insert into Lecturers(lecturerID,title,fname,lname,department,position) values
(901001,"Mr.","Kingsley","Thomas","Behavioral Sciences","Adjunct Lecturer"),
(901002,"Mr.","Timothy","Williams","Law","Staff Lecturer"),
(901003,"Ms.","Cindy","Willis","Mathematics","Staff Lecturer"),
(901004,"Mrs.","Jenna","Brown","Law","Adjunct Lecturer"),
(901005,"Ms.","Tianna","Whollery","Student Services","Adjunct Lecturer"),
(901006,"Mr.","Brandon","King","Language","Staff Lecturer"),
(901007,"Mrs.","Lianna","Henry-Ward","Behavioral Sciences","Staff Lecturer");
select * from Lecturers;

drop table if exists Registry_Login;
create table Registry_Login
(
	registryPersonelleNo int auto_increment primary key,
    registryPersonelle varchar(15) not null,
    registryUsername varchar(15) not null,
    registryPassword varchar(20) not null
);

insert into Registry_Login (registryPersonelle,registryUsername,registryPassword) values
("Admin","admin","admin"),
("Registry","registry","registry"),
("Admin2","admin","123456");
select * from Registry_Login;

drop table if exists Courses;
create table Courses
(
	coursecode varchar(10) not null,
	coursetitle varchar(30) not null,
    coursecredits int not null,
    coursedegreelevel varchar(20) not null,    
    primary key (coursecode)
);

insert into Courses(coursecode,coursetitle,coursecredits,coursedegreelevel) values
("UNI100","University Life",1,"Associate"),
("ENG101","Academic Writing",3,"Associate"),
("PSY102","Intro to Psychology",3,"Bachelor"),
("PSY302","Clinical Psychology",3,"Bachelor"), #<---
("MTH103","College Math",3,"Bachelor"),
("MTH203","Calculus 1",3,"Bachelor"),  #<---
("LAW111","Intro to Law",3,"Bachelor"),
("LAW411","Land Law",3,"Bachelor");  #<---
select * from Courses;

drop table if exists Course_Description;
create table Course_Description
(
	courseDescriptioncode varchar(10) not null primary key,
	courseDescription varchar(5000) not null,
    foreign key (courseDescriptioncode) references  Courses(coursecode)
);

insert into Course_Description(courseDescriptioncode,courseDescription) values
("UNI100","Introduction to University Life is designed to help new students transition to the academic and social aspects of university. This course typically covers topics such as study skills, time management, campus resources, academic planning, and goal setting. Additionally, students will learn about university policies, procedures, and support services available to them. This course aims to familiarize students with the university environment, promote a sense of community, and provide strategies for academic success and personal development during their time at the university."),
("ENG101","Academic Writing focuses on developing students' ability to write clear, coherent, and well-structured essays, research papers, and other academic documents. Students will learn about the principles of effective writing, including organization, argumentation, evidence-based reasoning, and proper citation of sources. This course also covers various writing styles, such as expository, persuasive, and analytical writing, and emphasizes the importance of critical thinking and revision. Additionally, students may learn about research techniques, source evaluation, and ethical considerations in academic writing. The goal is to equip students with the skills necessary to communicate their ideas effectively in an academic context."),
("PSY102","Introduction to Psychology provides an overview of the fundamental principles and theories of psychology. Students will explore topics such as the history of psychology, research methods, biological bases of behavior, sensation and perception, learning and memory, cognition, development, personality, social psychology, and mental health. This course aims to familiarize students with the diverse areas of psychology and the scientific study of human behavior and mental processes, laying the groundwork for further exploration in the field of psychology."),
("PSY302","Clinical Psychology delves into the assessment, diagnosis, and treatment of mental health disorders. Students will explore topics such as psychopathology, psychological assessment methods, therapeutic interventions, and ethical considerations in clinical practice. This course will cover various theoretical approaches to psychotherapy, such as cognitive-behavioral therapy, psychodynamic therapy, and humanistic-existential therapy. Additionally, students will learn about research methods in clinical psychology, cultural considerations in assessment and treatment, and the role of clinical psychologists in different settings. The goal is to provide students with a comprehensive understanding of the practice of clinical psychology and the skills necessary for working in the field."), #<---
("MTH103","College Algebra covers fundamental algebraic concepts such as equations, inequalities, functions, graphs, and their applications. Students learn to manipulate algebraic expressions, solve equations and inequalities, work with functions and their properties, and explore topics like polynomial, rational, exponential, and logarithmic functions. This course aims to develop students' algebraic reasoning and problem-solving skills, laying a strong foundation for further studies in mathematics and related fields."),
("MTH203","Calculus 1 covers the foundational concepts of differential and integral calculus. Students will learn about limits, derivatives, and their applications in analyzing functions, rates of change, and optimization problems. This course also introduces the concept of integration and its applications in finding areas, volumes, and solving related rate problems. Additionally, students explore topics such as the fundamental theorem of calculus, techniques of integration, and applications of integrals. The goal of the course is to provide students with a solid understanding of the fundamental principles of calculus and their practical applications."),  #<---
("LAW111","Introduction to Law introduces students to the fundamental principles and concepts of the legal system. Students explore topics such as the sources of law, the structure of the legal system, different branches of law, and the principles of legal reasoning. This course will cover foundational areas of law such as constitutional law, criminal law, civil law, and administrative law, providing an overview of key legal principles and landmark cases. Additionally, students will learn about legal ethics, the role of precedent, and the basics of legal analysis and argumentation. The goal is to provide students with a broad understanding of the legal framework and its impact on society."),
("LAW411","Land Law focuses on the legal principles and regulations governing land and property rights. Students will explore topics such as the nature of property, estates and interests in land, land registration, co-ownership, easements, and the law of landlord and tenant. This course will also cover the legal implications of land use, development, and environmental considerations. Additionally, students will study the legal remedies available in cases of property disputes and the impact of land law on real estate transactions. The goal of the course is to provide students with a comprehensive understanding of the legal framework surrounding land and property, as well as the practical application of land law principles.");  #<---
select * from Course_Description;

drop table if exists Prerequisites;
create table Prerequisites
(
	prerequisiteNO int not null,
    coursecode varchar(10) not null,
    prerequisite varchar(10) not null,
    primary key(prerequisiteNO,coursecode,prerequisite),
    foreign key (coursecode) references Courses(coursecode),
    foreign key (prerequisite) references Courses(coursecode)
);

insert into Prerequisites(prerequisiteNO,coursecode,prerequisite) values
(1,"MTH203","MTH103"),
(2,"MTH203","UNI100"),
(3,"PSY302","PSY102"),
(4,"PSY302","UNI100"),
(5,"LAW411","UNI100"),
(6,"LAW411","LAW111"),
(7,"LAW411","ENG101");
select * from Prerequisites;

drop table if exists Course_Schedule;
create table Course_Schedule
(
	courseScheduleSection int not null, #<---
	courseScheduleCode varchar(10) not null, #<---
    courseScheduleSemester int not null,
    courseScheduleYear int not null,
    courseScheduleDay int not null, #2 < Day < 5
    courseScheduleTime int not null,
    courseScheduleLocation varchar(20) not null,
    courseScheduleLecturerID int not null, #<---
    primary key(courseScheduleSection,courseScheduleCode,courseScheduleLecturerID),
    foreign key (courseScheduleCode) references Courses(coursecode),
    foreign key (courseScheduleLecturerID) references Lecturers(lecturerID)
);

insert into Course_Schedule(courseScheduleSection,courseScheduleCode,courseScheduleSemester,
courseScheduleYear,courseScheduleDay,courseScheduleTime,courseScheduleLocation,courseScheduleLecturerID) values
(10101,"ENG101",1,1,4,14,"Classroom 3",901006),
(20101,"ENG101",1,1,2,16,"ONLINE",901006),
(10111,"LAW111",1,1,3,13,"Classroom 5",901004),
(10411,"LAW411",1,4,2,10,"Online",901002),
(10103,"MTH103",1,1,5,9,"Classroom 5",901003),
(20103,"MTH103",1,1,3,4,"Classroom 4",901003),
(10203,"MTH203",1,2,4,12,"Classroom 1",901003),
(10102,"PSY102",1,1,3,17,"Classroom 2",901001),
(20102,"PSY102",1,1,2,18,"ONLINE",901007),
(10302,"PSY302",2,3,5,20,"ONLINE",901007),
(10100,"UNI100",1,1,2,8,"Classroom 4",901005),
(20100,"UNI100",1,1,3,8,"Classroom 4",901005);
select * from Course_Schedule;

drop table if exists Grades;
create table Grades
(
	grade varchar(2) not null primary key,
	gradeScaleLow float(4,2) not null,
    gradeScaleHigh float(5,2) not null,
    qualityPoint float(5,2) not null,
    award varchar(20) not null
);

insert into Grades(grade,gradeScaleLow,gradeScaleHigh,qualityPoint,award) values
("F",0,39.9,0.00,"Fail"),
("D",40,49.9,1.67,"Fail"),
("C",50,54.9,2.00,"Pass"),
("C+",55,59.9,2.33,"Credit"),
("B-",60,64.9,2.67,"Credit"),
("B",65,74.9,3.00,"Cum Laude"),
("B+",75,79.9,3.50,"Magna Cum Laude"),
("A-",80,89.9,3.67,"Summa Cum Laude"),
("A",90,100,4.00,"Summa Cum Laude");
select * from Grades;

drop table if exists Enrolment;
create table Enrolment
(
	enrolmentNo int auto_increment,
    enrolmentSectionCode int not null,
    enrolmentStudentID int not null,
    enrolmentCourseWorkGrade float(4,2) default 0.0,
    enrolmentFinalExamORProjectGrade float(4,2) default 0.0,
    enrolmentFinalGrade float(4,2),
    primary key (enrolmentNo,enrolmentSectionCode,enrolmentStudentID),
    foreign key (enrolmentSectionCode) references Course_Schedule(courseScheduleSection),
    foreign key (enrolmentStudentID) references Students(studentID)
);

insert into Enrolment(enrolmentSectionCode, enrolmentStudentID, enrolmentCourseWorkGrade, enrolmentFinalExamORProjectGrade) values
(20101, 20241000, 57.5, 38.5),
(10100, 20241000, 56.0, 38.0),
(10203, 20241000, 24.0, 25.5), #<-- fail D - 49.5

(10101, 20241001, 45.5, 37.5),
(20100, 20241001, 57.5, 38.0),
(10103, 20241001, 55.5, 37.0),
(10102, 20241001, 25.0, 18.5), #<-- fail D - 43.5

(10101, 20241002, 57.5, 38.5),
(20100, 20241002, 56.0, 38.0),
(10103, 20241002, 35.5, 31.0),

(20101, 20241003, 59.0, 30.5),
(10100, 20241003, 55.0, 37.0),
(10203, 20241003, 44.5, 30.0),
(10111, 20241003, 27.5, 19.0), #<-- fail D - 46.5

(20101, 20241004, 33.0, 36.5),
(10100, 20241004, 49.0, 31.5),
(10103, 20241004, 45.5, 33.0),
(10411, 20241004, 52.0, 32.5),

(10101, 20241005, 52.5, 37.0),
(20100, 20241005, 59.5, 38.5),
(10203, 20241005, 22.5, 17.0), #<-- fail F - 39.5
(10302, 20241005, 57.0, 38.5);
select * from Enrolment;

drop table if exists Registered_Students;
create table Registered_Students
(
	Registered_number int auto_increment,
    Registered_studentID int not null unique,
	primary key (Registered_number,Registered_studentID),
    foreign key (Registered_studentID) references Students (studentID)
) auto_increment = 1;

insert into Registered_Students (Registered_studentID) values
(20241000),
(20241001),
(20241002),
(20241003),
(20241004),
(20241005);
select * from Registered_Students;

drop table if exists Archived_Students;
create table Archived_Students
(
	Archived_number int auto_increment,
    Archived_studentID int not null unique,
	primary key (Archived_number,Archived_studentID),
    foreign key (Archived_studentID) references Students (studentID)
) auto_increment = 1;
select * from Archived_Students;

drop table if exists Active_Lecturers;
create table Active_Lecturers
(
	A_number int auto_increment,
    Active_LecturerID int not null unique,
	primary key (A_number,Active_LecturerID),
    foreign key (Active_LecturerID) references Lecturers(lecturerID)
) auto_increment = 1;

insert into Active_Lecturers (Active_LecturerID) values
(901001),
(901002),
(901003),
(901004),
(901005),
(901006),
(901007);
select * from Active_Lecturers;

drop table if exists Retired_Lecturers;
create table Retired_Lecturers
(
	R_number int auto_increment,
    Retired_LecturerID int not null unique,
	primary key (R_number,Retired_LecturerID),
    foreign key (Retired_LecturerID) references Lecturers(lecturerID)
) auto_increment = 1;
select * from Retired_Lecturers;

#----------------------------------------------------------------------------------------------------------------------------------
#calculate and set student final grades
#NB: this must be run for each individual student to properly populate data
#it is run automatically within the PHP files when a student's info is viewed
update Enrolment set enrolmentFinalGrade = (select sum(enrolmentCourseWorkGrade + enrolmentFinalExamORProjectGrade)) 
where enrolmentStudentID = 20241001 ; # <-- WORKS

#displays courses and grades for specific student
select coursecode as 'Course Code',coursetitle as 'Course',enrolmentCourseWorkGrade as 'Coursework', 
enrolmentFinalExamORProjectGrade as 'Exam Score',enrolmentFinalGrade as 'Total Score',
grade as 'Grade',award as 'Grade Award' from Students, Grades, Enrolment, Courses, Course_Schedule 
where gradeScaleHigh >= enrolmentFinalGrade 
and gradeScaleLow <= enrolmentFinalGrade 
and Course_Schedule.courseScheduleSection = Enrolment.enrolmentSectionCode
and	Course_Schedule.courseScheduleCode = Courses.coursecode
and Enrolment.enrolmentStudentID = Students.studentID
and enrolmentStudentID = 20241001; # <-- works 

#displays final grade for specific course
select enrolmentStudentID, sum(enrolmentCourseWorkGrade + enrolmentFinalExamORProjectGrade) as 'Final Grade' 
from Enrolment where enrolmentStudentID = 20241001 and enrolmentSectionCode = 10101;

#display student's final grade and quality point
select enrolmentStudentID,enrolmentSectionCode,enrolmentFinalGrade,qualityPoint from Grades, Enrolment 
where gradeScaleHigh >= enrolmentFinalGrade and gradeScaleLow <= enrolmentFinalGrade and enrolmentStudentID = 20241002; # <-- WORKS
select * from Students where studentID = 20241001;

#to calculate and display student grade point
select enrolmentStudentID,enrolmentSectionCode,coursecredits,enrolmentFinalGrade,qualityPoint,
round(qualityPoint * coursecredits,2) as 'grade point' 
from Grades, Enrolment, Course_Schedule, Courses
where gradeScaleHigh >= enrolmentFinalGrade 
and gradeScaleLow <= enrolmentFinalGrade 
and Courses.coursecode = Course_Schedule.courseScheduleCode
and Course_Schedule.courseScheduleSection = Enrolment.enrolmentSectionCode 
and enrolmentStudentID = 20241001; # <-- WORKS
select * from Students  where studentID = 20241001;

select * from Courses;
select * from Course_Schedule;

#to update student's GPA
update Students set GPA = (select round(sum(qualityPoint * coursecredits) / sum(coursecredits),2) 
from Grades, Enrolment, Course_Schedule, Courses where gradeScaleHigh >= enrolmentFinalGrade and gradeScaleLow <= enrolmentFinalGrade 
and Course_Schedule.courseScheduleSection = Enrolment.enrolmentSectionCode 
and Courses.coursecode = Course_Schedule.courseScheduleCode
and enrolmentStudentID = 20241001) where studentID = 20241001; # <-- WORKS
select * from Students;# where studentID = 20241006;

#to display students, final grade, and grade award
select enrolmentStudentID as 'Student ID',concat(fname," ",mname," ",lname) as 'Student',coursetitle as 'Course',enrolmentFinalGrade as 'Final Score',
grade as 'Grade',award as 'Grade Award' from Students, Grades, Enrolment, Courses, Course_Schedule 
where gradeScaleHigh >= enrolmentFinalGrade 
and gradeScaleLow <= enrolmentFinalGrade 
and Enrolment.enrolmentStudentID = Students.studentID
and Enrolment.enrolmentSectionCode = Course_Schedule.courseScheduleSection
and Courses.coursecode = Course_Schedule.courseScheduleCode
and enrolmentStudentID = 20241001; # <-- works (courseScheduleSection,courseScheduleCode   enrolmentSectionCode,

#displays courses and their prerequisites (if available)
select Courses.coursecode as 'Course Code', Courses.coursetitle as 'Course Title', Prerequisites.prerequisite as 'Prerequisite Code', 
(select Courses.coursetitle from Courses where Prerequisites.prerequisite = Courses.coursecode) as 'Prerequisite Title' 
from Courses, Prerequisites where Prerequisites.coursecode = Courses.coursecode and Prerequisites.coursecode = "MTH203";

select Prerequisite, (select Courses.coursetitle from Courses where Prerequisites.prerequisite = Courses.coursecode) as 'Title' 
from Courses, Prerequisites where Prerequisites.coursecode = Courses.coursecode and Prerequisites.coursecode = "MTH203";
