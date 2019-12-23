<?php

namespace AAM\AddOn\EnhancedAccessPolicy\User;

/**
 * Helper class that works with different user attributes
 *
 * @package AAM\AddOn\EnhancedAccessPolicy
 * @author Vasyl Martyniuk <vasyl@vasyltech.com>
 * @version 0.0.1
 */
class Account
{

    /**
     * Get the number of days user was registered
     *
     * @return int
     *
     * @access public
     * @version 0.0.1
     */
    public static function getRegisteredDays()
    {
        return self::getDifference('%a');
    }

    /**
     * Get the number of hours user was registered
     *
     * @return int
     *
     * @access public
     * @version 0.0.1
     */
    public static function getRegisteredHours()
    {
        return self::getDifference('%h');
    }

    /**
     * Get date difference and return value based on provided format
     *
     * @param string $format
     *
     * @return int
     *
     * @access protected
     * @version 0.0.1
     */
    protected static function getDifference($format)
    {
        $user_id = get_current_user_id();

        if (!empty($user_id)) {
            $diff = date_diff(
                new \DateTime(_wp_get_current_user()->user_registered),
                new \DateTime()
            );
            $response = $diff->format($format);
        } else {
            $response = 0;
        }

        return intval($response);
    }

}