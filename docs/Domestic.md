Domestic Gateway
-------------------

Để nắm sơ lược về khái niệm và cách sử dụng các **Omnipay** gateways bạn hãy truy cập vào [đây](https://omnipay.thephpleague.com/) 
để kham khảo.

### Khởi tạo gateway:

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('OnePay_Domestic');
$gateway->initialize([
    'vpc_Merchant' => 'Do OnePay cấp',
    'vpc_AccessCode' => 'Do OnePay cấp',
    'vpc_User' => 'Do OnePay cấp',
    'vpc_Password' => 'Do OnePay cấp',
    'vpc_HashKey' => 'Do OnePay cấp',
]);
```

Gateway khởi tạo ở trên dùng để tạo các yêu cầu xử lý đến OnePay hoặc dùng để nhận yêu cầu do OnePay gửi đến.

### Tạo yêu cầu thanh toán:

```php
$response = $gateway->purchase([
    'AgainLink' => 'https://github.com/phpviet',
    'vpc_MerchTxnRef' => microtime(false),
    'vpc_ReturnURL' => 'https://github.com/phpviet',
    'vpc_TicketNo' => '127.0.0.1',
    'vpc_Amount' => '200000',
    'vpc_OrderInfo' => 456,
])->send();

if ($response->isRedirect()) {
    $redirectUrl = $response->getRedirectUrl();
    
    // TODO: chuyển khách sang trang OnePay để thanh toán
}
```

Kham khảo thêm các tham trị khi tạo yêu cầu và OnePay trả về tại [đây](https://mtf.onepay.vn/developer/resource/documents/docx/quy_trinh_tich_hop-noidia.pdf).

### Kiểm tra thông tin `vpc_ReturnURL` khi khách được OnePay redirect về:

```php
$response = $gateway->completePurchase()->send();

if ($response->isSuccessful()) {
    // TODO: xử lý kết quả và hiển thị.
    print $response->vpc_Amount;
    print $response->vpc_MerchTxnRef;
    
    var_dump($response->getData()); // toàn bộ data do OnePay gửi sang.
    
} else {

    print $response->getMessage();
}
```

Kham khảo thêm các tham trị khi OnePay trả về tại [đây](https://mtf.onepay.vn/developer/resource/documents/docx/quy_trinh_tich_hop-noidia.pdf).

### Kiểm tra thông tin `IPN` do OnePay gửi sang:

```php
$response = $gateway->notification()->send();

if ($response->isSuccessful()) {
    // TODO: xử lý kết quả và hiển thị.
    print $response->vpc_Amount;
    print $response->vpc_MerchTxnRef;
    
    var_dump($response->getData()); // toàn bộ data do OnePay gửi sang.
    
} else {

    print $response->getMessage();
}
```

Kham khảo thêm các tham trị khi OnePay gửi sang tại [đây](https://mtf.onepay.vn/developer/resource/documents/docx/quy_trinh_tich_hop-noidia.pdf).

### Kiểm tra trạng thái giao dịch:

```php
$response = $gateway->queryTransaction([
    'vpc_MerchTxnRef' => '123',
])->send();

if ($response->isSuccessful()) {
    // TODO: xử lý kết quả và hiển thị.

    var_dump($response->getData()); // toàn bộ data do OnePay gửi về.
    
} else {

    print $response->getMessage();
}
```

Kham khảo thêm các tham trị khi tạo yêu cầu và OnePay trả về tại [đây](https://mtf.onepay.vn/developer/resource/documents/docx/quy_trinh_tich_hop-noidia.pdf).

### Phương thức hổ trợ debug:

Một số phương thức chung hổ trợ debug khi `isSuccessful()` trả về `FALSE`:

```php
    print $response->getCode(); // mã báo lỗi do OnePay gửi sang.
    print $response->getMessage(); // câu thông báo lỗi do OnePay gửi sang.
```

Kham khảo bảng báo lỗi `getCode()` chi tiết tại [đây](https://mtf.onepay.vn/developer/resource/documents/docx/quy_trinh_tich_hop-noidia.pdf).
