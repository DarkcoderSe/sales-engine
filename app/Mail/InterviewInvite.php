<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Carbon\Carbon;

class InterviewInvite extends Mailable
{
    use Queueable, SerializesModels;

    protected $filename;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bdPersonEmail)
    {
        $date = Carbon::now();

        $this->filename = "invite.ics";
		$meeting_duration = (3600 * 0.5); // 0.5 hour
		$meetingstamp = strtotime( $date . " UTC");
		$dtstart = gmdate('Ymd\THis\Z', $meetingstamp);
		$dtend =  gmdate('Ymd\THis\Z', $meetingstamp + $meeting_duration);
		$todaystamp = gmdate('Ymd\THis\Z');
		$uid = date('Ymd').'T'.date('His').'-'.rand().'@yourdomain.com';
		$description = strip_tags("Some TEXT 1");
		$location = "TransData Location";
		$titulo_invite = "Your meeting title";
		$organizer = "CN=Organizer name:{$bdPersonEmail}";
        // ICS
		$mail[0]  = "BEGIN:VCALENDAR";
		$mail[1] = "PRODID:-//Google Inc//Google Calendar 70.9054//EN";
		$mail[2] = "VERSION:2.0";
		$mail[3] = "CALSCALE:GREGORIAN";
		$mail[4] = "METHOD:REQUEST";
		$mail[5] = "BEGIN:VEVENT";
		$mail[6] = "DTSTART;TZID=America/Sao_Paulo:" . $dtstart;
		$mail[7] = "DTEND;TZID=America/Sao_Paulo:" . $dtend;
		$mail[8] = "DTSTAMP;TZID=America/Sao_Paulo:" . $todaystamp;
		$mail[9] = "UID:" . $uid;
		$mail[10] = "ORGANIZER;" . $organizer;
		$mail[11] = "CREATED:" . $todaystamp;
		$mail[12] = "DESCRIPTION:" . $description;
		$mail[13] = "LAST-MODIFIED:" . $todaystamp;
		$mail[14] = "LOCATION:" . $location;
		$mail[15] = "SEQUENCE:0";
		$mail[16] = "STATUS:CONFIRMED";
		$mail[17] = "SUMMARY:" . $titulo_invite;
		$mail[18] = "TRANSP:OPAQUE";
		$mail[19] = "END:VEVENT";
		$mail[20] = "END:VCALENDAR";

		$mail = implode("\r\n", $mail);
		header("text/calendar");
		file_put_contents($this->filename, $mail);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.interview')->attach($this->filename, [
            'as' => 'invite.ics',
            'mime' => 'text/calendar'
        ]);
    }
}
