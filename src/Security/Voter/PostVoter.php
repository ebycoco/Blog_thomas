<?php

namespace App\Security\Voter;

use App\Entity\Post;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class PostVoter extends Voter
{

    public const EDIT = 'edit';

    /**
     * Undocumented function
     *
     * @param string $attribute
     * @param [type] $subject
     * @return void
     */
    protected function supports(string $attribute, $subject)
    {
        if (!$subject instanceof Post) {
            return false;
        }
        if (!in_array($attribute,[self::EDIT])) {
            return false;
        }
        return true;
    }

    /**
     * Undocumented function
     *
     * @param string $attribute
     * @param Post $subject
     * @param TokenInterface $token
     * @return void
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        /** @var User $user */
        $user = $token->getUser();

        switch ($attribute) {
            case self::EDIT:
                return $user === $subject->getUser();
                break;
            
            default:
                # code...
                break;
        }
    }
}

