<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Support;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class Signature
{
    /**
     * Khóa bí mật dùng để tạo và kiểm tra chữ ký dữ liệu.
     *
     * @var string
     */
    protected $hashKey;

    /**
     * Khởi tạo đối tượng DataSignature.
     *
     * @param  string  $hashKey
     */
    public function __construct(string $hashKey)
    {
        $this->hashKey = pack('H*', $hashKey);
    }

    /**
     * Trả về chữ ký dữ liệu của dữ liệu truyền vào.
     *
     * @param  array  $data
     * @return string
     */
    public function generate(array $data): string
    {
        ksort($data);
        $dataSign = urldecode(http_build_query($data));

        return strtoupper(hash_hmac('sha256', $dataSign, $this->hashKey));
    }

    /**
     * Kiểm tra tính hợp lệ của chữ ký dữ liệu so với dữ liệu truyền vào.
     *
     * @param  array  $data
     * @param  string  $expect
     * @return bool
     */
    public function validate(array $data, string $expect): bool
    {
        $actual = $this->generate($data);

        return 0 === strcasecmp($expect, $actual);
    }
}
