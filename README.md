# Laravel Bookstore API

This is a test project to create REST API with Laravel Passport.

**Note:** I use Laravel Passport, because I have some issues with [JWT](https://github.com/tymondesigns/jwt-auth) during the installation on Laravel 8.75 and PHP 8.0. I have not given up and I will try to drive it again :)

## About the Project

**Note:** Added an relationship between `Users` and `Books`. So, each user adds books, and in the listing for the users a list of all books added by the respective user is displayed. There is a new *added_by* attribute in the books listing, which shows which user the book was added by. Also, еvery user can only delete the books he has added.

For the books and authors listings we will show only 5 results per page, so we have a pagination. To view a second page of the listings above, we'll use `{{base_url}}/api/v1/books?page=2`. 

Also, on the listings for the books, the *description* is not visible. The *description* of the books we'll show only on the single listing. And for the last, every book can have more than one author, so the authors of the book we'll be shown comma separated, one after another.

**Important:** After setup the project on your local environment, use the database seeder to create the first user. After that you can use the generated token for authorization.

For more info about how to test the API, after setup the project, please check the documentation at: 
- `{{base_url}}/docs/#authenticating-requests`

## Used Packages

- [laravel/passport](https://laravel.com/docs/8.x/passport) - A full OAuth2 server implementation
- [knuckleswtf/scribe](https://github.com/knuckleswtf/scribe) - Scribe helps you generate API documentation

## API Endpoints

### **Auth**

#### *Register*

URL Parameters:

- `name` - string / *must not be greater than 255 characters*
- `email` - string / *must not be greater than 255 characters and must be a valid email address.*
- `password` - string  

Endpoints:

- `POST api/auth/register`

#### *Login*

URL Parameters:

- `email` - string / *must be a valid email address.*
- `password` - string  

Endpoints:

- `POST api/auth/login`

---

### **Users**

Note: All endpoints requires authentication.

#### *Display a listing of the resource*

Endpoints:

- `GET api/v1/users`

#### *Display the specified resource*

URL Parameters:

- `id` - integer 

Endpoints:

- `GET api/v1/users/{id}`

---

### **Authors**

Note: All endpoints requires authentication.

#### *Display a listing of the resource*

Endpoints:

- `GET api/v1/authors`

#### *Store a newly created resource in storage*

Endpoints:

- `POST api/v1/authors`

#### *Display the specified resource*

URL Parameters:

- `id` - integer 

Endpoints:

- `GET api/v1/authors/{id}`

#### *Update the specified resource in storage*

Note: Note: If we using `Faker`, then we use `Illuminate\Http\Request`

URL Parameters:

- `id` - integer  

Endpoints:

- `PUT api/v1/authors/{id}`
- `PATCH api/v1/authors/{id}`

#### *Remove the specified resource from storage*

URL Parameters:

- `id` - integer 

Endpoints:

- `DELETE api/v1/authors/{id}`

---

### **Books**

Note: All endpoints requires authentication.

#### *Display a listing of the resource*

Endpoints:

- `GET api/v1/books`

#### *Store a newly created resource in storage*

Endpoints:

- `POST api/v1/books`

#### *Display the specified resource*

URL Parameters:

- `id` - integer 

Endpoints:

- `GET api/v1/books/{id}`

#### *Update the specified resource in storage*

Note: If we using `Faker`, then we use `Illuminate\Http\Request`

URL Parameters:

- `id` - integer  

Endpoints:

- `PUT api/v1/books/{id}`
- `PATCH api/v1/books/{id}`

#### *Remove the specified resource from storage*

URL Parameters:

- `id` - integer 

Endpoints:

- `DELETE api/v1/books/{id}`

<br>
<br>

# MartinNestorov

## Laravel Project

1. Users are connected to an account (account has multiple users)
2. Login page, application can be accessed only by logged users
3. A page with a form to add a book (title, author, release date), the insert must be unique by author and title. Inserted book belongs to user account.
4. A page where user can list (only) books added by his account in a table. In table must be a column with “Delete” button, to delete a book - delete action is accessible only first 2 days after book was inserted. 
5. API endpoint used by an account to fetch his books. (/api/books)
6. API endpoint to get information of a specific book by id (/api/books/1)
7. API endpoints must be secured by JWT token, every account has a secret key for API
8. Seeder to create demo accounts, users, books

**Requirements:** Laravel Policies, Middlewares, Input Validations, Code Style PSR-5
