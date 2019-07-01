<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Message\Concerns;

use Omnipay\OnePay\Support\Signature;
use Omnipay\Common\Exception\InvalidResponseException;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait ResponseSignatureValidation
{
    /**
     * Kiểm tra tính hợp lệ của dữ liệu do MoMo phản hồi.
     *
     * @throws InvalidResponseException
     */
    protected function validateSignature(): void
    {
        $data = [];
        $requestParameters = $this->getRequest()->getParameters();
        $signature = new Signature($requestParameters['vpc_HashKey']);

        foreach ($this->getSignatureParameters() as $parameter) {
            $data[$parameter] = $this->data[$parameter];
        }

        if (! $signature->validate($data, $this->data['vpc_SecureHash'])) {
            throw new InvalidResponseException(sprintf('Data signature response from OnePay is invalid!'));
        }
    }

    /**
     * Trả về danh sách các param data đã dùng để tạo chữ ký dữ liệu.
     *
     * @return array
     */
    abstract protected function getSignatureParameters(): array;
}
