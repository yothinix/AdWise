AdWise
======
At the present, the talented workers in many companies are decreasing because many students do not get a proper academic as they have the skill, when they decide to entrance into the university. Therefore, they did not do a job that relates to the academic as they graduated. Perhaps, they do not like a job that they work. To solve these problems, we create AdWise for providing guidance to students. It can collect many personality test forms in the online platform to show a career recommendation to whom taking it. Moreover, the system can help students to find their proper career by 
using Apriori algorithm to merge the result from many personality tests to get more accurate results than usual. 


Installation
------------

- Clone this [project][1] into your web root directory, e.g., `/var/www/`
- Download AdWise [database schema][2]
- Import DB schema to your RDBMS by login to your MySQL console and using:
    `mysql> use DATABASE_NAME;`
    `mysql> source path/to/AdWise-database-Example.sql;`
- Configuration your baseURL on [config_main][3] e.g., `http://localhost/AdWise/`
- Edit database configuration on [database.php][4]:
    
    `http://localhost/AdWise/`
    

or run following command from your webroot directory:

    git clone https://github.com/yothinix/AdWise.git

Dependencies
------------

- Apache2
- PHP5
- MySQL or MariaDB
- git

Setup required packages (debian, ubuntu)
########################################

    sudo apt-get install git lamp-server^

Usage
-----
Call `http://localhost/AdWise` on your browser. This prototype will ship with 2 Assessment available on the system including MBTI and KTS and 1 Administrator account `tester1` and User account `tester2` access using password `123456`.


[1]: https://github.com/yothinix/AdWise
[2]: https://github.com/yothinix/AdWise/blob/master/AdWise-database-Example.sql
[3]: https://github.com/yothinix/AdWise/blob/master/application/config/config.php
[4]: https://github.com/yothinix/AdWise/blob/master/application/config/database.php
