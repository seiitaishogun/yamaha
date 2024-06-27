# Yamaha Revzone Project



## Docker Installation Document

- First download and install Docker from [https://www.docker.com/get-started] ignor this step if you had already installed docker desktop

- Add this line to host file: `127.0.0.1 demo`

- Edit wp-config file with the following value

/********************************

    define( 'DB_NAME', 'omn_yamaha' );

    define( 'DB_USER', 'ymh_usr' );

    define( 'DB_PASSWORD', 'tmt123456' );

    define( 'DB_HOST', 'mysql' );

********************************/

- To run the project. Run command `docker-compose up` 

- run website with URL: http://demo/

- Login admin with URL: http://demo/wp-admin

- Login info: admin / Password:  4WX3oiT*8)fe6KomV9

- Connecting to phpmyadmin: http://localhost:8080/

- phpmyadmin user: root / secret