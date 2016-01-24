<?php
/**
 * User: Tai
 * Date: 9/26/13
 * Time: 11:38 PM
 *
 */

namespace TmCommon\Version;

interface VersionInterface
{
    /**
     * @param string $startedDate
     */
    public function setStartedDate($startedDate);

    /**
     * @return string
     */
    public function getStartedDate();

    /**
     * @param string $version
     */
    public function setVersion($version);

    /**
     * @return string
     */
    public function getVersion();

    /**
     * @param array $dependencies
     */
    public function setDependencies($dependencies);

    /**
     * @return string
     */
    public function getDependencies();


}