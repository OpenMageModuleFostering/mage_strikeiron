<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category   Mage
 * @package    Mage_Sitemap
 * @copyright  Copyright (c) 2004-2007 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 *
 * @category   Mage
 * @package    Mage_StrikeIron
 */
require_once 'Zend/Service/StrikeIron/Base.php';

class Mage_Strikeiron_Model_Service_Base extends Zend_Service_StrikeIron_Base
{
    public function __construct($options = array())
    {
        $this->_options['wsdl'] = $this->_wsdlDecode();
        parent::__construct($options);
    }

    public function _wsdlDecode()
    {
        return base64_decode($this->_options['wsdl']);
    }

    public function getOptionData($key)
    {
        if( isset($this->_options[$key]) ){
            return $this->_options[$key];
        } else {
            return null;
        }
    }
}