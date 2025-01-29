<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>




## API For Student

#### Get all students

```http
  GET api/students
```

#### Get student by sutdent id

```http
  GET /api/students/2
```



#### Add a Student
```http
  POST /api/students
```
##### Body Eg.
```
{
    "first_name": "absc",
    "last_name": "sisfkdj",
    "enrollment_number": "1",
    "department": "Computer Science",
    "year": 4
}
```


#### Update a Student by its id
```http
  PUT /api/students/2
```
##### Body Eg.
```
{
    "first_name": "Nikhl",
    "enrollment_number": "21116040",
    "department": "ECE",
    "year": 4
}
```

#### Delete a Student by its id
```http
  DELETE /api/students/1
```


## API For Courses
#### Get all courses
```http
  GET /api/courses/
```

#### Get course by id
```http
  GET /api/courses/
```

#### Add Course
```http
  POST /api/courses/
```
##### Body Eg.
```
{
    "course_name": "Computer Networks",
    "course_code": "12"
}
```


#### Delete Course
```http
  DELETE /api/courses/10
```

## API For Attendance

#### Get attendances of student_id , course_id
```http
  GET /api/attendances/3/6
```

#### Take attendances for perticular Date and Courses
```http
  POST /api/attendances/create
```
##### Body Eg.
```
{
    "course_code": "CS108",
    "attendance_date": "2025-02-10",
    "present_enrollment_number":[1,2,3,4], //array of present sutdent 
    "absent_enrollment_number": [5,6,7] //array of absent sutdent 
}
```


#### Mark attnedance for perticular Course, Date, Student
```http
  POST /api/attendances
```
##### Body Eg.
```
{
    "student_id": 1,
    "course_id": 2,
    "attendance_date": "2025-01-29",
    "status": "Present"
}
```













