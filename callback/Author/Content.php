<?php

namespace AAM\AddOn\EnhancedAccessPolicy\Author;

/**
 * Helper class that allows to obtain stats about author's writing
 *
 * @package AAM\AddOn\EnhancedAccessPolicy
 * @author Vasyl Martyniuk <vasyl@vasyltech.com>
 * @version 0.0.1
 */
class Content
{

    /**
     * Get the number of user's posts
     *
     * @return int
     *
     * @access public
     * @version 0.0.1
     */
    public static function getPostCount()
    {
        $user_id = get_current_user_id();

        if (!empty($user_id)) {
            $manager   = \AAM::api()->getAccessPolicyManager();

            $type   = $manager->getParam('EnhancedAccessPolicy:Author:Content:PostType');
            $public = $manager->getParam('EnhancedAccessPolicy:Author:Content:PublicOnly');

            $response = count_user_posts(
                $user_id, ($type ?? 'post'), ($public ?? false)
            );
        } else {
            $response = 0;
        }

        return $response;
    }

}