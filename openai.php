<?php

function getStr($string, $start, $end)
{
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}

$message = $_POST['text'];

require_once 'composer/vendor/autoload.php';
use Orhanerday\OpenAi\OpenAi;

$api = "sk-";
$open_ai = new OpenAi($api);

$complete = $open_ai->complete([
    'engine' => 'text-davinci-002',
    'prompt' => ''.$message.'',
    'temperature' => 0.7,
    'max_tokens' => 100,
    'frequency_penalty' => 0,
    'presence_penalty' => 0.6
]);

// $string = json_decode($complete); pegando resposta por string em json_decode (opcional)

$texto = getStr($complete,'"text":"','"'); //pegando a resposta

print($texto); //recebendo a resposta


/*BOM USO!

💻 coded by: @EUTHEUZIN
meu canal no telegram: @CardersDo7
 
ajudante com key: @pladixoficial 
canal do pladix no telegram: @materialdosvideos
*/
?>