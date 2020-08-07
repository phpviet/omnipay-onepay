# Changelog

Tất cả lịch sử tiến trình phát triển thư viện

## 1.0.2
- Sửa lỗi sai endpoint (purchase request).

## 1.0.1

- Implement phương thức `isCancelled` ở lớp `\Omnipay\OnePay\Message\Response`.
- Throw exception ở concern `\Omnipay\OnePay\Message\Conerns\ResponseSignatureValidation` khi response không tồn tại chữ ký.
