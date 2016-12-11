## PMU ##

### Prerequisites ###

*  Need to install webserver(apache/nginx), PHP 7, Mysql(5.7)/Maria(10.x) DB, and composer
*  Optional - Redis

### Installation ###

* type `git clone https://github.com/pmuniversity/pmu.git projectname` to clone the repository
* type `cd projectname`
* type `composer install`
* type `composer update`
* copy .env.example to .env
* `Give permissions to storage/ and bootstrap/cache folders`
* type `php artisan key:generate`to regenerate secure key
* Create a database
* if you use MySQL in *.env* file :
   * set DB_CONNECTION
   * set DB_DATABASE
   * set DB_USERNAME
   * set DB_PASSWORD
* type `php artisan migrate --seed` to create and populate tables
* edit *.env* for emails, SMS, push notification and redis configuration
* Create virtual host for the project something like http://pmu.dev/ (optional)
* You can access the browser by typing the virtual host OR type the project path in browser something like ‘http://localhost/projectname/public/’
* Create folder in public/uploads and should give write permissions