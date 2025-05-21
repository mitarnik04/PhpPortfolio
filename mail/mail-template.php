<?php
require_once DIR_HELPERS . '/utils.php';


abstract class MailTemplate
{
    protected abstract function getTokens(): array;

    protected abstract function getTokenPrefix(): string;

    protected abstract function getTokenSuffix(): string;

    protected abstract function getTemplateFullPath(): string;

    public abstract function getRecipientEmails(): array;

    public abstract function getSubject(): string;

    public function asHtml(): string
    {
        $tokens = $this->getTokens();
        $template = file_get_contents($this->getTemplateFullPath());
        return replaceTokens(
            $template,
            $this->getTokenPrefix(),
            $this->getTokenSuffix(),
            $tokens
        );
    }
}
