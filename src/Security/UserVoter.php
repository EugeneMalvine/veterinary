<?php

namespace App\Security;

use App\Entity\User;
use App\Entity\Permission;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserVoter extends Voter
{
    public const CREATE_USER_ACTION = 'create_client';
    public const EDIT_USER_ACTION = 'edit_client';
    public const VIEW_ADMIN = 'view_clients_for_admin';
    public const VIEW_PETS = 'view_pets';

    private const PERMISSIONS = [self::CREATE_USER_ACTION, self::EDIT_USER_ACTION, self::VIEW_ADMIN, self::VIEW_PETS];

    protected function supports($attribute, $subject): bool
    {
        return
            \in_array($attribute, self::PERMISSIONS, true);
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
       /** @var UserInterface $user */
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::CREATE_USER_ACTION:
                return $user->hasCreateUserAccess();
            case self::EDIT_USER_ACTION:
                return $user->hasEditUserAccess();
            case self::VIEW_ADMIN:
                return $user->hasViewUserAccess();
            case self:VIEW_PETS:
                return $user->hasViewPetsUserAccess();
            default:
                return $user->hasPermission($attribute);
        }
    }
}