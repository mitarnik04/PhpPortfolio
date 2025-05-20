<?php

class ContactMailTemplate extends MailTemplate
{


    // $firstname = $_POST['firstname'];
    // $lastname = $_POST['lastname'];
    // $email = $_POST['email'];
    // $message = $_POST['message'];
    // $reason = $_POST['reason'] ?? '';

    function __construct() {}

    protected abstract function getTokens(): array {}

    protected abstract function getTokenPrefix(): string;

    protected abstract function getTokenSuffix(): string;

    protected abstract function getTemplateFullPath(): string;

    public abstract function getSubject(): string;
}
