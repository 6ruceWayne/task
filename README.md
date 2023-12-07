<h1 align="center">Hi there, here is your documentation 
<img src="https://github.com/blackcater/blackcater/raw/main/images/Hi.gif" height="32"/></h1>
<h5>Before the installation you MUST have docker preinstalled!</h5> 
<br>
<ui>
To set up the project you need to:
<li>
Clone git repository
</li>
<li>
Run 'composer install' command
</li>
<li>
Run 'npm install' command
</li>
<li>
Run 'npm run build' command
</li>
<li>
Rename '.env.example' to '.env'
</li>
<li>
Run 'php artisan l5-swagger:generate' command
</li>
<li>
Run 'php artisan sail:install' command, choose '0' as mysql
</li>
<li>
Change the next params in '.env' file:
</li>
<li>
APP_PORT (standard 8080 but make sure you do not use it already!)
</li>
<li>
DB_CONNECTION=mysql
</li>
<li>
DB_HOST=mysql
</li>
<li>
Run './vendor/bin/sail up' command
</li>
<li>
Exit from previous command
</li>
<li>
Enter in shell by running command './vendor/bin/sail shell'
</li>
<li>
Run under shell 'php artisan migrate' command
</li>
<li>
Run under shell 'php artisan db:seed' command
</li>
</ui>

Link to the project:
'http://localhost:8080/' <br>
Login to test user. Email: 'test@test.com', password: 123456789.<br>
On the main page you will have 30 paginated tasks. Click on them will uncover sub tasks

Link to Swagger doc will be there:<br>
http://localhost:8080/api/documentation#/default

If you're gonna check API end points with Postman or anything else don't forget to get Bearer Token for auth!<br>
Enjoy!

