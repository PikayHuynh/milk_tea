# 🍵 Milk Tea Shop - Hướng dẫn Sử dụng & Danh sách Endpoints

Dưới đây là tài liệu chi tiết dành cho người vận hành hệ thống Milk Tea Shop.

## 👥 1. Dành cho Người dùng (Khách hàng)

Hệ thống cho phép khách hàng duyệt sản phẩm, quản lý giỏ hàng và đặt hàng trực tuyến.

### 📍 Danh sách Endpoints Client:
| Chức năng | URL (Endpoint) | Mô tả |
| :--- | :--- | :--- |
| **Trang chủ** | `/` | Hiển thị Banner và danh sách trà sữa nổi bật. |
| **Chi tiết món** | `/product-detail?id={id}` | Xem thông tin chi tiết một loại trà sữa. |
| **Giỏ hàng** | `/cart` | Xem danh sách các món đã chọn. |
| **Thêm vào giỏ** | `/cart/add` | (POST) Thêm món vào giỏ hàng. |
| **Cập nhật giỏ** | `/cart/update` | (POST) Thay đổi số lượng món trong giỏ. |
| **Xóa khỏi giỏ** | `/cart/remove` | (GET) Xóa món khỏi giỏ hàng. |
| **Thanh toán** | `/checkout` | Trang điền thông tin giao hàng & xác nhận. |
| **Lịch sử đơn** | `/orders` | Danh sách các đơn hàng đã mua. |
| **Chi tiết đơn** | `/orders/detail?id={id}` | Xem trạng thái và món trong đơn hàng cũ. |
| **Hồ sơ** | `/profile` | Xem và cập nhật thông tin cá nhân. |

---

## 🛡️ 2. Dành cho Quản trị viên (Admin)

Trang quản trị cho phép quản lý toàn bộ hoạt động của cửa hàng. Truy cập mặc định tại: `/admin`.

### 📍 Danh sách Endpoints Admin:
| Nhóm | URL (Endpoint) | Mô tả |
| :--- | :--- | :--- |
| **Dashboard** | `/admin` | Thống kê doanh thu, đơn hàng, biểu đồ. |
| **Sản phẩm** | `/admin/products` | Danh sách tất cả sản phẩm đang bán. |
| | `/admin/add-product` | Form thêm trà sữa mới. |
| | `/admin/edit-product?id={id}` | Form sửa thông tin sản phẩm. |
| **Đơn hàng** | `/admin/orders` | Quản lý danh sách đơn hàng từ khách. |
| | `/admin/show-order?id={id}` | Xem chi tiết đơn hàng khách đặt. |
| | `/admin/update-order-status` | (POST) Cập nhật trạng thái (Duyệt/Giao hàng/Hủy). |
| **Thành viên** | `/admin/users` | Quản lý tài khoản khách hàng và nhân viên. |
| | `/admin/add-user` | Tạo tài khoản mới. |

---

## 🔑 3. Hệ thống Tài khoản (Auth)

| Chức năng | URL (Endpoint) |
| :--- | :--- |
| **Đăng nhập** | `/login` |
| **Đăng ký** | `/register` |
| **Đăng xuất** | `/logout` |

---

## 📖 4. Hướng dẫn Vận hành Nhanh

1.  **Thêm sản phẩm mới**: Vào `Admin` > `Sản phẩm` > `Thêm mới`. Tải ảnh lên và điền giá tiền.
2.  **Xử lý đơn hàng**: Khi có đơn hàng mới, vào `Admin` > `Đơn hàng`. Chọn đơn "Pending", click xem chi tiết và chuyển sang "Processing" hoặc "Completed" sau khi đã giao cho khách.
3.  **Thay đổi Slide/Banner**: Hiện tại ảnh slide được quản lý tĩnh trong code tại `/view/client/template/banner.php`. Để thay đổi, anh chỉ cần thay thế các tệp ảnh `slide-1.png`... trong thư mục `public/client/images/`.

---
*Lưu ý: Luôn đảm bảo đã đăng nhập với quyền Admin để truy cập các đường dẫn bắt đầu bằng `/admin`.*
