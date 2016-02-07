<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import ('BxDolTwigCalendar');

class BxMatchCalendar extends BxDolTwigCalendar
{
    function BxMatchCalendar ($iYear, $iMonth, &$oDb, &$oConfig, &$oTemplate)
    {
        parent::BxDolTwigCalendar($iYear, $iMonth, $oDb, $oConfig);
    }

    function getEntriesNames ()
    {
        return array(_t('_bx_matches_match_single'), _t('_bx_matches_match_plural'));
    }
}
