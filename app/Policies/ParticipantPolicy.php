<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Participant;

class ParticipantPolicy
{
    public function view(User $user, Participant $participant): bool
    {
        if (!$user->supervisor) {
            return false;
        }

        // peserta boleh diakses jika ia punya internship yg id_pembimbing = supervisor login
        return $participant->internships()
            ->where('internship.id_pembimbing', $user->supervisor->id)
            ->exists();
    }
}
