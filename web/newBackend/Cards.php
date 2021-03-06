<?php
$cards = <<<EOT
[
    {
        "code": "ExcelInt",
        "Title": "Объеденить материалы",
        "SubTitle": "Найти и объеденить материалы в калькуляциях",
        "pic": "calc_1.jpg",
        "inDeveloping":"false",
        "shortDiscription": "Наш первый сервис позволяет объединять одинаковые материалы из ведомости материалов с учетом количества агрегатов."
    },
    {
        "code": "PlatformDocs",
        "Title": "Документы по платформам",
        "SubTitle": "Учет ремонтной документации",
        "pic": "none",
        "inDeveloping":"true",
        "shortDiscription": "Сервис по учету работ и сотрудников, проводивших работы, при ремонте платформ. Так же сервис позволяет получить паспорт ремонта, включающий документацию по всем выполненным работам"
    },
    {
        "code": "Catalogithator",
        "Title": "Каталогизатор",
        "SubTitle": "Помошник",
        "pic": "okbL.jpg",
        "inDeveloping":"true",
        "shortDiscription": "Учет документации. Кому когда выдано или где лежит. И просто полезные ссылки"
    },
    {
        "code": "TestCard",
        "Title": "Тестовая карточка",
        "SubTitle": "Эта карточка просто для теста",
        "pic": "none",
        "inDeveloping":"false",
        "shortDiscription": "Эта карточка не делает ничего :)"
    }
]
EOT;

header("Access-Control-Allow-Origin: *");
echo $cards;

?>