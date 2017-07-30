# PHP - FCM
Classe facilitar o uso do Firebase Cloud Message através de um Webservice com PHP

*Essa biblioteca PHP será útil para quem já usa o FCM para o uso Push Notification em seus Smartphones, porém necessita que o envio da notificação seja feito por um servidor em PHP.*

## Obtendo a Chave do Servidor

*Esse tutorial está levando em considerção que já tenha criado um projeto no Firebase e configurado no seu aplicativo, ou seja, apenas será demonstrado como usar essa biblioteca no servidor PHP para o envio do Push Notification e não o recebimento no Smartphone.*

*Caso tenha dúvidas de como receber a notificação, basta olhar a documentação do Google para o recebimento de notificações*

[Documentação de como Receber Notificações no Aplicativo](https://firebase.google.com/docs/cloud-messaging/)

-----

Inicialmelnte entre no seu [Console do Firebase](https://console.firebase.google.com/) e escolha o projeto que deseja trabalhar: 
![Console Firebase](http://carloswgama.com.br/firebase/console_firebase.jpg)


Após acessar o seu projeto, clique na engrenagem para acessar as configurações do projeto:
![Configuração do Projeto](http://carloswgama.com.br/firebase/configuracao_projeto.jpg)

Na tela de configurações, basta clicar na aba Cloud Message e já poderá ver a Chave do Servidor (Inclusive adicionar novas chaves)
![Chave do Servidor](http://carloswgama.com.br/firebase/chave_servidor.jpg)
 

## Baixando o projeto

Para usar esse projeto, basta baixar esse repositório em seu projeto e importar a classe em src/FCM.php ou usar o composer que é o mais indicado:

```
composer require carloswgama/php-fcm
```

Caso seu projeto já possua um arquivo composer.json, você pode também adiciona-lo nas dependências require e rodar um composer install:
```
{
    "require": {
        "carloswgama/php-fcm"
    }
}
```

## Exemplos

Abaixo segue alguns exemplos de como usar a classe


### Enviando para um Dispositivo
``` php
<?php
require_once(dirname(__FILE__).'/vendor/autoload.php');
use CWG\Firebase\FCM;


//Chave do Servidor para o envio de Push Notificação
$chaveServidor = 'AAAAgRytSgU:APA91bHeexGgSTjr6imnXCqxnP_k_tZ6VqPOZQ1QQ4Ck3-ozyNq5BP3fULtu-YGTZgZMF27QOfYQFqM8szV0t_nxNSCeu7dO1mWMMTOR7L_onWZLb8CC3ZIG-OQxUgiBNqNwV5HtGqw';

//Token do Dispositivo
$tokenDispositivo = 'ePQ_mDC90Hs:APA91bF-nz_jkGunC3eGU5hz2EhXGXute9AI2XlYLgC3XlY6MLDSw-GE5jhF7X77FFKLqFyW_S15RPx4qmAiqEl9I7V8n9N7QHc2OUP70ML14FK5KFMBrfKjtUVU0jcE0B9ropjIOmk';

//Classe para o envio
$fcm = new FCM($chaveServidor);

try {
    $resultado = $fcm->setTitulo('Título - Dispositívo')
                     ->setTexto('Textoo - Dispositívo')
                     ->enviarPara($tokenDispositivo);

    echo "Enviado com sucesso!<br/>";
    print_r($resultado);
    
} catch(Exception $e) {
    echo "Erro: " . $e->getMessage();
}
``` 

### Enviando para um tópico

``` php
<?php
require_once(dirname(__FILE__).'/vendor/autoload.php');
use CWG\Firebase\FCM;

//Chave do Servidor para o envio de Push Notificação
$chaveServidor = 'AAAAgRytSgU:APA91bHeexGgSTjr6imnXCqxnP_k_tZ6VqPOZQ1QQ4Ck3-ozyNq5BP3fULtu-YGTZgZMF27QOfYQFqM8szV0t_nxNSCeu7dO1mWMMTOR7L_onWZLb8CC3ZIG-OQxUgiBNqNwV5HtGqw';

//Classe para enviar 
$fcm = new FCM($chaveServidor);

try {
    $resultado = $fcm->setTitulo('Título - Dispositívo')
                        ->setTexto('Textoo - Dispositívo')
                        ->enviarTopico('literatura');
    
    echo "Enviado com sucesso!<br/>";
    print_r($resultado);    
} catch(Exception $e) {
    echo "Erro: " . $e->getMessage();
}
```

### Enviando com dados extras (data)

``` php
<?php
require_once(dirname(__FILE__).'/vendor/autoload.php');
use CWG\Firebase\FCM;

//Chave do Servidor para o envio de Push Notificação
$chaveServidor = 'AAAAgRytSgU:APA91bHeexGgSTjr6imnXCqxnP_k_tZ6VqPOZQ1QQ4Ck3-ozyNq5BP3fULtu-YGTZgZMF27QOfYQFqM8szV0t_nxNSCeu7dO1mWMMTOR7L_onWZLb8CC3ZIG-OQxUgiBNqNwV5HtGqw';

//Classe para enviar 
$fcm = new FCM($chaveServidor);

$dadosExtras = ['nome' => 'Carlos', 'cargo' => 'programador'];

try {
    $resultado = $fcm->setTitulo('Título - Dispositívo')
                        ->setTexto('Textoo - Dispositívo')
                        ->setExtras($dadosExtras)
                        ->enviarTopico('literatura');
    
    echo "Enviado com sucesso!<br/>";
    print_r($resultado);    
} catch(Exception $e) {
    echo "Erro: " . $e->getMessage();
}
```

Nos links acima você poderá ver diversos exemples para criar plano, assinatura, compra, notificações... 

---
**Autor:**  Carlos W. Gama *(carloswgama@gmail.com)*
**Licença:** MIT

Livre para usar, modificar como desejar e destribuir como quiser