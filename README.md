# Explicacion de la prueba #

He utilizado una infrastructura simple con una base de datos dockerizada, como servidor el propio de symfony y con la instalación de php 8.1 en local.
Tanto el servidor como el php se podrian dockerizar pero esta es la forma en la que estoy trabajando a dia y me resulta comoda.

Para levantar el projectos.

    docker-compose up -d 
    Composer install
    symfony server:start -d

Para alimentar de inicio la base de datos he creado un pequeño comando que añade alguinos datos de prueba

    bin/console app:load-data

Con esto tendriamos ya unos datos de prueba y podriamos navegar entrar en la url que nos proporciona el servidor de symfony para ver algun dato.

    https://127.0.0.1:8000/


##API##
Para la API: (la IP y puerto son los que me proporciona el server de symfony)

No he preparado el swagger, no tengo experiencia con ello y aunque he estado revisando como documentación de como integrarlo
he teniado que priorizar tiempos.

Dejo por aqui las peticione curl para probar la API:

Peticion para listar los post:

    curl --location 'http://127.0.0.1:8000/api/posts'


Peticion para dar de alta un post:

    curl --location 'http://127.0.0.1:38197/api/post/add' \
    --header 'Content-Type: application/json' \
    --data '{
    "userId": 11,
    "id": 1,
    "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
    "body": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
    }'

Peticion para dar de alta un usuario / author

    curl --location 'http://127.0.0.1:8000/api/author/add' \
    --header 'Content-Type: application/json' \
    --data-raw ' {
    "id": 1,
    "name": "Leanne Graham",
    "username": "Bret",
    "email": "Sincere@april.biz",
    "address": {
    "street": "Kulas Light",
    "suite": "Apt. 556",
    "city": "Gwenborough",
    "zipcode": "92998-3874",
    "geo": {
    "lat": "-37.3159",
    "lng": "81.1496"
    }
    },
    "phone": "1-770-736-8031 x56442",
    "website": "hildegard.org",
    "company": {
    "name": "Romaguera-Crona",
    "catchPhrase": "Multi-layered client-server neural-net",
    "bs": "harness real-time e-markets"
    }
    }'


### Comentarios respecto a la prueba ###

Como ya comenté me falta el Swagger y  tambien me falta la parta de SCSS y Webpack. 
Estoy 100% centrado en la parte de back-end y aunque en en su dia fui full-stack ahora lo tengo muy abandonado.
Conozco la integracion de webpack en symfony y he trabajado con ella pero es de esas cosas que haces una vez por proyecto
y llevo 3 años enfocado en el mismo proyecto, por lo que tendria que refrescar sobre todo la parte de configuración inicial.


### Mejoras ###
Al final esto no deja de ser una prueba y por cuestiones personales me he visto limitado en el tiempo por lo que he tenido 
que priorizar. Aqui dejo alguna cosa que me deje por el camino.

    Mejorar los test: He dejo los test cubriendo lo que considero que es lo minimo, Commmands y Querys. Habria que mejorar
    los test para incluir bien el 100% de las entidades y DTOs.

    Implemenar UUID: He tirado de autoincrementales de DB para los los indices, pero la idea es pasarlos a UUID para no estar
    dependiendo de la DB para ello. Cuando los empece a implementar me dio un fallo y me pedia una libreria un tanto extraña
    para el mapeo de los UUID en la DB. Como digo no he ido muy sobrado de tiempo y eso me hizo tener que prescindir de ellos.

    Bootsrap: Meter bootstrap para dar un poco mas de forma al proyecto.












