<?php

/**
 * Space Icon
 * 
 * @copyright  Georg Preissl 2017
 * @package    spaceicon
 * @author     Georg Preissl <http://www.georg-preissl.at>
 * @license    LGPL
 */

namespace Contao;


class spaceIcon extends \Backend {

    /**
     * Change database margin value
     */
    public function executePreActions($strAction)
    {
        if ($strAction == 'changeSpace')
        {
            $id = \Input::post('id');
            $strMinus = \Input::post('minus');
            $isMinus = ($strMinus === 'true' ? true : false);

            $this->import('Database');
            $result = $this->Database->prepare("SELECT space FROM tl_content WHERE id=?")->execute($id);
            $arrSpace = deserialize($result->space);

            if ($isMinus) {
                if ($arrSpace[1]-10 >= 0) {
                    $arrSpace[1] = $arrSpace[1]-10;
                }
            } else {
                $arrSpace[1] = $arrSpace[1]+10;
            }
            
            $this->Database->prepare("UPDATE tl_content SET space = ? WHERE id=?")->execute(serialize($arrSpace), $id);
            echo $arrSpace[1] . 'px';
            exit; 
        }        
    }
    

    /**
     * Add the dca configuration for the icon
     */
    public function addSpaceIconDCA()
    {
        $GLOBALS['TL_DCA']['tl_content']['list']['operations']['space'] = array
        (
            'label'               => &$GLOBALS['TL_LANG']['tl_content']['spaceIcon'],
            'icon'                => 'system/modules/spaceicon/assets/icon.svg',
            'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.changeSpace(event,this,%s)"',
            'button_callback'     => array('spaceIcon', 'createSpaceIcon')
        );
    }


    /**
     * Create the html for the icon
     */
    public function createSpaceIcon($row, $href, $label, $title, $icon, $attributes)
    {
        $result = $this->Database->prepare("SELECT space FROM tl_content WHERE id=?")->execute($row['id']);
        $arrSpace = deserialize($result->space);

        if ($arrSpace[1]=='') {
            $arrSpace[1]=0;
        }

        return '<a class="space_icon" href="#" title="'.specialchars($title).'"'.$attributes.'>'
        .Image::getHtml('system/modules/spaceicon/assets/icon.svg', $label, 'data-space="' . $arrSpace[1] . '"')
        .'<span>'.$arrSpace[1].'</span>'
        .'</a> ';
    }

}  




?>