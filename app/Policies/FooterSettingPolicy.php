<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\FooterSetting;
use Illuminate\Auth\Access\HandlesAuthorization;

class FooterSettingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:FooterSetting');
    }

    public function view(AuthUser $authUser, FooterSetting $footerSetting): bool
    {
        return $authUser->can('View:FooterSetting');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:FooterSetting');
    }

    public function update(AuthUser $authUser, FooterSetting $footerSetting): bool
    {
        return $authUser->can('Update:FooterSetting');
    }

    public function delete(AuthUser $authUser, FooterSetting $footerSetting): bool
    {
        return $authUser->can('Delete:FooterSetting');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:FooterSetting');
    }

    public function restore(AuthUser $authUser, FooterSetting $footerSetting): bool
    {
        return $authUser->can('Restore:FooterSetting');
    }

    public function forceDelete(AuthUser $authUser, FooterSetting $footerSetting): bool
    {
        return $authUser->can('ForceDelete:FooterSetting');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:FooterSetting');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:FooterSetting');
    }

    public function replicate(AuthUser $authUser, FooterSetting $footerSetting): bool
    {
        return $authUser->can('Replicate:FooterSetting');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:FooterSetting');
    }

}