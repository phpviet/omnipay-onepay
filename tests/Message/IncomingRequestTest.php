<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\OnePay\Message\IncomingRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class IncomingRequestTest extends TestCase
{
    /**
     * @var IncomingRequest
     */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $request->query->replace([
            'vpc_AdditionData' => 1,
            'vpc_Amount' => 2,
            'vpc_Command' => 3,
            'vpc_CurrencyCode' => 4,
            'vpc_Locale' => 5,
            'vpc_MerchTxnRef' => 6,
            'vpc_Merchant' => 7,
            'vpc_OrderInfo' => 8,
            'vpc_TransactionNo' => 9,
            'vpc_TxnResponseCode' => 10,
            'vpc_Version' => 11,
            'vpc_SecureHash' => 12
        ]);
        $this->request = new IncomingRequest($client, $request);
    }

    public function testIncoming()
    {
        $data = $this->request->getData();
        $this->assertEquals(12, count($data));
        $this->assertEquals(1, $data['vpc_AdditionData']);
        $this->assertEquals(2, $data['vpc_Amount']);
        $this->assertEquals(3, $data['vpc_Command']);
        $this->assertEquals(4, $data['vpc_CurrencyCode']);
        $this->assertEquals(5, $data['vpc_Locale']);
        $this->assertEquals(6, $data['vpc_MerchTxnRef']);
        $this->assertEquals(7, $data['vpc_Merchant']);
        $this->assertEquals(8, $data['vpc_OrderInfo']);
        $this->assertEquals(9, $data['vpc_TransactionNo']);
        $this->assertEquals(10, $data['vpc_TxnResponseCode']);
        $this->assertEquals(11, $data['vpc_Version']);
        $this->assertEquals(12, $data['vpc_SecureHash']);

    }
}
