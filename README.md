# PHP - CrossDocking

Uma maneira fácil de obter informações dos cross dockings das principais distribuidoras do brasil:

    - Hayamax - OK
    - Aldo - TODO
    - Buscar por outros cross dockings - TODO

## Instalação

Via Composer

``` bash
$ composer require julianobailao/cross-docking
```

## Como usar

``` php
$client = new JulianoBailao\CrossDocking\Client();

$hayamax = $client->hayamax($clientId = '12345');
$products = $hayamax->getData();
```
