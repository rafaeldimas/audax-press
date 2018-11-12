# AudaxPress

Framework wordpress para projetos do Grupo Audax.

## Primeiros Passos

### Pré-requisitos

* PHP ^7.1.3
* [Composer] (https://getcomposer.org/)

### Instalação

Após o Composer estiver instalado, rode os seguintes comandos:

```bash
composer init -y
composer require grupoaudax/audax-press
```

## Utilização

```php
<?php

require_once 'vendor/autoload.php';

$app = new \GrupoAudax\AudaxPress\Application(__DIR__.'/src');

```

## Contribuição
Pull request são bem-vindos. Para alterações importantes, por favor, abra um problema primeiro para discutir o que você gostaria de mudar.

Por favor, certifique-se de atualizar os testes conforme apropriado.

## Licença
[MIT](https://choosealicense.com/licenses/mit/)