<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\HeroSetting;
use Illuminate\Auth\Access\HandlesAuthorization;

class HeroSettingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:HeroSetting');
    }

    public function view(AuthUser $authUser, HeroSetting $heroSetting): bool
    {
        return $authUser->can('View:HeroSetting');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:HeroSetting');
    }

    public function update(AuthUser $authUser, HeroSetting $heroSetting): bool
    {
        return $authUser->can('Update:HeroSetting');
    }

    public function delete(AuthUser $authUser, HeroSetting $heroSetting): bool
    {
        return $authUser->can('Delete:HeroSetting');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:HeroSetting');
    }

    public function restore(AuthUser $authUser, HeroSetting $heroSetting): bool
    {
        return $authUser->can('Restore:HeroSetting');
    }

    public function forceDelete(AuthUser $authUser, HeroSetting $heroSetting): bool
    {
        return $authUser->can('ForceDelete:HeroSetting');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:HeroSetting');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:HeroSetting');
    }

    public function replicate(AuthUser $authUser, HeroSetting $heroSetting): bool
    {
        return $authUser->can('Replicate:HeroSetting');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:HeroSetting');
    }

}