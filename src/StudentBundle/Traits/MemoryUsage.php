<?php
/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 17.01.17
 * Time: 15:35
 */

namespace StudentBundle\Traits;

use StudentBundle\Command\CreateUserCommand;

trait MemoryUsage
{
    /**
     * @param $bytes
     * @return string
     */
    public function getMemoryReport($bytes)
    {
        return "Current memory usage: " . round(memory_get_usage() / $bytes, 2) . " Mb";
    }
}
