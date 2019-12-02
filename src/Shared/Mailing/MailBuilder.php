<?php


namespace App\Shared\Mailing;


use Symfony\Component\Mime\Email;

class MailBuilder
{
    /**
     * @param MailDetails $mailDetails
     * @return Email
     */
    public function build(MailDetails $mailDetails): Email
    {
        $email = (new Email())
            ->from($mailDetails->getSender())
            ->to($mailDetails->getReceiver())
            ->subject($mailDetails->getSubject())
            ->text($mailDetails->getContent());

        return $email;
    }
}