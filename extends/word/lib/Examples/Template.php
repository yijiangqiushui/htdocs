<?php
require_once '../PHPWord.php';

$PHPWord = new PHPWord();

$document = $PHPWord->loadTemplate('test.docx');
//var_dump($document->_documentXML);

$document->save('Solarsystem.docx');
?>