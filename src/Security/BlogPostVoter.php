<?php

namespace App\Security;

use App\Entity\BlogPost;
use App\Entity\User;
use Dontdrinkandroot\Crud\CrudOperation;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * @author Philip Washington Sorst <philip@sorst.net>
 */
class BlogPostVoter extends Voter
{
    /**
     * {@inheritdoc}
     */
    protected function supports($attribute, $subject)
    {
        return is_a($subject, BlogPost::class, true)
            && in_array($attribute, CrudOperation::all(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        switch ($attribute) {
            case CrudOperation::LIST:
            case CrudOperation::READ:
                return true;
            case CrudOperation::CREATE:
                return $token->isAuthenticated();
            case CrudOperation::UPDATE:
            case CrudOperation::DELETE:
                assert($subject instanceof BlogPost);
                $user = $this->getUser($token);

                return null !== $user && $user->getId() === $subject->getAuthor()->getId();
            default:
                return false;
        }
    }

    private function getUser(TokenInterface $token)
    {
        $user = $token->getUser();
        if ($user instanceof User) {
            return $user;
        }

        return null;
    }
}
