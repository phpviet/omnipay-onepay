<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Message\International;

use Omnipay\OnePay\Message\AbstractPurchaseRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PurchaseRequest extends AbstractPurchaseRequest
{
    protected $testEndpoint = 'https://mtf.onepay.vn/vpcpay/vpcpay.op';

    protected $productionEndpoint = 'https://onepay.vn/vpcpay/vpcpay.op';
}
