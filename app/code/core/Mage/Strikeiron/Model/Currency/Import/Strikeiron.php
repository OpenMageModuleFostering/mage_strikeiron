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
 * @package    Mage_Directory
 * @copyright  Copyright (c) 2004-2007 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Currency rate import model (From www.webservicex.net)
 *
 * @category   Mage
 * @package    Mage_Directory
 */
class Mage_Strikeiron_Model_Currency_Import_Strikeiron extends Mage_Directory_Model_Currency_Import_Abstract
{
    protected $_messages = array();

    public function fetchRates()
    {
        $data = array();
        $currencies = $this->_getCurrencyCodes();
        $defaultCurrencies = $this->_getDefaultCurrencyCodes();
        try {
          $strikeironModel = Mage::getModel('strikeiron/strikeiron');
          foreach ($defaultCurrencies as $currencyFrom) {
            $currenciesToArr = array();
            if (!isset($data[$currencyFrom])) {
                $data[$currencyFrom] = array();
            }
            foreach ($currencies as $currencyTo) {
        	    if ($currencyFrom == $currencyTo) {
        	        $data[$currencyFrom][$currencyTo] = $this->_numberFormat(1);
        	    }
        		else {
        		    $currenciesToArr[] = $currencyTo;
        		}
        	}
        	if ($currenciesToArr) {
                $result = $strikeironModel->fetchExchangeRate($currencyFrom , $currenciesToArr);
                if ($result) {
                    $data = array_merge_recursive($result, $data);
                    $convertedCurrencies = array();
                    foreach ($result[$currencyFrom] as $k => $r) {
                        $convertedCurrencies[] = $k;
                    }
                    $currenciesNotConverted = array_diff($currenciesToArr, $convertedCurrencies);
                    if ($currenciesNotConverted) {
                        foreach ($currenciesNotConverted as $_currencyNconvert) {
                             $this->_messages[] = Mage::helper('strikeiron')->__('%s is not supported currency.', $_currencyNconvert);
                             $data[$currencyFrom][$_currencyNconvert] = $this->_numberFormat(null);
                        }
                    }
                } else {
                    $this->_messages[] = Mage::helper('strikeiron')->__('Cannot retreive rate from strikeirion.');
                }
        	}
            ksort($data[$currencyFrom]);
          }
        } catch (Exception $e) {
            $this->_messages[] = $e->getMessage();
        }
        return $data;
    }

    protected function _convert($currencyFrom, $currencyTo, $retry=0)
    {

        try {
            $strikeironModel = Mage::getModel('strikeiron/strikeiron');
            $result = $strikeironModel->fetchExchangeRate($currencyFrom , array($currencyTo));
            return $result;
        }
        catch (Exception $e) {
            if( $retry == 0 ) {
                $this->_convert($currencyFrom, $currencyTo, 1);
            } else {
                $this->_messages[] = Mage::helper('strikeiron')->__('Cannot retrieve rate from %s to %s', $currencyFrom, $currencyTo);
            }
        }

    }


}
