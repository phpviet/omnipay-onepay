<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\OnePay\Message\IncomingResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class IncomingResponseTest extends TestCase
{
    public function testConstruct()
    {
        $response = new IncomingResponse($this->getMockRequest(), [
            'example' => 'value',
            'foo' => 'bar',
        ]);

        $this->assertEquals(['example' => 'value', 'foo' => 'bar'], $response->getData());
    }

    public function testIncoming()
    {
        $request = $this->getMockRequest();
        $request->shouldReceive('getVpcHashKey')->once()->andReturn('A3EFDFABA8653DF2342E8DAC29B51AF0');
        $response = new IncomingResponse($request, [
            'vpc_AdditionData' => 970436,
            'vpc_Amount' => 100,
            'vpc_Command' => 'pay',
            'vpc_CurrencyCode' => 'VND',
            'vpc_Locale' => 'vn',
            'vpc_MerchTxnRef' => '201803210919102006754784',
            'vpc_Merchant' => 'ONEPAY',
            'vpc_OrderInfo' => 'JSECURETEST01',
            'vpc_TransactionNo' => '1625746',
            'vpc_TxnResponseCode' => 0,
            'vpc_Version' => 2,
            'vpc_SecureHash' => '0331F9D8E0CD9A6BC581B74721658DFD9A5A219145F92DED700C13E4843BB3B0',
        ]);

        $this->assertFalse($response->isPending());
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals('201803210919102006754784', $response->getTransactionId());
        $this->assertEquals('1625746', $response->getTransactionReference());
        $this->assertEquals('0', $response->getCode());
    }
}
