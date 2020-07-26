<?php
/**
* @author Carlos W. Gama <carloswgama@gmail.com>
* @license MIT
* @category Library
* @package Firebase
* @subpackage Firebase Cloud Message
* @version 1.0.0
*/

namespace CWG\Firebase;

/**
* 
* Classe para o envio de Push Notification
*/
class FCM {
    
    /**
    * URL para a API do FCM
    * @var string 
    */
    CONST API = 'https://fcm.googleapis.com/fcm/send';

    /**
    * Chave do projeto que irá enviar a Notificação
    * @access private
    * @var string
    */
    private $chaveServidor;

    /**
    * O título e o texto que serão enviados na notificação
    * @access private
    * @var Array
    */
    private $notificao = [];

    /**
    * Seta informações extras
    * @access private
    * @var Array
    */
    private $extras = [];

    public function __construct($chave) {
        $this->chaveServidor = $chave;
    }

    /**
    * Seta a chave do servidor
    * @param $chave string
    * @return FCM
    */
    public function setChaveServidor($chave) {
        $this->chaveServidor = $chave;
        return $this;
    }

    /**
    * Seta o título da notificação
    * @param $titulo string
    * @return FCM
    */
    public function setTitulo($titulo) {
        $this->notificao['title'] = $titulo;
        return $this;
    }

    /**
    * Seta o texto da mensagem
    * @param $texto string
    * @return FCM
    */
    public function setTexto($texto) {
        $this->notificao['body'] = $texto;
        return $this;
    }

    /**
    * Seta a chave a notificação
    * @uses $fcm->setNotificao(['titulo' => 'Meu título', 'texto' => 'Meu texto']);
    * @param $chave string
    * @return FCM
    */
    public function setNotificao($notificao) {
        if (isset($notificao['titulo']))
            $this->setTitulo($notificao['titulo']);
        
        if (isset($notificao['texto']))
            $this->setTexto($notificao['texto']);
        return $this;
    }

    /**
    * Seta informações extras
    * @uses $fcm->setExtras(['pontuacao' => '10', 'tempo' => '10:30']);
    * @param $chave string
    * @return FCM
    */
    public function setExtras($extras) {
        if (is_array($extras))
            $this->extras = $extras;
        return $this;
    }

    /**
    * Envia um Push Notification para um usuário
    * @access public 
    * @param $token string
    * @return array
    */
    public function enviarPara($token) {
        $dados['to'] = $token;

        return $this->_enviar($dados);
    }

    /**
    * Envia um Push Notification para um usuário
    * @access public 
    * @param $token string
    * @return array
    */
    public function enviarTopico($topico) {
        $dados['to'] = '/topics/' . $topico;

        return $this->_enviar($dados);
    }

    /**
    * Realiza o envio para o Servidor
    * @param $dados array
    * @return array
    * @throws 1 Chave do Servidor Errada
    * @throws 2 Token do dispositivo errado
    */
    private function _enviar($dados = []) {
        //JSON
        if (!empty($this->notificao))   $dados['notification'] = $this->notificao;
        if (!empty($this->extras))      $dados['data'] = $this->extras;
        $json = json_encode($dados);

        //Headers
        $headers = [
            'Content-Type:application/json',
            'Authorization:key=' . $this->chaveServidor
        ];

        $ch = curl_init(self::API);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        $resultado = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode == 401) throw new \Exception('Chave do Servidor errada', 1);
        if ($httpcode == 200) {
            $resultado = json_decode($resultado, true);

            if (!empty($resultado['failure']))
                throw new \Exception('Não foi possível enviar para todos os dispositivos. Cheque novamente o token do dispositivo', 2);

            return $resultado;
        }
    }
}