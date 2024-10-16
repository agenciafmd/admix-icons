<p align="center"><a href="https://fmd.ag" target="_blank"><img src="https://raw.githubusercontent.com/agenciafmd/admix-icons/v11/docs/fmd.png" alt="Logo da F&MD"></a></p>

<p align="center">
<a href="https://packagist.org/packages/agenciafmd/admix-icons"><img src="https://img.shields.io/packagist/dt/agenciafmd/admix-icons" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/agenciafmd/admix-icons"><img src="https://img.shields.io/packagist/v/agenciafmd/admix-icons" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/agenciafmd/admix-icons"><img src="https://img.shields.io/packagist/l/agenciafmd/admix-icons" alt="License"></a>
</p>

Uma versão resumida e/ou inspirada no [blade-ui-kit/blade-icons](https://blade-ui-kit.com/blade-icons)

Os ícones que temos, são:

https://tabler.io/icons

https://icons.getbootstrap.com/

## Instalação

```bash
composer require agenciafmd/admix-icons:v11.x-dev
```

## Uso

Usamos blade-components para renderizar os ícones.

Usamos o prefixo `tl` para o `tabler` e `bs` para `bootstrap`.

```html

<x-tl-icon name="activity"/>

<x-bs-icon name="activity"/>
``` 

Se necessário, você pode passar classes/atributos adicionais para o ícone:

```html

<x-tl-icon name="activity" class="text-primary" fill="currentColor"/>
```

## Customização

Caso você tenha um set de icones e queira adicionar ao pacote, você pode fazer isso.

Publique o arquivo de configuração:

```bash
php artisan vendor:publish --tag=admix-icons:config
```

E adicione o caminho do seu set de ícones no arquivo `config/admix-icons.php`:

```php
...
[
    'name' => 'Heroicons',
    'prefix' => 'hr',
    'path' => 'resources/icons/heroicons',
],
...
```

> É importante que os icones sejam todos em svg e estejam na raiz da pasta.