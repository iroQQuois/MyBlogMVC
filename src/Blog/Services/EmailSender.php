<?php


namespace Blog\Services;

use Blog\Models\Users\User;

class EmailSender
{
    public static function send(
        User $receiver,
        string $subject,
        string $templateName,
        array $templateVars = []
    ): void
    {
        extract ($templateVars);

        ob_start();
        require __DIR__ . '/../../../templates/main/' . $templateName;
        $body = ob_get_contents();
        ob_end_clean();

        mail($receiver->getEmail(), $subject, $body, 'Content-Type: text/html; chatset=UTF-8');
    }
}