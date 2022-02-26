## Table of Contents

- [Installation](#installation)
- [Setting Up](#setting-up)

### Installation

Minimum Requirement

- "php": "^7.3|^8.0"


Git clone the repo

```sh
git clone https://github.com/ibrahimozden/smsProject.git
```
Then cd into the folder with this command-

```sh
cd Sms
```
Install Project dependencies

```sh
composer install
```

### Setting up

Set up .env file

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YOUR_DATABASE_NAME
DB_USERNAME=YOUR_DATABASE_USERNAME
DB_PASSWORD=YOUR_DATABASE_PASSWORD
```

**Note!**: Please make sure you have create a database before running migration.

Run migration

```sh
php artisan migrate
```

Serve your project using artisan command

```sh
php artisan serve
```

# Laravel Sms Delivery Service
Usernames of these customers and
They have passwords. Sending sms to customers using restful api
can, can see sms reports (records), sms report
You can see the details and get these reports according to the date filter.


# Swagger UI setup and annotation definitions were made.

# User Register
![register](https://user-images.githubusercontent.com/43759769/155842421-77f359c4-4664-4197-b71a-a3485e022653.png)
![register json](https://user-images.githubusercontent.com/43759769/155842422-946db949-5a41-4d4c-a71c-3cacebcd379f.png)

# User Login
Enter your e-mail and password that you used when registering.
![login](https://user-images.githubusercontent.com/43759769/155842512-310a8708-d96c-42e7-9ad3-9bd57e707a7e.png)
![login json](https://user-images.githubusercontent.com/43759769/155842515-9f5d197e-703f-4989-8fae-4e58de0e77e2.png)

# Authorization
User details, sending sms, seeing sms reports etc. For transactions, you must obtain authorization with tokens.
![login token](https://user-images.githubusercontent.com/43759769/155842680-0d0a662d-db8d-4190-9a60-cb2d2ca477dc.png)
![authorizate](https://user-images.githubusercontent.com/43759769/155842685-5a3aab58-4701-44ab-b58c-db80e89df406.png)

# User Detail
You can reach the user details.
![user detail](https://user-images.githubusercontent.com/43759769/155842780-50b72202-611f-4afb-8bb7-1149c8dca89f.png)

# Sms Post
You can send the sms by entering the number and message you want to send a message to.
![smss post](https://user-images.githubusercontent.com/43759769/155843006-ac63d045-a610-4b39-83bd-0e88fff16a41.png)
![sms sent json](https://user-images.githubusercontent.com/43759769/155843008-2260bd48-cab7-4bb1-ae0d-a2e2c1b9c549.png)

# Reports
You can list all sms sent by the logged in user.
![report gey](https://user-images.githubusercontent.com/43759769/155843101-1698c1c2-be02-41c7-aff9-6f8d49861d40.png)
![sms report user](https://user-images.githubusercontent.com/43759769/155843103-0e30ec1f-3e6c-46bb-a2dd-e63b6c704303.png)

# Date Filter Reports
You can list the sms between two dates from the sms sent by the logged in user.
![date report](https://user-images.githubusercontent.com/43759769/155843329-1de7f2b8-317f-4e34-9180-e5b164efc059.png)
![date filter 1](https://user-images.githubusercontent.com/43759769/155843230-117284d8-5462-4907-ab00-7e35a52bdbd4.png)

# Report Detail with {id}
You can see the detail of a report you want.
![report id](https://user-images.githubusercontent.com/43759769/155843278-d4a61358-4761-4e48-8243-e85f30caa6b4.png)
![id detail](https://user-images.githubusercontent.com/43759769/155843280-dc451ff7-e755-431c-bd6f-b6652a24fc3e.png)

# Unit Test

