<?php

namespace App\Mail;

use App\Models\Company;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyCreatedEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Company $company)
    {
        $this->user = $user;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.company-created');
    }
}
