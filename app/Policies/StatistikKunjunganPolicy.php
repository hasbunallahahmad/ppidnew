<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\StatistikKunjungan;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatistikKunjunganPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:StatistikKunjungan');
    }

    public function view(AuthUser $authUser, StatistikKunjungan $statistikKunjungan): bool
    {
        return $authUser->can('View:StatistikKunjungan');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:StatistikKunjungan');
    }

    public function update(AuthUser $authUser, StatistikKunjungan $statistikKunjungan): bool
    {
        return $authUser->can('Update:StatistikKunjungan');
    }

    public function delete(AuthUser $authUser, StatistikKunjungan $statistikKunjungan): bool
    {
        return $authUser->can('Delete:StatistikKunjungan');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:StatistikKunjungan');
    }

    public function restore(AuthUser $authUser, StatistikKunjungan $statistikKunjungan): bool
    {
        return $authUser->can('Restore:StatistikKunjungan');
    }

    public function forceDelete(AuthUser $authUser, StatistikKunjungan $statistikKunjungan): bool
    {
        return $authUser->can('ForceDelete:StatistikKunjungan');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:StatistikKunjungan');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:StatistikKunjungan');
    }

    public function replicate(AuthUser $authUser, StatistikKunjungan $statistikKunjungan): bool
    {
        return $authUser->can('Replicate:StatistikKunjungan');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:StatistikKunjungan');
    }

}