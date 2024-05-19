<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="question" id="">
        <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>

<?php
if(isset($_POST["submit"]))
{
    $api_key = "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";
    $question = $_POST['question'];
    // $question = "Write the full form of: INTERNET, FTP, VLAN, IPSec";
    $url = "https://api.openai.com/v1/engines/davinci/completions";
    $options = array(
      'http' => array(
        'method'  => 'POST',
        'header'  => "Content-type: application/json\r\nAuthorization: Bearer " . $api_key,
        'content' => '{"prompt": "'. $question .'", "max_tokens":1024}'
      )
    );
    $context  = stream_context_create( $options );
    $result = file_get_contents( $url, false, $context );
    $response = json_decode( $result );
    echo $response->choices[0]->text;
}
?>
