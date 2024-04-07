<?php

namespace App\Policies;

use App\Models\Informasikegiatan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InformasikegiatanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Informasikegiatan $informasikegiatan): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Informasikegiatan $informasikegiatan): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Informasikegiatan $informasikegiatan): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Informasikegiatan $informasikegiatan): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Informasikegiatan $informasikegiatan): bool
    {
        //
    }
}
