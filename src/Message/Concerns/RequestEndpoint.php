<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Message\Concerns;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait RequestEndpoint
{
    /**
     * @var string
     */
    protected $productionEndpoint;

    /**
     * @var string
     */
    protected $testEndpoint;

    /**
     * Trả về url kết nối OnePay.
     *
     * @return string
     */
    protected function getEndpoint(): string
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->productionEndpoint;
    }
}
