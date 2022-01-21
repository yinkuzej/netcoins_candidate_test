NetCoins Test

Introduction

This API does the following

Retrieve the list of all employees

Create an employee

Retrieve a particular employee

Update the information of a particular employee

Delete an employee

Error Codes

What errors and status codes can a user expect?

404 => Employee not found.

201 => Employee Created

200 => Employee record retrieved

202 => Employee record deleted

GET
http://127.0.0.1:8000/api/employees
Retrieve All Employees

GET
http://127.0.0.1:8000/api/employee/3
Retrieve employee where 3 is the id of the employee

PUT
http://127.0.0.1:8000/api/employee/3
Update the details of an employee with id 3

DEL
http://127.0.0.1:8000/api/employee/3
Delete an employee with id of 3

