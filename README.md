# INFO834 – TP1 – Un cache Redis pour EtuServices
## Github link:
https://github.com/SytHamMer/INFO834-Cache-Redis



## How to run it:
run a redis server at port 6379

Run an Apache server and MySql server with XAMPP:

Put the TP1 folder in :  C:\xampp\htdocs

Create a database name info834 in your phpmyadmin:



```bash
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    nb_connection INT DEFAULT 1,
    last_connection TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

```
If you want to create a user:
go to

~/TP1/web/register.php

If you want to login:

~/TP1/web/login.php

## Technologies:
- Redis
- Python
- html
- php
