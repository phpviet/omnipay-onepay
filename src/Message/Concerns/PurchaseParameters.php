<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Message\Concerns;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait PurchaseParameters
{
    /**
     * Trả về đường dẫn thanh toán tại hệ thống của bạn mà khách đã dùng để thanh toán.
     * Nếu không thiết lập hệ thống sẽ tự động lấy đường dẫn của khách truy vấn hệ thống hiện tại, đối với CLI mode sẽ là empty.
     *
     * @return null|string
     */
    public function getAgainLink(): ?string
    {
        return $this->getParameter('AgainLink');
    }

    /**
     * Thiết lập đường dẫn thanh toán tại hệ thống của bạn mà khách đã dùng để thanh toán.
     *
     * @param  string  $link
     * @return $this
     */
    public function setAgainLink(string $link)
    {
        return $this->setParameter('AgainLink', $link);
    }

    /**
     * Trả về tiêu đề hiển thị tại OnePay khi thanh toán.
     *
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->getParameter('Title');
    }

    /**
     * Thiết lập tiêu đề hiển thị tại OnePay khi thanh toán.
     *
     * @param  string  $title
     * @return $this
     */
    public function setTitle(string $title)
    {
        return $this->setParameter('Title', $title);
    }

    /**
     * Phương thức ánh xạ của [[getClientIp()]].
     *
     * @return null|string
     * @see getClientIp
     */
    public function getVpcTicketNo(): ?string
    {
        return $this->getClientIp();
    }

    /**
     * Phương thức ánh xạ của [[setClientIp()]].
     *
     * @param  string  $ticketNo
     * @return $this
     * @see setClientIp
     */
    public function setVpcTicketNo(string $ticketNo)
    {
        return $this->setClientIp($ticketNo);
    }

    /**
     * Trả về IP của khách dùng để thanh toán. Nếu không thiết lập sẽ lấy theo IP client đang truy cập hệ thống, đối với CLI mode thì sẽ là empty.
     *
     * @return null|string
     */
    public function getClientIp(): ?string
    {
        return $this->getParameter('vpc_TicketNo');
    }

    /**
     * Thiết lập IP của khách dùng để thanh toán.
     *
     * @param  string  $value
     * @return $this
     */
    public function setClientIp($value)
    {
        return $this->setParameter('vpc_TicketNo', $value);
    }

    /**
     * Trả về thông tin đơn hàng.
     *
     * @return null|string
     */
    public function getVpcOrderInfo(): ?string
    {
        return $this->getParameter('vpc_OrderInfo');
    }

    /**
     * Thiết lập thông tin đơn hàng.
     *
     * @param  string  $info
     * @return $this
     */
    public function setVpcOrderInfo(string $info)
    {
        return $this->setParameter('vpc_OrderInfo', $info);
    }
}
