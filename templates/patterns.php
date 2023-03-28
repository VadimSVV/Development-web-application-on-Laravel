    /* 
MVC

Model - модели данных, которые многие и без того используют без фреймворков. Фактически, обычные классы для работы с разными данными.
View - представления, или вид, в котором отображаются данные.
Controller – основной вызываемый класс, содержащий базовую логику приложения.
По концепции MVC, когда пользователь делает запрос, запрос сперва попадает в контроллер (Controller). 
Затем в конроллере может происходить вызов модели (Model) и затем передача данных в шаблон представления (View). 
Основной недостаток MVC заключается в том, что запрос работает только с одним контроллером.

HMVC

В HMVC фактически путь запроса такой же, как и у MVC. Но каждый контроллер может стать родителем другого контроллера. 
Главное отличие от MVC – это возможность передачи запроса по контроллерам и другим классам. Один и тот же запрос может быть передан в цепочку классов, начиная от родительского класса.
HMVC позволяет легко собирать воедино и легко управлять даже большими кусками кода, хотя больше, с усложненной абстракцией.    

MV-VM

Отличие от MVC состоит в отстутствии контроллеров. Данные из модели попадают в элементы представления, и пользователь меняя элементы представления, меняет данные.
Данный шаблон проектирования подходит для используют фрэймворки на стороне клиента. Например, React.js и Angular.js позволяют писать код как на MVC, так и на MV-VM.

MVW

Данный шаблон проектирования оперирует моделями, элементами представления и вспомогательными файлами (не контроллерами), в которых реализована вся логика их взаимодействия.
Model – View – What you want to work
Модель и элементы представления взаимодействуют между собой через какой-то внешний интерфейс, не контроллер.
    
    */
;