<?php
require_once(dirname(__FILE__).'/../src/FCM.php');
use CWG\Firebase\FCM;


//Chave do Servidor para o envio de Push Notificação
$chaveServidor = 'AAAAgRytSgU:APA91beexGgSTjr6imnXCqxnP_k_tZ6VqPOZQ1QQ4Ck3-ozyNq5BP3fULtu-YGTZgZMF27QOfYQFqM8szV0t_nxNSCeu7dO1mWMMTOR7L_onWZLb8CC3ZIG-OQxUgiBNqNwV5HtGqw';

$tokenDispositivo = 'ePQ_mDC90Hs:APA91bF-nz_jkGnCe3eGU5hz2EhXGXute9AI2XlYLgC3XlY6MLDSw-GE5jhF7X77FFKLqFyW_S15RPx4qmAiqEl9I7V8n9N7QHc2OUP70ML14FK5KFMBrfKjtUVU0jcE0B9ropjIOmk';

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
