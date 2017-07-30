<?php
require_once(dirname(__FILE__).'/../src/FCM.php');
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