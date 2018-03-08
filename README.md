![logo](dominio-export.png)

Biblioteca para gerar arquivos de texto aceitos no software de folha [Domínio](http://www.dominiosistemas.com.br/)

## Requisitos

* PHP >= 7.0

### Instale usando o composer [Composer](http://getcomposer.org/)

```bash
composer require convenia/convenia-recitable
```

## Exemplos de Uso

```php
use Convenia\PayrollFileReader\Fields\Formats\FieldC;
use Convenia\PayrollFileReader\Patterns\PatternBase;

class DependentRegistry extends PatternBase
{
    protected $length = 21;

    /**
     * @var array
     */
    protected $defaultFields = [
        'fixed' => [
            'format'       => FieldC::class,
            'position'     => 1,
            'length'       => 2,
        ],
        'dependentCode' => [
            'format'       => FieldC::class,
            'position'     => 3,
            'length'       => 10,
        ],
        'value' => [
            'format'       => FieldC::class,
            'position'     => 13,
            'length'       => 9,
        ],
    ];
}
   
// Conversão para string
foreach ($this->events as $event) {
    $file .= $event.PHP_EOL;
}
    
```

## Informações adicionais
O package possuí 6 tipos de eventos, cada um deles com seu modelo.
Para saber mais sobre os modelos e formatos que os modelos aceitam acesse: https://trello-attachments.s3.amazonaws.com/5a314d872eaae5d835af3fc8/5a9944db91e008b4978e1f4f/78b948790299a1f40a44467642806a44/Layout_Importacao_de_Lancamentos_Dominio.pdf

// Para visualizar todos os eventos disponíveis acesse: https://github.com/convenia/dominio-payroll-export/blob/master/src/PayrollExport.php
