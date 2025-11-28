<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Pengaduan;

class BalasanPengaduanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pengaduan;

    public function __construct(Pengaduan $pengaduan)
    {
        $this->pengaduan = $pengaduan->load('bidang'); // penting!!
    }

    public function build()
    {
        return $this->subject('Balasan atas Pengaduan Anda')
                    ->view('emails.balasan-pengaduan')
                    ->with([
                        'pengaduan' => $this->pengaduan,
                    ]);
    }
}
