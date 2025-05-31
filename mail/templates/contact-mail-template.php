<?php

class ContactMailTemplate extends MailTemplate
{

    function __construct(
        public readonly string $reason,
        public readonly string $firstname,
        public readonly string $lastname,
        public readonly string $email,
        public readonly string $message,
    ) {}

    protected function getTokens(): array
    {
        return [
            'REASON' => $this->reason,
            'FIRSTNAME' => $this->firstname,
            'LASTNAME' => $this->lastname,
            'EMAIL' => $this->email,
            'MESSAGE' => $this->message,
        ];
    }

    protected function getTokenPrefix(): string
    {
        return '[[[';
    }

    protected function getTokenSuffix(): string
    {
        return ']]]';
    }

    protected function getTemplateFullPath(): string
    {
        return __DIR__ . '/contact.tpl';
    }

    public function getRecipientEmails(): array
    {
        return ['mitar.mn5@gmail.com'];
    }

    public function getSubject(): string
    {
        return "New Request via Protfolio";
    }
}
