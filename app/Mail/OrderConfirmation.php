<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    protected $addOrder;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($addOrder)
    {
        $this->addOrder = $addOrder;
    }

    public function build()
    {
        $addOrder = $this->addOrder;

        $ldate = date('YmdHis');

        $changedata = json_decode($addOrder);

        set_time_limit(2500);

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(1000000, 9999999)
        . mt_rand(1000000, 9999999) . $characters[rand(0, strlen($characters) - 1)];
        $string = str_shuffle($pin);

        $pdf = Pdf::loadView('invoice', ['addOrder' => $addOrder]);

        $fileName = 'invoice' . '_' . $ldate . '.pdf';
        $path = public_path('uploads/pdf/'); // Use public_path() to get the public directory path

        // Create the directory if it doesn't exist
        if (!file_exists($path)) {
            mkdir($path, 0777, true); // Create directory with full permissions
        }

        $pdf->save($path . $fileName);

        return $this->view('order')
            ->subject("Go mart")
            ->with(['addOrder' => $changedata, 'fileName' => $fileName])
            ->attachData($pdf->output(), 'invoice.pdf');
    }

}
