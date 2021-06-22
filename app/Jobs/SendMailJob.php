<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use App\Models\Token;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $email, $url, $token;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $url, $token)
    {
       $this->email = $email;
       $this->url = $url;
       $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Send email
        Mail::send(['text' => 'url'], ['url' => $this->url], function ($m) {
            $m->from('hello@app.com', 'Your Application');

            $m->to($this->email, '')->subject('Hello employee, fill in the form.');
        });

        Token::create([
            'token' => $this->token,
            'email' => $this->email
        ]);
        return;
    }
}
