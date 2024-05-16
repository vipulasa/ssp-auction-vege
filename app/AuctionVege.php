<?php

namespace App;

class AuctionVege
{
    public string $app_name = "Auction Vege";

    private string $message = 'Sample';

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }


}
