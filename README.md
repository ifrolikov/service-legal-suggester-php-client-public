# service-legal-suggester-php-client
PHP клиент для сервиса Legal Suggester

# Использование

## Инициализация
Если url сервиса подсказок берется из etcd, то необходимо установить переменные окружения ETCD_HOST и ETCD_PORT
> export ETCD_HOST=etcd  
export ETCD_PORT=2379

1. Базовая инициализация
```php
$legalSuggesterClient = new \LegalSuggesterClient\LegalSuggesterClient('x-request-id', 'session-id');
```

2. Инициализация с таймаутами
```php
$legalSuggesterClient = new \LegalSuggesterClient\LegalSuggesterClient(
    'x-request-id', 
    'session-id', 
    'request_timeout', 
    'connect_time'
);
```

3. Инициализация с конкретным url, на который будут отправляться запросы
```php
$legalSuggesterClient = new \LegalSuggesterClient\LegalSuggesterClient(
    'x-request-id', 
    'session-id', 
    \LegalSuggesterClient\LegalSuggesterClient::REQUEST_TIMEOUT, 
    \LegalSuggesterClient\LegalSuggesterClient::CONNECT_TIMEOUT, 
    'http://suggester.service:20003'
);
```

## Таймауты
Таймауты можно установить для отдельного запроса. В каждом методе за таймаут запроса отвечает последний параметр
```php
$suggestions = $legalSuggesterClient->search("сбербанк", null, 'request_timeout');
```

## Поиск по организациям
По умолчанию возвращает не более 10 записей
```php
try
{
    $suggestions = $legalSuggesterClient->search("пао сбербанк");
    
    //или с указанием кол-ва записей
    $suggestions = $legalSuggesterClient->search("пао сбербанк", 15);
    
    foreach ($suggestions as $suggestion)
    {
        echo $suggestion->getInn();
        echo $suggestion->getKpp();
        echo $suggestion->getOkpo();
        echo $suggestion->getOgrn();
        echo $suggestion->getRegistrationDate();
        echo $suggestion->getDirectorFullName();
        print_r($suggestion->getContactPhones());
        echo $suggestion->getFullWithOpf();
        echo $suggestion->getShortWithOpf();
        echo $suggestion->getLegalAddress();
        echo $suggestion->getName();
    }
}
catch (\LegalSuggesterClient\ApiException $e)
{
    echo $e->getMessage();
}
```