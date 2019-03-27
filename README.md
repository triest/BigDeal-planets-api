## BigDeal-planets-api

Файл класса для работы с API: PlanetsApi.

Использование: в директории с файлом скрипта и классом PlanetsApi должен быть файл настроек соединения с базой данных <b>connect.txt</b>.<br>
В файле <b>connect.txt</b> в формате <br>
```
host=127.0.0.1 
login=root  
password=    
database=planets_db 
```
указываются параметры соединения с базой данных.

Для запуска скрипта в одной директории должны быть файлы:  planets.php, PlanetsApi.php,PlanetsDB.php,connect.txt

<b>Запуск:</b> выполнить скрипт planets.php (php planets.php)


UPDATE 27.03.2019:
----------
В класса PlanetsApi функция printResult в цикле считывает данные, получаемые от API, и добавляет их в массив. Затем этот массив 
передаётся функции insertMultiRowsToDatabase класса PlanetsDB.
В классе PlanetsDB вставка данных осуществляется функцией insertMultiRowsToDatabase. 
В цикле формируется запрос для добавления в таблицу всех полученных данных. Предварительно функция createTable проверяет, существует ли нужная таблица, и 
при необходимости создаёт её.
Функция   insertMultiRowsToDatabase из массива данных создаёт SQL запрос для одновременной вставки всех полученных данных.
----------

----------
**_Назначение файлов: <br>_**
----------
<b>planets.php</b> -создание экземпляра класса PlanetsApi и вызов главной функции printResult <br>
<b>PlanetsApi.php</b> -файл класса для работы с API и базой даных (БД). Считывает из файла  connect.txt настройки для соединения с БД.
Функцией MakeRequwest выполняет запрос к удалённому серверу, 
в цикле считывает ответ, пока переменная next, содержащие адрес со следующей страницый данных не будет равно NULL. <br>
На каждом проходе этого цикла данные считывается в массив.
Далее вызываеться функция, записывающая данные из массива в БД . <br>
<b>PlanetsDB.php</b> -класс, отвечающий за работу с базой данных. <br> 
При инициализации экземпляра класса передаться данные для подключения.<br>
При инициализации экземпляра класса SQL скриптом проверяется, существует ли в базе таблица planets, и при отсутствии создаётся.<br>
За вставку данных отвечает процедура insertMultiRowsToDatabase. Вставка осуществляться одним запросом.
