<?php

namespace App\Factory;

use Symfony\Component\Mime\Email as EmailAlias;

class Email implements EmailInterface
{
    public function create(string $from, string $to, string $subject, string $content): EmailAlias
    {
        return (new EmailAlias())
            ->from($from)
            ->to($to)
            ->subject(htmlentities($subject))
            ->html(sprintf('<p>%s</p>', htmlentities($content)));
    }
}
