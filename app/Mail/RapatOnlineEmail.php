<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RapatOnlineEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $emailpembahasan;
    private $emailtanggal;
    private $emailwaktu;
    private $emailruangan;
    private $emailpemimpin;
    private $namapesertaemail;
    private $tglfix;


    public function __construct($emailpembahasan, $emailtanggal, $emailwaktu, $emailruangan, $emailpemimpin, $namapesertaemail, $tglfix)
    {
        $this->pembahasan = $emailpembahasan;
        $this->tanggal = $emailtanggal;
        $this->waktu = $emailwaktu;
        $this->ruangan = $emailruangan;
        $this->pemimpin = $emailpemimpin;
        $this->namapesertaemail = $namapesertaemail;
        $this->tglfix = $tglfix;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('poltekharber24@gmail.com')
                   ->view('pesanemail')
                   ->with(
                    [
                        'pembahasan' => $this->pembahasan,
                        'tanggal' => $this->tanggal,
                        'waktu' => $this->waktu,
                        'ruangan' => $this->ruangan,
                        'pemimpin' => $this->pemimpin,
                        'namapesertaemail' => $this->namapesertaemail,
                        'tglfix' => $this->tglfix,
                        'message' => $this
                        
                    ]);
    }
}
