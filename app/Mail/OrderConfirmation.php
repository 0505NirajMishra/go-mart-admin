<?php

namespace App\Mail;

use App\Models\OrderItem;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        $currentdatetime = Carbon::today()->format('Y-m-d');
        $newdateformat = Carbon::createFromFormat('Y-m-d',$currentdatetime)->format('M d Y');

        $changedata = json_decode($addOrder);

        set_time_limit(2500);

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(1000000, 9999999)
        . mt_rand(1000000, 9999999) . $characters[rand(0, strlen($characters) - 1)];
        $string = str_shuffle($pin);

        $userData = User::find($addOrder->user_id);
        $orderDetails = DB::table('order_items')->where('order_no',$addOrder->order_no)->get();

        $pdf = Pdf::loadView('invoice', ['addOrder' => $addOrder,'string' => $string,'newdateformat'=>$newdateformat,'userData' => $userData,'orderDetails' => $orderDetails]);

        $fileName = 'invoice' . '_' . $ldate . '.pdf';
        $path = public_path('uploads/pdf/');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $pdf->save($path . $fileName);

        return $this->view('order')
            ->subject("Go mart")
            ->with(['addOrder' => $changedata, 'fileName' => $fileName ])
            ->attachData($pdf->output(), 'invoice.pdf');
    }

}
