<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Participant;
use App\Models\Internship;

class ParticipantPolicy
{
    public function view(User $user, Participant $participant): bool
    {
        if (!$user->supervisor) {
            return false;
        }

        return Internship::query()
            ->where('participant_id', $participant->id)
            ->where('supervisor_id', $user->supervisor->id)
            ->exists();
    }
}
