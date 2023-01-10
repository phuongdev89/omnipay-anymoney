<?php
/**
 * @project omnipay-anymoney
 * @author  Phuong Dev
 * @email   phuongdev89@gmail.com
 * @date    6/15/2021
 * @time    10:49 AM
 */

namespace Omnipay\AnyMoney;

use Omnipay\AnyMoney\Message\BalanceRequest;
use Omnipay\AnyMoney\Message\InvoiceRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * @method NotificationInterface acceptNotification(array $options = array())
 * @method RequestInterface authorize(array $options = array())
 * @method RequestInterface completeAuthorize(array $options = array())
 * @method RequestInterface capture(array $options = array())
 * @method RequestInterface purchase(array $options = array())
 * @method RequestInterface completePurchase(array $options = array())
 * @method RequestInterface refund(array $options = array())
 * @method RequestInterface fetchTransaction(array $options = [])
 * @method RequestInterface void(array $options = array())
 * @method RequestInterface createCard(array $options = array())
 * @method RequestInterface updateCard(array $options = array())
 * @method RequestInterface deleteCard(array $options = array())
 */
class Gateway extends AbstractGateway {

	const NAME = 'AnyMoney';

	/**
	 * @inheritdoc
	 */
	public function getName() {
		return self::NAME;
	}

	/**
	 * @inheritdoc
	 */
	public function getDefaultParameters() {
		return [
			'endpoint' => 'https://api.any.money',
			'merchant' => '',
			'api_key'  => '',
		];
	}

	/**
	 * Get gate base URL.
	 *
	 * @return string
	 */
	public function getEndpoint() {
		return $this->getParameter('endpoint');
	}

	/**
	 * Set gate base URL.
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function setEndpoint($value) {
		return $this->setParameter('endpoint', rtrim($value, '/'));
	}

	/**
	 * Get merchant ID.
	 *
	 * @return string
	 */
	public function getMerchant() {
		return $this->getParameter('merchant');
	}

	/**
	 * Set merchant ID.
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function setMerchant($value) {
		return $this->setParameter('merchant', $value);
	}

	/**
	 * Get API private key.
	 *
	 * @return string
	 */
	public function getApiKey() {
		return $this->getParameter('api_key');
	}

	/**
	 * Set API private key.
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function setApiKey($value) {
		return $this->setParameter('api_key', $value);
	}

	/**
	 * @param $parameters
	 *
	 * @return AbstractRequest|BalanceRequest
	 */
	public function balance($parameters) {
		$parameters['endpoint'] = $this->getEndpoint();
		$parameters['merchant'] = $this->getMerchant();
		$parameters['api_key']  = $this->getApiKey();
		return $this->createRequest(BalanceRequest::class, $parameters);
	}

	/**
	 * @param $parameters
	 *
	 * @return AbstractRequest|InvoiceRequest
	 */
	public function invoice($parameters) {
		$parameters['endpoint'] = $this->getEndpoint();
		$parameters['merchant'] = $this->getMerchant();
		$parameters['api_key']  = $this->getApiKey();
		return $this->createRequest(InvoiceRequest::class, $parameters);
	}
}
