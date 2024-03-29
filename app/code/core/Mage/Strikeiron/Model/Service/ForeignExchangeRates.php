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
class Mage_Strikeiron_Model_Service_ForeignExchangeRates extends Mage_Strikeiron_Model_Service_Base
{
    /**
     * Configuration options
     * @param array
     */
    protected $_options = array('username' => null,
                                'password' => null,
                                'client'   => null,
                                'options'  => null,
                                'headers'  => null,
                                'wsdl'     => 'aHR0cDovL3dzLnN0cmlrZWlyb24uY29tL3Zhcmllbi5TdHJpa2VJcm9uL0ZvcmVpZ25FeGNoYW5nZVJhdGU/V1NETA==');
}
