<?php

declare(strict_types=1);

namespace App\Shared\Mailing;

use Symfony\Component\Mailer\MailerInterface;

class MailService
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var MailBuilder
     */
    private $mailBuilder;

    /**
     * MailService constructor.
     * @param MailerInterface $mailer
     * @param MailBuilder $mailBuilder
     */
    public function __construct(MailerInterface $mailer, MailBuilder $mailBuilder)
    {
        $this->mailer = $mailer;
        $this->mailBuilder = $mailBuilder;
    }

    /**
     * @param MailDetails $mailDetails
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function sendEmail(MailDetails $mailDetails)
    {
        $email = $this->mailBuilder->build($mailDetails);

        $this->mailer->send($email);
    }
}