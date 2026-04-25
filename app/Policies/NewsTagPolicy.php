<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Novius\LaravelFilamentNews\Models\NewsTag;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsTagPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:NewsTag');
    }

    public function view(AuthUser $authUser, NewsTag $newsTag): bool
    {
        return $authUser->can('View:NewsTag');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:NewsTag');
    }

    public function update(AuthUser $authUser, NewsTag $newsTag): bool
    {
        return $authUser->can('Update:NewsTag');
    }

    public function delete(AuthUser $authUser, NewsTag $newsTag): bool
    {
        return $authUser->can('Delete:NewsTag');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:NewsTag');
    }

    public function restore(AuthUser $authUser, NewsTag $newsTag): bool
    {
        return $authUser->can('Restore:NewsTag');
    }

    public function forceDelete(AuthUser $authUser, NewsTag $newsTag): bool
    {
        return $authUser->can('ForceDelete:NewsTag');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:NewsTag');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:NewsTag');
    }

    public function replicate(AuthUser $authUser, NewsTag $newsTag): bool
    {
        return $authUser->can('Replicate:NewsTag');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:NewsTag');
    }

}