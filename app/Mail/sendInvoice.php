<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\contracts\Filesystem;

class sendInvoice extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $imgPath;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$imgPath)
    {
        $this->data = $data;
        $this->imgPath = $imgPath;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('yourmobileapp2017@gmail.com')->subject('Carty Invoice')->view('all_orders.invoiceMail')->attach($this->imgPath)->with('data',$this->data);
    }
}
