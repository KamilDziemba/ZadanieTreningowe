<?php


namespace App\Attractions\Application;

use App\Shared\Mailing\MailDetails;

class ImportMailingAdapter
{
    const SENDER_EMAIL = 'ztestowe68@gmail.com';
    const RECEIVER_EMAIL = 'kamil.dziemba@gmail.com';

    /**
     * @param int $recordsNumber
     * @return MailDetails
     */
    public function adapt(int $recordsNumber):MailDetails
    {
        $content = "Import create $recordsNumber rows";

        return new MailDetails(
          self::SENDER_EMAIL,
          self::RECEIVER_EMAIL,
          'Import Raport',
          $content
        );
    }
}