<?php
/**
 * Created by FES VPN.
 * @project omnipay-anymoney
 * @author  Le Phuong
 * @email   phuong17889[at]gmail.com
 * @date    6/15/2021
 * @time    3:08 PM
 */

namespace Omnipay\AnyMoney\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\ResponseInterface;

class InvoiceRequest extends AbstractRequest {

	public $method;

	/**
	 * @param string|null $value
	 *
	 * @return InvoiceRequest
	 */
	public function setAmount($value) {
		return parent::setAmount($value);
	}

	/**
	 * @return string
	 * @throws InvalidRequestException
	 */
	public function getAmount() {
		return parent::getAmount();
	}

	/**
	 * @param $value
	 *
	 * @return InvoiceRequest
	 */
	public function setCallbackUrl($value) {
		return $this->setParameter('callback_url', $value);
	}

	/**
	 * @return mixed
	 */
	public function getCallbackUrl() {
		return $this->getParameter('callback_url');
	}

	/**
	 * @param $value
	 *
	 * @return InvoiceRequest
	 */
	public function setClientEmail($value) {
		return $this->setParameter('client_email', $value);
	}

	/**
	 * @return mixed
	 */
	public function getClientEmail() {
		return $this->getParameter('client_email');
	}

	/**
	 * @param $value
	 *
	 * @return InvoiceRequest
	 */
	public function setExternalId($value) {
		return $this->setParameter('externalid', $value);
	}

	/**
	 * @return mixed
	 */
	public function getExternalId() {
		return $this->getParameter('externalid');
	}

	/**
	 * @param $value
	 *
	 * @return InvoiceRequest
	 */
	public function setInCurr($value) {
		return $this->setParameter('in_curr', $value);
	}

	/**
	 * @return mixed
	 */
	public function getInCurr() {
		return $this->getParameter('in_curr');
	}

	/**
	 * @param $value
	 *
	 * @return InvoiceRequest
	 */
	public function setIsMultiPay($value) {
		return $this->setParameter('is_multipay', $value);
	}

	/**
	 * @return mixed
	 */
	public function getIsMultiPay() {
		return $this->getParameter('is_multipay');
	}

	/**
	 * @param $value
	 *
	 * @return InvoiceRequest
	 */
	public function setLifetime($value) {
		return $this->setParameter('lifetime', $value);
	}

	/**
	 * @return mixed
	 */
	public function getLifetime() {
		return $this->getParameter('lifetime');
	}

	/**
	 * @param $value
	 *
	 * @return InvoiceRequest
	 */
	public function setMerchantPayFee($value) {
		return $this->setParameter('merchant_payfee', $value);
	}

	/**
	 * @return mixed
	 */
	public function getMerchantPayFee() {
		return $this->getParameter('merchant_payfee');
	}

	/**
	 * @param $value
	 *
	 * @return InvoiceRequest
	 */
	public function setOutCurr($value) {
		return $this->setParameter('out_curr', $value);
	}

	/**
	 * @return mixed
	 */
	public function getOutCurr() {
		return $this->getParameter('out_curr');
	}

	/**
	 * @param $value
	 *
	 * @return InvoiceRequest
	 */
	public function setPayWay($value) {
		return $this->setParameter('payway', $value);
	}

	/**
	 * @return mixed
	 */
	public function getPayWay() {
		return $this->getParameter('payway');
	}

	/**
	 * @param $value
	 *
	 * @return InvoiceRequest
	 */
	public function setRedirectUrl($value) {
		return $this->setParameter('redirect_url', $value);
	}

	/**
	 * @return mixed
	 */
	public function getRedirectUrl() {
		return $this->getParameter('redirect_url');
	}

	/**
	 * @param $value
	 *
	 * @return InvoiceRequest
	 */
	public function setComment($value) {
		return $this->setParameter('comment', $value);
	}

	/**
	 * @return mixed
	 */
	public function getComment() {
		return $this->getParameter('comment');
	}

	/**
	 * @return array
	 * @throws InvalidRequestException
	 */
	public function getData() {
		switch ($this->method) {
			case 'invoice.create':
				return [
					'amount'          => $this->getAmount(),
					'callback_url'    => $this->getCallbackUrl(),
					'client_email'    => $this->getClientEmail(),
					'externalid'      => $this->getExternalId(),
					'in_curr'         => $this->getInCurr(),
					'is_multipay'     => $this->getIsMultiPay(),
					'lifetime'        => $this->getLifetime(),
					'merchant_payfee' => $this->getMerchantPayFee(),
					'out_curr'        => $this->getOutCurr(),
					'payway'          => $this->getPayWay(),
					'redirect_url'    => $this->getRedirectUrl(),
					'comment'         => $this->getComment(),
				];
			case 'invoice.calc':
				return [
					'amount'  => $this->getAmount(),
					'in_curr' => $this->getInCurr(),
					'payway'  => $this->getPayWay(),
				];
			default:
			case 'invoice.get':
				return [
					'externalid' => $this->getExternalId(),
				];
		}
	}

	/**
	 * @return ResponseInterface
	 * @throws InvalidRequestException
	 */
	public function create() {
		$this->validate('amount', 'externalid', 'in_curr');
		$this->method = 'invoice.create';
		return $this->send();
	}

	/**
	 * @return ResponseInterface
	 * @throws InvalidRequestException
	 */
	public function calc() {
		$this->validate('amount', 'in_curr');
		$this->method = 'invoice.calc';
		return $this->send();
	}

	/**
	 * @return ResponseInterface
	 * @throws InvalidRequestException
	 */
	public function get() {
		$this->validate('externalid');
		$this->method = 'invoice.get';
		return $this->send();
	}

	/**
	 * @param mixed $data
	 *
	 * @return InvoiceResponse
	 */
	public function sendData($data) {
		$response         = new InvoiceResponse($this, json_decode($this->curl($this->request($this->method, $data)), true));
		$response->method = $this->method;
		return $response;
	}
}
