# Dairy-farm-management-system
This is a website for a dairy farmer to keep his/her records online. Due to challenges the dairy farmers face in keeping farm records on paper and risk involved with paper work like data manipulation or theft and other incidences. I saw it good to develop a system that the farmers can store and keep thier records digitally.
This website has three user levels: level 0, level 1, level 2 and level 3. When a user level 0 logs in, he/she can only see the members page and not the private pages. User level 2 is the veterinary's page to login and register vaccination and insemination so that the farm owner who is miles away from home can see how many cows were vaccinated or inseminated in a day. User level 2 is the farm admin/ owner. He can register new members, register also vaccination, insemination and keep personal notes. And store daily milk production. Delete and editing members can only be done be the admin.
This website was written in PHP for backend, MYSQL for database, Html, css, bootstrap, and Jquery.
This website does not allow users to register/signup in the login page because it is private site. It is only admin/farm owner who can add new members and assign roles by editing user_levels. Like registering a member and assigning user_level to 1 makes that user a veterinary when he/she logs in can only access vet's page and register vaccination/insemination.
Each web page has a session set to prevent unauthorized access to private pages by users with user level o.

