<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Message\Concerns;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\OnePay\Support\Signature;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait ResponseSignatureValidation
{
    /**
     * Kiểm tra tính hợp lệ của dữ liệu do OnePay phản hồi.
     *
     * @throws InvalidResponseException
     */
    protected function validateSignature(): void
    {
        $data = $this->getData();

        if (! isset($data['vpc_SecureHash'])) {
            throw new InvalidResponseException('Response from OnePay is invalid!');
        }

        $dataSignature = array_filter($data, function ($parameter) {
            return 0 === strpos($parameter, 'vpc_') && 'vpc_SecureHash' !== $parameter;
        }, ARRAY_FILTER_USE_KEY);
        $signature = new Signature(
            $this->getRequest()->getVpcHashKey()
        );

        if (! $signature->validate($dataSignature, $data['vpc_SecureHash'])) {
            throw new InvalidResponseException(sprintf('Data signature response from OnePay is invalid!'));
        }
    }
}
