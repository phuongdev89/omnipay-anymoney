<?php
/**
 * Created by FES VPN.
 * @project omnipay-anymoney
 * @author  Le Phuong
 * @email   phuong17889[at]gmail.com
 * @date    6/15/2021
 * @time    10:49 AM
 */

namespace Omnipay\AnyMoney;
trait SignTrait {

	/**
	 * @param string $key
	 * @param array  $data
	 * @param string $utc_now
	 *
	 * @return string
	 */
	public function sign(string $key, array $data, string $utc_now): string {
		ksort($data);
		$s = '';
		foreach ($data as $value) {
			if (in_array(gettype($value), [
				'array',
				'object',
				'NULL',
			])) {
				continue;
			}
			if (is_bool($value)) {
				$s .= $value ? "true" : "false";
			} else {
				$s .= $value;
			}
		}
		$s .= $utc_now;
		return hash_hmac('sha512', strtolower($s), $key);
	}
}
