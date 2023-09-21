# APIWebShop
Its a practical test given by loop new media.Laravel 10 application for order APIs

#Import Masterdata
Please run migration command to create product customer and order tables into database.
  php artisan migrate
seederclass CustomerSeeder.php and ProductSeeder.php has the logic to import the customer and product csv into database.commands to import it into tables are
  php artisan db:seed --class=CustomerSeeder
  php artisan db:seed --class=ProductSeeder

#Expose Order Data as REST Service
  api.php has all the route for CRUD operation on orders table.i will share the postman collection as well to test it.
  1. GET REQUEST TO FETCH THE ORDERS: http://127.0.0.1:8000/api/orders
  2. POST REQUEST TO STORE THE NEW ORDERS : http://127.0.0.1:8000/api/orders
  3. POST REQUEST TO EDIT THE ORDERS : http://127.0.0.1:8000/api/orders/1/edit
  4. PUT REQUEST TO UPDATE THE ORDERS : http://127.0.0.1:8000/api/orders/1/edit
  5. DELETE REQUEST TO DELETE THE ORDERS : http://127.0.0.1:8000/api/orders/2/delete
  
#Create Add-Product-to-Order Endpoint
  POST REQUEST TO ATTACH PRODUCT TO ORDERS : http://127.0.0.1:8000/api/orders/1/add 

 #Create Pay-Order Endpoint
   POST REQUEST FOR PAYMENT : http://127.0.0.1:8000/api/orders/1/pay

#Estimated time vs
  this is 3 days work for me.
   


  

