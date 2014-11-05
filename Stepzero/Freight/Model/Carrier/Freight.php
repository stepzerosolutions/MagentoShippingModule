<?php
/**
 * Air Freight for Magento
 *
 *
 * @category    design
 * @by			Stepzero
 * @developer	Don Udugala (info@stepzero.solutions)
 */
 class Stepzero_Freight_Model_Carrier_Freight 
 extends Mage_Shipping_Model_Carrier_Abstract
 implements  Mage_Shipping_Model_Carrier_Interface{
	 
	protected $_code = 'stepzero_freight';


	
	public function collectRates(Mage_Shipping_Model_Rate_Request $request)
	{
		$result = Mage::getModel('shipping/rate_result');
		$result->append($this->_getStandardShippingRate());
		$result->append($this->_getAirfreightShippingRate());
		return $result;
	}
	
	
   protected function _getStandardShippingRate()
    {
        $rate = Mage::getModel('shipping/rate_result_method');
        /* @var $rate Mage_Shipping_Model_Rate_Result_Method */
        $rate->setCarrier($this->_code);
        $rate->setCarrierTitle($this->getConfigData('title'));
        $rate->setMethod('standand');
        $rate->setMethodTitle('Standard');
        $rate->setPrice($this->getConfigData('price'));
        $rate->setCost(0);

        return $rate;
    }
	
	protected function _getAirfreightShippingRate()
	{
		$rate = Mage::getModel('shipping/rate_result_method');
		/* @var $rate Mage_Shipping_Model_Rate_Result_Method */
		$rate->setCarrier($this->_code);
		$rate->setCarrierTitle($this->getConfigData('title'));
		$rate->setMethod('airfreight');
		$rate->setMethodTitle('By Air');
		$rate->setPrice($this->getConfigData('price'));
		$rate->setCost(0);
		return $rate;
	}

    public function getAllowedMethods()
    {
        return array(
            'standard' => 'Standard',
			'airfreight' => 'By Air',
        );
    }
	
}
 