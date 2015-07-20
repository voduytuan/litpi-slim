# Litpi Slim (Litpi Framework with Slim) #
Microservice PHP Framework based on Slim Framework 2.0.

## Introduction ##
This framework is used for microservice structure. You can use this framework to provide web services (Restful) to consumer. Base on Slim framework (2.0), to full support for HTTP Restful service.

Place as MC (in MVC structure), this framework do not provide View template. It's just Model and Controller.

## Get started ##
This framework support multiple version base on group of controllers. You can bring all controllers to v1 group and access by url /v1/controllername. 

The Controller class name must be CamelCase (E.g: User, Product, Order...) and you need to add one mapping to classmap array (includes/classmap.php) for autoloading controller when in runtime.

Put your models in Model and in namescape \Model for autoloading model class.

## Bootstrap process ##
All bootstrap process coded in /index.php includes:
- Setup Database (using PDO MySQL, config in /includes/conf.php)
- Setup $app object (instance of \Slim\Slim class)
- Parsing route from .htaccess and get controller class to start.

------
Contact me at: tuanmaster2012 [at] gmail.com
