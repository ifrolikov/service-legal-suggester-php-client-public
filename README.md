# service-legal-suggester-php-client
PHP клиент для сервиса Legal Suggester

# Использование

## Инициализация
Переменные окружения ETCD_HOST и ETCD_PORT должны быть установлены
> export ETCD_HOST=etcd  
export ETCD_PORT=20003
```php
$legalSuggesterClient = new \LegalSuggesterClient\LegalSuggesterClient('x-request-id', 'session-id');
```

## Таймауты
Таймауты можно установить двумя способами:

1. Для всех запросов при создании клиента
```php
$legalSuggesterClient = new \LegalSuggesterClient\LegalSuggesterClient('x-request-id', 'session-id', 'request_timeout', 'connect_timeout');
```
2. Для отдельного запроса. В каждом методе за таймаут запроса отвечает последний параметр
```php
$suggestions = $legalSuggesterClient->search("сбербанк", [], 'request_timeout');
```


## Поиск по организациям
```php
try
{
    $suggestions = $legalSuggesterClient->search("сбербанк");
    
    foreach ($suggestions as $suggestion)
    {
        echo $suggestion['inn'];
        echo $suggestion['kpp'];
        echo $suggestion['okpo'];
        echo $suggestion['type'];
        echo $suggestion['ogrn'];
        echo $suggestion['status'];
        echo $suggestion['registrationDate'];
        echo $suggestion['directorFullName'];

        foreach($suggestion['contactPhones'] as $phone) {
            echo $phone;
        }

        echo $suggestion['fullWithOpf'];
        echo $suggestion['shortWithOpf'];
        echo $suggestion['addressValue'];
    }
}
catch (\LegalSuggesterClient\ApiException $e)
{
    echo $e->getMessage();
}
```