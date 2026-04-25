<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Layanan;
use Illuminate\Auth\Access\HandlesAuthorization;

class LayananPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Layanan');
    }

    public function view(AuthUser $authUser, Layanan $layanan): bool
    {
        return $authUser->can('View:Layanan');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Layanan');
    }

    public function update(AuthUser $authUser, Layanan $layanan): bool
    {
        return $authUser->can('Update:Layanan');
    }

    public function delete(AuthUser $authUser, Layanan $layanan): bool
    {
        return $authUser->can('Delete:Layanan');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Layanan');
    }

    public function restore(AuthUser $authUser, Layanan $layanan): bool
    {
        return $authUser->can('Restore:Layanan');
    }

    public function forceDelete(AuthUser $authUser, Layanan $layanan): bool
    {
        return $authUser->can('ForceDelete:Layanan');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Layanan');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Layanan');
    }

    public function replicate(AuthUser $authUser, Layanan $layanan): bool
    {
        return $authUser->can('Replicate:Layanan');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Layanan');
    }

}