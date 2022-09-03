DROP TABLE IF EXISTS Application;
DROP TABLE IF EXISTS Assignment;
DROP TABLE IF EXISTS Project;
DROP TABLE IF EXISTS Company;
DROP TABLE IF EXISTS Student;

/** Create tables **/
CREATE TABLE IF NOT EXISTS Company (
	id 					INTEGER PRIMARY KEY AUTOINCREMENT,
	company_name        VARCHAR(25) NOT NULL,
	location        	VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS Student (
	id 					INTEGER PRIMARY KEY AUTOINCREMENT,
	first_name      	VARCHAR(20) NOT NULL,
	last_name       	VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS Project (
	id       			INTEGER PRIMARY KEY AUTOINCREMENT,
	company_id     		INTEGER NOT NULL,
	title	 			VARCHAR(50) NOT NULL,
	related_major	 	VARCHAR(20) NOT NULL,
	description	 		TEXT NOT NULL,
	available_slot	 	INTEGER NOT NULL,
	FOREIGN KEY (company_id) REFERENCES Company(id)
);

CREATE TABLE IF NOT EXISTS Application (
	id	 				INTEGER PRIMARY KEY AUTOINCREMENT,
	project_id	 	 	INTEGER NOT NULL,
	student_id 			INTEGER NOT NULL,
	justification	 	TEXT NOT NULL,
	priority			  INTEGER NOT NULL,
	FOREIGN KEY (project_id) REFERENCES Project(id),
	FOREIGN KEY (student_id) REFERENCES Student(id)
);

CREATE TABLE IF NOT EXISTS Assignment (
	id	 				INTEGER PRIMARY KEY AUTOINCREMENT,
	project_id	 	 	INTEGER NOT NULL,
	student_id 			INTEGER NOT NULL,
	FOREIGN KEY (project_id) REFERENCES Project(id),
	FOREIGN KEY (student_id) REFERENCES Student(id)
);

/** Populate sample values **/
INSERT INTO Company (id, company_name, location) VALUES
(NULL, 'Company One', 'Address One'),
(NULL, 'Company Two', 'Address Two'),
(NULL, 'Company Three', 'Address Three'),
(NULL, 'Company Four', 'Address Four'),
(NULL, 'Company Five', 'Address Five');

INSERT INTO Student (id, first_name, last_name) VALUES
(NULL, 'Student', 'One'),
(NULL, 'Student', 'Two'),
(NULL, 'Student', 'Three'),
(NULL, 'Student', 'Four'),
(NULL, 'Student', 'Five'),
(NULL, 'Student', 'Six'),
(NULL, 'Student', 'Seven'),
(NULL, 'Student', 'Eight'),
(NULL, 'Student', 'Nine');

INSERT INTO Project (id, company_id, title, related_major, description, available_slot) VALUES
(NULL, 1, 'Project One', 'software development', 'This is a test description', 5),
(NULL, 1, 'Project Two', 'software development', 'This is a test description', 5),
(NULL, 1, 'Project Three', 'software development', 'This is a test description', 5),
(NULL, 1, 'Project Four', 'software development', 'This is a test description', 5),
(NULL, 2, 'Project Five', 'software development', 'This is a test description', 5),
(NULL, 2, 'Project Six', 'software development', 'This is a test description', 5),
(NULL, 3, 'Project Seven', 'software development', 'This is a test description', 5),
(NULL, 4, 'Project Eight', 'software development', 'This is a test description', 5);

INSERT INTO Application (id, project_id, student_id, justification, priority) VALUES
(NULL, 1, 1, 'This is a test justification', 1),
(NULL, 2, 1, 'This is a test justification', 2),
(NULL, 3, 1, 'This is a test justification', 3),
(NULL, 1, 2, 'This is a test justification', 1),
(NULL, 4, 2, 'This is a test justification', 2),
(NULL, 6, 2, 'This is a test justification', 3),
(NULL, 1, 3, 'This is a test justification', 2),
(NULL, 4, 3, 'This is a test justification', 1),
(NULL, 3, 3, 'This is a test justification', 3),
(NULL, 1, 4, 'This is a test justification', 1),
(NULL, 5, 4, 'This is a test justification', 2),
(NULL, 6, 4, 'This is a test justification', 3),
(NULL, 2, 5, 'This is a test justification', 1),
(NULL, 7, 5, 'This is a test justification', 2),
(NULL, 8, 5, 'This is a test justification', 3),
(NULL, 1, 6, 'This is a test justification', 1),
(NULL, 2, 6, 'This is a test justification', 2),
(NULL, 3, 6, 'This is a test justification', 3),
(NULL, 3, 7, 'This is a test justification', 1),
(NULL, 2, 7, 'This is a test justification', 2),
(NULL, 1, 7, 'This is a test justification', 3),
(NULL, 1, 8, 'This is a test justification', 1),
(NULL, 3, 8, 'This is a test justification', 2),
(NULL, 4, 8, 'This is a test justification', 3),
(NULL, 1, 9, 'This is a test justification', 1),
(NULL, 3, 9, 'This is a test justification', 2),
(NULL, 4, 9, 'This is a test justification', 3);

/* Sample query to test insertion worked. */
SELECT
P.id, P.title, C.company_name
FROM `Project` AS P, `Company` AS C
WHERE P.company_id = C.id;