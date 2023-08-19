App Name: GoShopNow

Description:
"GoShopNow" is an innovative clothing e-commerce platform designed with the Laravel backend framework and a dynamic frontend built using HTML, CSS, Bootstrap, and JavaScript. The platform is tailor-made for users seeking a seamless shopping experience for a wide array of clothing products.

Developer Skill: Advance Beginner 

Backend Framework: Laravel 10

Frontend: HTML, CSS, Bootstrap, Blade ,JavaScript

User Types:

1.User(Customer)

2.Admin

Functions(User):
1. Login and Register
2. Browse Products
3. Filter Products by Categories
4. Filter Products by Brands
6. Filter by Price Range (Min and Max)
7. Search Products
8. View Product
9. Add to Cart
10. View Cart Items
11. Remove Cart Items
12. Calculate Total Items in Cart (Total + Shipping Fee)
13. Checkout Order
14. Payment Order
15. Update Account Details
16. Change Account Password
17. Logout


Functions(Admin)
1. Login
2. Dashboard 
3. Manage Product Category
4. Manage Brand
5. Manage Product
6. Manage Order and Payment
7. Manage User
8. Archive
9. Update Account Details
10. Change Account Password
11. Logout


Database Schema:

users table:

id (Primary key, auto-incrementing integer),
name (String),
email (String),
password (String),
remember_token (String, nullable),
is_admin (tinyint),
is_active (tinyint),
created_at (Timestamp),
updated_at (Timestamp)

addresses table:

id (Primary key, auto-incrementing integer),
user_id (Foreign key referencing users.id),
address_line_1 (String),
address_line_2 (String, nullable),
city (String),
state (String),
postal_code (String),
created_at (Timestamp),
updated_at (Timestamp)

mobile_numbers table:

id (Primary key, auto-incrementing integer)
user_id (Foreign key referencing users.id)
mobile_number (String)
created_at (Timestamp)
updated_at (Timestamp)

categories table:

id (Primary key, auto-incrementing integer),
name (String),
created_at (Timestamp),
updated_at (Timestamp)

brands table:

id (Primary key, auto-incrementing integer),
name (String),
created_at (Timestamp),
updated_at (Timestamp)

products table:

id (Primary key, auto-incrementing integer),
name (String),
description (Text),
price (Decimal),
brand_id (Foreign key referencing brands.id),
category_id (Foreign key referencing categories.id),
created_at (Timestamp),
updated_at (Timestamp)

stocks table:

id (Primary key, auto-incrementing integer),
product_id (Foreign key referencing products.id),
size_id (Foreign key referencing sizes.id),
quantity (Integer),
created_at (Timestamp),
updated_at (Timestamp)

carts table:

id (Primary key, auto-incrementing integer),
user_id (Foreign key referencing users.id),
created_at (Timestamp),
updated_at (Timestamp)

cart_items table:

id (Primary key, auto-incrementing integer),
cart_id (Foreign key referencing carts.id),
product_id (Foreign key referencing products.id),
size (String),
quantity (Integer),
created_at (Timestamp),
updated_at (Timestamp)

orders:
id (Primary key, auto-incrementing integer),
user_id (Foreign key),
product_id (Foreign key),
order_status (String),
product_size (String),
quantity (Integer),
amount (Decimal),

payments:
id (Primary key, auto-incrementing integer),
order_id (Foreign key),
checkout_link(String),
external_id (String),
status (String),

Models and Relationships

User Model (User.php):

hasOne(Address::class)

hasOne(MobileNumber::class)

hasMany(Cart::class)

Address Model (Address.php):

belongsTo(User::class)


MobileNumber Model (MobileNumber.php):

belongsTo(User::class)


Cart Model (Cart.php):

belongsTo(User::class)

hasMany(CartItem::class)

CartItem Model (CartItem.php):

belongsTo(Cart::class)

belongsTo(Product::class)


Product Model (Product.php):
belongsTo(Brand::class)

belongsTo(Category::class)

hasMany(Stock::class)

hasMany(CartItem::class)

Brand Model (Brand.php):


hasMany(Product::class)

Category Model (Category.php):

belongsToMany(Product::class, 'product_category')

Stock Model (Stock.php):

belongsTo(Product::class)

Order Model (Order.php):

belongsTo(User::class)

hasMany(OrderItem::class)

hasOne(Payment::class)

Payment Model (Payment.php):

belongsTo(Order::class)



