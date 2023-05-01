# Explicación de la prueba #

He utilizado una infraestructura simple con una base de datos dockerizada, como servidor el propio de symfony y con la instalación de php 8.1 en local.
Tanto el servidor como el php se podrían dockerizar pero esta es la forma en la que estoy trabajando a día de hoy y me resulta cómoda.

Para levantar el proyecto.

    docker-compose up -d 
    Composer install
    symfony server:start -d

Para alimentar de inicio la base de datos he creado un pequeño comando que añade algunos datos de prueba

    bin/console app:load-data

Con esto tendremos ya unos datos de prueba y podremos navegar entrar en la url que nos proporciona el servidor de symfony para ver algún dato.

    https://127.0.0.1:8000/


## API ##
Para la API: (la IP y puerto son los que me proporciona el server de symfony)

No he preparado el swagger, no tengo experiencia con ello y aunque he estado revisando como documentación de cómo integrarlo
he tenido que priorizar los tiempos.

Dejo por aquí las peticione curl para probar la API:

Petición para listar los post:

    curl --location 'http://127.0.0.1:8000/api/posts'


Petición para dar de alta un post:

    curl --location 'http://127.0.0.1:38197/api/post/add' \
    --header 'Content-Type: application/json' \
    --data '{
    "userId": 11,
    "id": 1,
    "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
    "body": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
    }'

Petición para dar de alta un usuario / author

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


### Psalm, php-cs-fixed, test ###

Se ha integrado psalm y php-cs-fixer en el código así como un php-unit integrado en el.

Para ejecutarlos se han creado comandos de composer para tal fin.

    composer pslam
    composer fix-cs . -> el punto es para que revise todo el proyecto
    composer test -> ejecuta los test
    composer coverage -> para generar el coverage del proyecto en formato html.

### Comentarios respecto a la prueba ###

Como ya comenté me falta el Swagger y  también me falta la parte de SCSS y Webpack.
Estoy 100% centrado en la parte de back-end y aunque en su día fui full-stack ahora lo tengo muy abandonado.
Conozco la integración de webpack en symfony y he trabajado con ella pero es de esas cosas que haces una vez por proyecto
y llevo 3 años enfocado en el mismo proyecto, por lo que tendría que refrescar sobre todo la parte de configuración inicial.


### Mejoras ###
Al final esto no deja de ser una prueba y por cuestiones personales me he visto limitado en el tiempo por lo que he tenido
que priorizar. Aquí dejo alguna cosa que me deje por el camino.

    Mejorar los test: He dejado los test cubriendo lo que considero que es lo mínimo, Commmands y Querys. Habría que mejorar
    los test para incluir bien el 100% de las entidades y DTOs.

    Implementar UUID: He tirado de autoincrementales de DB para los los índices, pero la idea es pasarlos a UUID para no estar
    dependiendo de la DB para ello. Cuando los empecé a implementar me dio un fallo y me pedía una librería un tanto extraña
    para el mapeo de los UUID en la DB. Como digo no he ido muy sobrado de tiempo y eso me hizo tener que prescindir de ellos.

    Añadir lefthook: es interesante tener un lefthook que ejecute psalm, php-cs-fixer y los test antes de hacer cualquier commit.
    de esta manera evitamos commitear código sin formatear, con errores o que hagan que fallen los test.

    Bootsrap: Meter bootstrap para dar un poco más de forma al proyecto.
