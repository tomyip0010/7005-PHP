DROP TABLE IF EXISTS Application;
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

/** Populate sample values **/
INSERT INTO Company (id, company_name, location) VALUES
(NULL, 'Test Company', 'Test Address');

INSERT INTO Student (id, first_name, last_name) VALUES
(NULL, 'TFirst', 'TLast');

INSERT INTO Project (id, company_id, title, related_major, description, available_slot) VALUES
(NULL, 1, 'Test Project', 'software development', 'This is a test description', 3);

INSERT INTO Application (id, project_id, student_id, justification, priority) VALUES
(NULL, 1, 1, 'This is a test justification', 1);

/* Sample query to test insertion worked. */
SELECT
P.id, P.title, C.company_name
FROM `Project` AS P, `Company` AS C
WHERE P.company_id = C.id;