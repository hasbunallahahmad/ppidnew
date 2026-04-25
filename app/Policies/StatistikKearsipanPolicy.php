<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\StatistikKearsipan;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatistikKearsipanPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:StatistikKearsipan');
    }

    public function view(AuthUser $authUser, StatistikKearsipan $statistikKearsipan): bool
    {
        return $authUser->can('View:StatistikKearsipan');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:StatistikKearsipan');
    }

    public function update(AuthUser $authUser, StatistikKearsipan $statistikKearsipan): bool
    {
        return $authUser->can('Update:StatistikKearsipan');
    }

    public function delete(AuthUser $authUser, StatistikKearsipan $statistikKearsipan): bool
    {
        return $authUser->can('Delete:StatistikKearsipan');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:StatistikKearsipan');
    }

    public function restore(AuthUser $authUser, StatistikKearsipan $statistikKearsipan): bool
    {
        return $authUser->can('Restore:StatistikKearsipan');
    }

    public function forceDelete(AuthUser $authUser, StatistikKearsipan $statistikKearsipan): bool
    {
        return $authUser->can('ForceDelete:StatistikKearsipan');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:StatistikKearsipan');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:StatistikKearsipan');
    }

    public function replicate(AuthUser $authUser, StatistikKearsipan $statistikKearsipan): bool
    {
        return $authUser->can('Replicate:StatistikKearsipan');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:StatistikKearsipan');
    }

}