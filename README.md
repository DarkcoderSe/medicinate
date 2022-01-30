## What is Medicinate
Make an impact. Lend a helping hand to those in need by donating unused medication or funds to support our work. Your donations stop waste and save lives.

##### <a href="">Project Demo</a>

### Project Description
Medicinate is an open source project for those who want to help others to grow the medicine donation system. So we can save others life who are in need.


#### How to run this Project
- Download composer, php7.4, mysql and apache2 OR you can download xampp/wampp
- Clone this repo in your public doucment. (htdocs, www/html etc)
- Run ```` composer install ```` 
- Copy the .env.example file into .env
- Setup .env according to your need. DB/Mail config etc 
- Run ```` php artisan key:generate ````



##### Steps to migrate Database
Run these commands in same directory where project installed.
- ```` php artisan migrate ```` for migration.
- ```` php artisan db:seed ```` for seeding



##### Admin Credentials
Login URL: ` 127.0.0.1:8000/admin/login `
Email: ` administrator@app.com `
Password: ` password `

