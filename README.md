# php_withFiles_socialMedia

PHP Application with Dynamic Content, Security Features, and Admin Panel

This project, undertaken during the second year of study, involves the development of a PHP-based web application with an organized structure and comprehensive functionalities. The aim is to create a dynamic platform that incorporates various features and adheres to established coding practices taught during lectures and exercises.

Database Design:
The project necessitates the design of a sufficiently complex database that includes at least two instances of 1:n relationships and one m:n relationship. This database design ensures the project's adherence to fundamental relational database principles.

Design and Functionality in Accordance with the Theme:
The project encompasses the creation of a robust design and functional framework aligned with the selected theme. The application's design should support dynamic content generation, drawing data either from the database or configuration files on the backend.

Key Functionalities:
The chosen application theme dictates the core functionalities. For instance, if the application simulates an online store, features should enable product addition to the cart and the completion of purchases. If the theme resembles a blog platform, functionalities should encompass blog post creation, user comments, and likes. It is essential to implement these functionalities with a high level of interactivity.

User Authentication and Protection:
The project requires the implementation of user authentication functionalities, including user registration, login, and safeguarding pages from unauthorized access. Additionally, account locking should be implemented, wherein after three unsuccessful login attempts within five minutes, the account is locked, and an email notification is sent to the user.

Access Logging:
To track access to pages, the application should record access information in a text file. This log serves to identify which pages were visited. The recorded data should also be displayed on the admin panel.

AJAX Integration:
The project emphasizes server-side implementation of AJAX functionalities for filtering, sorting, and pagination. These features must operate seamlessly without relying on JavaScript or libraries on the client side. The PHP backend should return data in JSON format, accompanied by appropriate HTTP status codes.

Image Handling:
The application should handle image uploads effectively by creating both thumbnail and original versions. Thumbnails are displayed in scenarios where image resolution does not significantly impact user experience. For instance, in a product catalog, thumbnail images suffice for multiple product previews. However, when users navigate to a product's dedicated page, high-resolution images should be displayed.

Admin Panel:
The admin panel offers insights into website statistics and content management. It provides a percentage-based overview of page access, displaying recent access rates to each page within the last 24 hours (data sourced from the log file). Furthermore, the admin panel showcases the number of users who logged in on the current day and facilitates the management of the entire site's content.


