<?php

require_once __DIR__ . '/tester.php';
require_once __DIR__ . '/../helpers/translation.php';

$tester = new Tester();
$translation = new Translation(fn($language) => __DIR__ . '/../translations/' . $language . '.json');

$tester->run('Value in Object translation', function ($translation) {
    $language = 'en';
    $result = '';
    $result = $result . $translation->get('GENERAL:SUCCESS', $language);
    $result = $result . $translation->get('GENERAL:OK', $language);
    $result = $result . $translation->get('SPA_SETUP:HOME', $language);
    $result = $result . $translation->get('SPA_SETUP:CONTACT', $language);
    $result = $result . $translation->get('SPA_SETUP:PROJECTS', $language);
    return $result;
}, 100, $translation);

$tester->run('Value in Object in Object translation', function ($translation) {
    $language = 'en';
    $result = '';
    $result = $result . $translation->get('CONTACT_PAGE:REASON:PLACEHOLDER', $language);
    $result = $result . $translation->get('CONTACT_PAGE:REASON:COLLABORATION', $language);
    $result = $result . $translation->get('CONTACT_PAGE:REASON:FREELANCE', $language);
    $result = $result . $translation->get('CONTACT_PAGE:REASON:TECHCHAT', $language);
    $result = $result . $translation->get('CONTACT_PAGE:REASON:OTHER', $language);
    return $result;
}, 100, $translation);


$tester->displayResultsAsHtml();
