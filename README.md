--------------------------------------------------------------------------------
Robot Test
--------------------------------------------------------------------------------

Environment Specifications: 
MAC OS X; Apache 2.2.22; PHP 5.3.15; MySQL 5.5.28;

Used Programs/Tools:
Command Line; Net Beans; Chrome;

Extra tools/frameworks:
Zend Framework 1.12; Doctrine 2.2.3;


Steps
- Setup a virtual host into the apache:
 
  <VirtualHost *:80>
        ServerName local.robot
        DocumentRoot "/var/www/robot/public"

        <Directory "/var/www/robot/public">
                SetEnv APPLICATION_ENV "development"
                Options Indexes MultiViews FollowSymLinks
                AllowOverride All
                Order allow,deny
                Allow from all
        </Directory>
  </VirtualHost>

- Add local.robot into /etc/hosts;

- Create database and table;
    Create schema test;
    Create table robot (
            id tinyint not null primary key auto_increment, 
            x tinyint(1) not null default 0, 
            y tinyint(1) not null, 
            face varchar(10) not null
    );
    insert into robot values (null, 1,3,'NORTH');

ps: It's been using the user foo and password 123 to access the database test, it can be changed at application/configs/application.ini line 113 and 114



--------------------------------------------------------------------------------

Start Time: 20h55 
End Time: 23:20
push: 12:00am


