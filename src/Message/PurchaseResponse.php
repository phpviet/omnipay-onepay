<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectUrl(): string
    {
        return $this->data['redirect_url'];
    }

    /**
     * {@inheritdoc}
     */
    public function isRedirect(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getTransactionId(): string
    {
        return $this->data['vpc_MerchTxnRef'];
    }
}
