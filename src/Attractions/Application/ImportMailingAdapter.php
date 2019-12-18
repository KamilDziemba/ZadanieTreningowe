<?php

declare(strict_types=1);

namespace App\Attractions\Application;

use App\Shared\Mailing\MailDetails;

class ImportMailingAdapter
{
    const EMAIL_SENDER = 'ztestowe68@gmail.com';
    const EMAIL_RECEIVER = 'kamil.dziemba@gmail.com';
    const EMAIL_SUBJECT = 'Import Raport';

    /**
     * @param int $recordsNumber
     * @return MailDetails
     */
    public function adapt(int $recordsNumber): MailDetails
    {
        $content = sprintf('Import create %i rows', $recordsNumber);

        return new MailDetails(
            self::EMAIL_SENDER,
            self::EMAIL_RECEIVER,
            self::EMAIL_SUBJECT,
            $content
        );
    }
}
