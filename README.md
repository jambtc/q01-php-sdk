# Q01 PHP SDK

Q01 PHP SDK è una libreria per interagire con REST API protette da Bearer Token.

## Installazione

Puoi installare questa libreria tramite Composer:

```bash
composer require jambtc/q01-php-sdk
```

## How to use

```php
// Inizializza AuthService con il base URL
$authService = new AuthService('https://q01.example.com');

 // imposto il token dall'user identity o dal bearer
$authService->setToken(Yii::$app->user->identity->apiToken);

// Autenticazione
$authService->validateToken();

// Inizializza il controller
$artsController = new ArtsController($authService);


// Ottieni la Lista
$arts = $artsController->getAllArts();
```
