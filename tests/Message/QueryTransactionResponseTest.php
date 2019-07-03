<?php
/**
 * @link https://github.com/phpviet/omnipay-onepay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\OnePay\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\OnePay\Message\QueryTransactionResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class QueryTransactionResponseTest extends TestCase
{
    public function testConstruct()
    {
        $response = new QueryTransactionResponse($this->getMockRequest(), [
            'example' => 'value',
            'foo' => 'bar',
        ]);

        $this->assertEquals(['example' => 'value', 'foo' => 'bar'], $response->getData());
    }

    public function testPurchase()
    {
        $response = new QueryTransactionResponse($this->getMockRequest(), [
            'vpc_MerchTxnRef' => 123,
            'vpc_DRExists' => 'Y',
            'vpc_TxnResponseCode' => 0
        ]);

        $this->assertFalse($response->isPending());
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals('123', $response->getTransactionId());
        $this->assertEquals('123', $response->vpc_MerchTxnRef);
        $this->assertEquals('123', $response->vpcMerchTxnRef);
    }
}
