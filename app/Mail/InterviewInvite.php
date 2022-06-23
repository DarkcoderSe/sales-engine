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

        $profileName = $int->profile->name ?? '';
        $info = $int->profile->info;
        $jobBoard = $int->lead->jobSource->name ?? '';
        $techStack = "";

        foreach ($int->lead->techs as $tech) {
            $techStack .= "{$tech->name}, ";
        }


        $description = "<b>Profile:</b> {$profileName} <br>
        <b>Interview Mode:</b> {$int->interview_mode} <br>
        <b>Interview Link:</b> {$int->interview_link} <br>
                        {$info} <br><br>
                        <b>---------------------------------</b><br><br>
                        <b>Client Name:</b> {$int->client_name} <br>
                        <b>Client Organization:</b> {$int->client_organization} <br>
                        <b>Client Website:</b> {$int->client_website} <br>
                        <b>Client Job Title:</b> {$int->client_job_title} <br> <br>
                        <b>Position:</b> {$int->position} <br>
                        <b>Salary Range:</b> {$int->salary_range} <br>
                        <b>Job Board:</b> {$jobBoard} <br>
                        <b>Tech Stack:</b> {$techStack} <br><br>
                        <b>---------------------------------</b><br><br>
                        <b>Notes:</b> {$int->notes} <br><br>
                        <b>---------------------------------</b><br><br>
                        {$int->lead->job_description}";

		$description = str_replace("\r\n", "<br>", $description);
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
