<?php
/**
 * User: Tai
 * Date: 9/28/13
 * Time: 10:51 PM
 *
 */

namespace TmCommon\Version;

use \TmCommon\Version\VersionInterface;

class AbstractVersion implements VersionInterface
{

    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $startedDate;

    /**
     * @var string
     */
    protected $dependencies;

    /**
     * @param string $startedDate
     */
    public function setStartedDate($startedDate)
    {
        $this->startedDate = $startedDate;
    }

    /**
     * @return string
     */
    public function getStartedDate()
    {
        return $this->startedDate;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $dependencies
     */
    public function setDependencies($dependencies)
    {
        $this->dependencies = $dependencies;
    }

    /**
     * @return string
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }
}