#  DFlores-T-laravel
Test primera etapa proceso selección desarrollador junior resuelto con pLaaravel 5.5.20
Los archivos del proyecto corresponden a los archivos de desarrollo de la prueba.
Al ejecutar en un browser la carpeta public/ ejecuta el controlador FormularioController.
Dentro tiene 3 funciones que son:
-	Index: muestra el formulario.
-	Procesar: genera la respuesta luego de recibir el formulario.
-	isHabil: retorna true si la fecha entregada como parámetro corresponde a un día hábil.

Para los feriados se considera las fechas que fueron dictadas como feriados legales entre los años 2011 y 2020 para toda la región Metropolitana.
Para los años  2018, 2019 y 2019 van a ser feriados los días de posibles elecciones y plebiscitos, pero no se consideran.
El 17 de diciembre de 2017 va a ser feriado solamente si hay segunda vuelta en las elecciones presidenciales, pero es domingo así que no se considera día hábil.
Hay días, los 31de diciembre de cada año en que no sea domingo, que se considera feriado bancario. Sin embargo el resto del comercio sigue funcionando. Para esta prueba no fueron considerados días hábiles.
Para obtener un listado de los días feriados, ingresé a la url http://www.feriadoschilenos.cl/2011-2020.html, luego copié el código fuente de la página que correspondía a los feriados entre los años 2011 y 2020.
Luego hice un script en PHP al que le pasé ese código fuente como una cadena de datos.
Para finalmente iterar en ella y sacar todas las fechas.
Luego a ese listado de fechas le di el formato necesario para que un array llamado feriados en la posición de esa fecha sea true. Entonces cada vez que se le consulta por si una fecha es día hábil, primero ve que si es sábado o domingo y luego si ha sido seteada la posición del arrgeglo feriados.
Una vez que tuve el arreglo lista, eliminé a mano las fechas que son feriados en otras regiones que no sean la Metropolitana. Pero eran solamente 31, así que decidí no gastar tiempo en hacer un script.

Si se ingresa una fecha que no pertenezca al rango de los años 2011 y 2020 los días hábiles van a ser todos menos los sábados y domingos.
