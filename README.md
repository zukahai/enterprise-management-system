# Hệ thống quản lí

## 1. Giới thiệu chung
Dựa vào các bảng cần quản lí thì em đã chia các bảng thành các nhóm, để dễ dàng quản lí hơn. <br>
Các nhóm như sau:

1. **Nhóm "Thông tin cơ bản":**
   - Nhà cung cấp
   - Khách hàng
   - Nhân viên (chỉ cho vai trò 'admin')
   - Ngân hàng

2. **Nhóm "Vật liệu":**
   - Nguyên liệu
   - Thành phẩm
   - Đơn vị

3. **Nhóm "Đặt và giao hàng":**
   - Đơn hàng xuất
   - Đơn hàng nhập
   - Xuất giao hàng
   - Hoá đơn bán hàng
   - Nhập giao hàng

4. **Nhóm "Giao dịch mua bán":**
   - Hoá đơn mua hàng
   - Phiếu chi
   - Phiếu thu

5. **Nhóm "Quản lí thu chi":**
   - Loại thu chi

6. **Nhóm "Quản lí kế toán":**
   - Bảng kê nhập hàng

Người dùng trong hệ thống được chia thành 2 loại chức năng:
- **Admin**: Có thể quản lí tất cả những bảng trên
- **Staff**: Có thể quản lí những bảng trên *trừ bằng "Nhân Viên"*

Tài khoản admin được tạo sẵn, admin sẽ tạo tài khoản và cấp cho nhân viên.
Nếu không có tài khoản, hoàn toàn không thể truy cập được hệ thống.
## 2. Chi tiết hệ thống

### 2.1 Hình ảnh đăng nhập hệ thống
<p align="center"> <img src="/demo/images/login.png" alt="login" /> </p>