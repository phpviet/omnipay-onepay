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
        return $this->getParameter('vpc_Merchant');
    }

    /**
     * Thiết lập giá trị merchant id.
     *
     * @param  null|string  $merchant
     * @return $this
     */
    public function setVpcMerchant(?string $merchant)
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
     * @param  null|string  $code
     * @return $this
     */
    public function setVpcAccessCode(?string $code)
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
     * @param  null|string  $key
     * @return $this
     */
    public function setVpcHashKey(?string $key)
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
     * @param  null|string  $user
     * @return $this
     */
    public function setVpcUser(?string $user)
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
     * @param  null|string  $password
     * @return $this
     */
    public function setVpcPassword(?string $password)
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
     * @param  null|string  $version
     * @return $this
     */
    public function setVpcVersion(?string $version)
    {
        return $this->setParameter('vpc_Version', $version);
    }
}
