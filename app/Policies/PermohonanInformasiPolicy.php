<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PermohonanInformasi;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermohonanInformasiPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PermohonanInformasi');
    }

    public function view(AuthUser $authUser, PermohonanInformasi $permohonanInformasi): bool
    {
        return $authUser->can('View:PermohonanInformasi');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PermohonanInformasi');
    }

    public function update(AuthUser $authUser, PermohonanInformasi $permohonanInformasi): bool
    {
        return $authUser->can('Update:PermohonanInformasi');
    }

    public function delete(AuthUser $authUser, PermohonanInformasi $permohonanInformasi): bool
    {
        return $authUser->can('Delete:PermohonanInformasi');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:PermohonanInformasi');
    }

    public function restore(AuthUser $authUser, PermohonanInformasi $permohonanInformasi): bool
    {
        return $authUser->can('Restore:PermohonanInformasi');
    }

    public function forceDelete(AuthUser $authUser, PermohonanInformasi $permohonanInformasi): bool
    {
        return $authUser->can('ForceDelete:PermohonanInformasi');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PermohonanInformasi');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PermohonanInformasi');
    }

    public function replicate(AuthUser $authUser, PermohonanInformasi $permohonanInformasi): bool
    {
        return $authUser->can('Replicate:PermohonanInformasi');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PermohonanInformasi');
    }

}