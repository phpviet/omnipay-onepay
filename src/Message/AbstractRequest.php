<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Message;

use Omnipay\OnePay\Concerns\Parameters;
use Omnipay\OnePay\Concerns\ParametersNormalization;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    use Parameters;
    use ParametersNormalization;

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        return parent::initialize(
            $this->normalizeParameters($parameters)
        );
    }
}
