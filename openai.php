<?php

// Verifica se foi enviado um valor para a variável 'text'
if (!isset($_POST['text']) || empty($_POST['text'])) {
    echo 'Por favor, diga-me algo para que eu possa ajudar a sanar sua dúvida.';
    exit;
}

// Inclui o autoload do Composer
require_once 'composer/vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;

// Define a chave de API
$api_key = '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';

// Cria uma instância da classe OpenAi
$open_ai = new OpenAi($api_key);

// Define os parâmetros da chamada à API
$params = [
    'engine' => 'text-davinci-002',
    'prompt' => $_POST['text'],
    'temperature' => 0.7,
    'max_tokens' => 100,
    'frequency_penalty' => 0,
    'presence_penalty' => 0.6,
];

// Executa a chamada à API
try {
    $response = $open_ai->complete($params);
} catch (Exception $e) {
    echo 'Erro ao consultar a API: ' . $e->getMessage();
    exit;
}

// Extrai a resposta da API
$texto = get_string_between($response, '"text":"', '"');

// Imprime a resposta
echo $texto;

/**
 * Função para extrair uma substring entre duas outras substrings.
 */
function get_string_between($string, $start, $end) {
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
