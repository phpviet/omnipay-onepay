<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Message\Domestic;

use Omnipay\OnePay\Message\AbstractSignatureRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PurchaseRequest extends AbstractSignatureRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        $signatureParameters = [];

        foreach ($this->getParameters() as $parameter => $value) {
            if (0 === strpos($parameter, 'vpc_')) {
                $signatureParameters[$parameter] = $value;
            }
        }

        return $signatureParameters;
    }


}
