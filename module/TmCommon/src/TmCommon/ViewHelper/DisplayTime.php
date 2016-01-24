<?php

namespace TmCommon\ViewHelper;

use Zend\View\Helper\AbstractHelper;

class DisplayTime extends AbstractHelper
{

    /**
     * __invoke
     */
    public function __invoke($datetime, $DISPLAY_TIME = null)
    {
        $date = date_format($datetime, 'jS M');
        $time = date_format($datetime, "H:i:s");

        $view = $this->getView();
        $timePast = 0;

        $days = abs(ceil((strtotime($date) - strtotime("now")) / 86400));
        if ($days > 1)
            $timePast = $days . " " . $view->translate('days');
        if ($days == 1)
            $timePast = $days . " " . $view->translate('day');
        if ($days <= 1) {
            $hours = abs(ceil((strtotime($time) - strtotime("now")) / 3600));
            if ($days == 0)
                $timePast = $hours . " " . $view->translate('hours');
            if ($hours == 1)
                $timePast = $hours . " " . $view->translate('hour');

            $minutes = abs(ceil((strtotime($time) - strtotime("now")) / 60)) - ($hours * 60);
            if ($hours == 0)
                $timePast = $minutes . " " . $view->translate('minutes');
            if ($minutes == 1)
                $timePast = $minutes . " " . $view->translate('minutes');
            if ($minutes == 0)
                $timePast = "1 " . $view->translate('minutes');;

            return $timePast . " " . $view->translate('ago');
        } else {
            $year = date_format($datetime, 'Y');
            $currentYear = date('Y');
            if ($currentYear - $year > 0) {
                if ($DISPLAY_TIME === true) {
                    return date_format($datetime, 'j.n.Y H:i:s');
                } else {
                    return date_format($datetime, 'j.n.Y');
                }
            } else {
                if ($DISPLAY_TIME === true) {
                    return date_format($datetime, 'j.n H:i:s');
                } else {
                    return date_format($datetime, 'j.n');
                }
            }
        }
    }
}