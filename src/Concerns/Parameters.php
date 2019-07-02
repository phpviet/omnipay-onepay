<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Concerns;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait Parameters
{
    /**
     * Trả về giá trị merchant id do OnePay cấp.
     *
     * @return null|string
     */
    public function getVpcMerchant(): ?string
    {
        $this->getParameter('vpc_Merchant');
    }

    /**
     * Thiết lập giá trị merchant id.
     *
     * @param  string  $merchant
     * @return $this
     */
    public function setVpcMerchant(string $merchant)
    {
        return $this->setParameter('vpc_Merchant', $merchant);
    }

    /**
     * Trả về giá trị access code do OnePay cấp.
     *
     * @return null|string
     */
    public function getVpcAccessCode(): ?string
    {
        return $this->getParameter('vpc_AccessCode');
    }

    /**
     * Thiết lập giá trị access code.
     *
     * @param  string  $code
     * @return $this
     */
    public function setVpcAccessCode(string $code)
    {
        return $this->setParameter('vpc_AccessCode', $code);
    }

    /**
     * Trả về giá trị hash key do OnePay cấp.
     *
     * @return null|string
     */
    public function getVpcHashKey(): ?string
    {
        return $this->getParameter('vpc_HashKey');
    }

    /**
     * Thiết lập giá trị hash key dùng để tạo chữ ký dữ liệu (secure hash).
     *
     * @param  string  $key
     * @return $this
     */
    public function setVpcHashKey(string $key)
    {
        return $this->setParameter('vpc_HashKey', $key);
    }

    /**
     * Trả về giá trị user do OnePay cấp.
     *
     * @return null|string
     */
    public function getVpcUser(): ?string
    {
        return $this->getParameter('vpc_User');
    }

    /**
     * Thiết lập giá trị user.
     *
     * @param  string  $user
     * @return $this
     */
    public function setVpcUser(string $user)
    {
        return $this->setParameter('vpc_User', $user);
    }

    /**
     * Trả về giá trị password do OnePay cấp.
     *
     * @return null|string
     */
    public function getVpcPassword(): ?string
    {
        return $this->getParameter('vpc_Password');
    }

    /**
     * Thiết lập giá trị password.
     *
     * @param  string  $password
     * @return $this
     */
    public function setVpcPassword(string $password)
    {
        return $this->setParameter('vpc_Password', $password);
    }

    /**
     * Trả về giá trị version hiện tại.
     *
     * @return null|string
     */
    public function getVpcVersion(): ?string
    {
        return $this->getParameter('vpc_Version');
    }

    /**
     * Thiết lập giá trị version muốn sử dụng.
     *
     * @param  string  $version
     * @return $this
     */
    public function setVpcVersion(string $version)
    {
        return $this->setParameter('vpc_Version', $version);
    }

    /**
     * Trả về đơn vị tiền tệ sử dụng thanh toán của khách.
     *
     * @return null|string
     */
    public function getVpcCurrency(): ?string
    {
        return $this->getCurrency();
    }

    /**
     * Thiết lập đơn vị tiền tệ sử dụng thanh toán của khách.
     *
     * @param  string  $currency
     * @return $this
     */
    public function setVpcCurrency(string $currency)
    {
        return $this->setCurrency($currency);
    }

    /**
     * Trả giao diện ngôn ngữ khách dùng để thanh toán.
     *
     * @return null|string
     */
    public function getVpcLocale(): ?string
    {
        return $this->getParameter('vpc_Locale');
    }

    /**
     * Thiết lập giao diện ngôn ngữ khách dùng để thanh toán.
     *
     * @param  string  $locale
     * @return $this
     */
    public function setVpcLocale(string $locale)
    {
        return $this->setParameter('vpc_Locale', $locale);
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrency(): ?string
    {
        return ($currency = $this->getParameter('vpc_Currency')) ? strtoupper($currency) : null;
    }

    /**
     * {@inheritdoc}
     */
    public function setCurrency($value)
    {
        return $this->setParameter('vpc_Currency', $value);
    }
}
