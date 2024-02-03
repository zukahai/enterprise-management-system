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

## 2. Cách trình bày giao diện

### 2.1 Bảng điều khiển
<p align="center"> <img src="/demo/images/dashboard.gif" alt="dashboard" /> </p>
Phần này được thiết kế để xuất hiện ở bên trái của màn hình để tối ưu hóa quản lý và tìm kiếm. Bảng điều khiển được phân chia thành các mục lớn, đại diện cho các nhóm chức năng khác nhau. Mỗi nhóm sẽ chứa các bảng con để dễ dàng quản lý thông tin.

**Bảng điều khiển cho thể thu gọn** để tăng không gian cho cách phần khác.
<p align="center"> <img src="/demo/images/dashboard-2.gif" alt="dashboard" /> </p>

## 3. Chi tiết hệ thống

### 3.1 Đăng nhập hệ thống
<p align="center"> <img src="/demo/images/login.png" alt="login" /> </p>

Người dùng cần đăng nhập hệ thống bằng **"Tên người dùng"** và **"mật khẩu"** được admin cấp. Quá trình đăng nhập này là một phần quan trọng trong việc bảo mật hệ thống và đảm bảo rằng chỉ những người được ủy quyền mới có thể truy cập thông tin và chức năng trong hệ thống. Mật khẩu của người dùng thường được mã hóa trước khi lưu trữ trong cơ sở dữ liệu để ngăn chặn truy cập trái phép.
