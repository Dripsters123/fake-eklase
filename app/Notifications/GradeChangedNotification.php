<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class GradeChangedNotification extends Notification
{
    use Queueable;

    protected $action;
    protected $grade;
    protected $teacher;

    public function __construct($action, $grade, $teacher)
    {
        $this->action = $action;
        $this->grade = $grade;
        $this->teacher = $teacher;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'action' => $this->action,
            'grade' => $this->grade->grade ?? null,
            'subject' => $this->grade->subject->subject_name ?? 'N/A',
            'teacher' => $this->teacher->name . ' ' . $this->teacher->last_name,
            'timestamp' => now()->toDateTimeString(),
        ];
    }
}
