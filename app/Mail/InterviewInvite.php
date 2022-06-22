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
    protected $req;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bdPersonEmail, $int)
    {
        $date = Carbon::now();
        $eventStartTime = $int->event_start_at;

        $this->filename = "invite-{$date}.ics";
		$meeting_duration = (60 * $int->event_duration); // 0.5 hour
		$meetingstamp = strtotime( $eventStartTime . " " . $int->event_timezone);
		$dtstart = gmdate('Ymd\THis\Z', $meetingstamp);
		$dtend =  gmdate('Ymd\THis\Z', $meetingstamp + $meeting_duration);
		$todaystamp = gmdate('Ymd\THis\Z');
		$uid = date('Ymd').'T'.date('His').'-'.rand().'@transdata.biz';
		$description = $int->lead->job_description ?? '';
		$location = $int->location;
		$titulo_invite = $int->title;
		$organizer = "CN={$int->bdm->name} :{$bdPersonEmail}";

        $tz = "America/New_York";
        if ($int->event_timezone == 'PKT') {
            $tz = "Asia/Karachi";
        }
        else if ($int->event_timezone == 'MDT') {
            $tz = "Mexico/BajaSur";
        }
        else if ($int->event_timezone == 'PDT') {
            $tz= "America/Ensenada";
        }
        // ICS
		$mail[0]  = "BEGIN:VCALENDAR";
		$mail[1] = "PRODID:-//Google Inc//Google Calendar 70.9054//EN";
		$mail[2] = "VERSION:2.0";
		$mail[3] = "CALSCALE:GREGORIAN";
		$mail[4] = "METHOD:REQUEST";
		$mail[5] = "BEGIN:VEVENT";
		$mail[6] = "DTSTART;TZID={$tz}:" . $dtstart;
		$mail[7] = "DTEND;TZID={$tz}:" . $dtend;
		$mail[8] = "DTSTAMP;TZID={$tz}:" . $todaystamp;
		$mail[9] = "UID:" . $uid;
		$mail[10] = "ORGANIZER;" . $organizer;
		$mail[11] = "CREATED:" . $todaystamp;
		$mail[12] = "PROFILE:" . $int->profile->name ?? 'Unknown';
		$mail[13] = "INTERVIEW_MODE:" . $int->interview_mode;
		$mail[14] = "INTERVIEW_LINK:" . $int->interview_link;
		$mail[15] = "NOTES:" . $int->notes;
		$mail[16] = "DESCRIPTION:" . $description;
		$mail[17] = "LAST-MODIFIED:" . $todaystamp;
		$mail[18] = "LOCATION:" . $location;
		$mail[18] = "ABC:regio";
		$mail[19] = "SEQUENCE:0";
		$mail[20] = "STATUS:CONFIRMED";
		$mail[21] = "SUMMARY:" . $titulo_invite;
		$mail[22] = "TRANSP:OPAQUE";
		$mail[23] = "END:VEVENT";
		$mail[24] = "END:VCALENDAR";

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
