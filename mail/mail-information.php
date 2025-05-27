<?php
require_once DIR_HELPERS . '/utils.php';
class MailInformation
{

    public function __construct(
        public readonly string $username,
        public readonly string $password,
        public readonly string $senderMail
    ) {}

    public static function fromConfiguration()
    {
        $content = [];
        if (!tryGetJsonContent(__DIR__ . '/mail-config.json', $content)) {
            throw new RuntimeException('no mail-config.json file was found in the mail folder');
        }

        return new MailInformation(
            $content['USERNAME'],
            $content['PASSWORD'],
            $content['SENDER_MAIL'],
        );
    }
}
