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

### 2.1 Chủ đề sáng tối
Người dùng có thể đối chủ đề của giao diện theo sáng hoặc tối tuỳ ý. 
<p align="center"> <img src="/demo/images/theme.gif" alt="theme" /> </p>

### 2.2 Bảng điều khiển
<p align="center"> <img src="/demo/images/dashboard.gif" alt="dashboard" /> </p>
Phần này được thiết kế để xuất hiện ở bên trái của màn hình để tối ưu hóa quản lý và tìm kiếm. Bảng điều khiển được phân chia thành các mục lớn, đại diện cho các nhóm chức năng khác nhau. Mỗi nhóm sẽ chứa các bảng con để dễ dàng quản lý thông tin.

**Bảng điều khiển cho thể thu gọn** để tăng không gian cho cách phần khác.
<p align="center"> <img src="/demo/images/dashboard-2.gif" alt="dashboard" /> </p>

### 2.3 Bảng quản lí

#### 2.3.1 Phân trang

Giao diện quản lí của các bảng chia thành nhiều trang. Để tối ưu hoá không gian làm việc.
<p align="center"> <img src="/demo/images/pagination.gif" alt="pagination" /> </p>
Người dùng có thể tuỳ chỉnh, số lượng dòng hiển thị tối đa trên một trang.

<p align="center"> <img src="/demo/images/pagination-2.gif" alt="pagination" /> </p>

#### 2.3.2 Thao tác thêm sửa xoá

Ở phần bảng quản lí, người dùng có thể thêm mới, chỉnh sửa, xoá và xem chi tiết một dòng dữ liệu nào đó *(Tuỳ thuộc và đó là bảng nào, mà trang xem chi tiết sẽ khác nhau)*

<p align="center"> <img src="/demo/images/crud.gif" alt="crud" /> </p>

#### 2.3.3 Tìm kiếm

Khi người dùng nhập từ khoá tìm kiếm, hệ thống sẽ trả về các dòng có dữ liệu liên quan, dựa trên dữ liệu của tất cả các cột.

<p align="center"> <img src="/demo/images/search.gif" alt="search" /> </p>

#### 2.3.4 Xuất dữ liệu
Hệ thống cho phép người dùng xuất dữ liệu theo các định dạng như pdf, csv,... có thể copy hoặc in trực tiếp *(Cần kết nối đến máy in)*

<p align="center"> <img src="/demo/images/export.gif" alt="export" /> </p>

### 2.4 Các thành phần khác

#### 2.4.1 Thanh tìm kiếm hệ thống

Thanh tìm kiếm này sẽ luôn mặc định ở phía trên của màn hình. Cho phép người dùng tìm kiếm một chức năng, một bảng nào đó trên hệ thông. Người dùng có thể dùng nó để truy cập nhanh tới các bảng mà không cần thao tác trên bảng điều khiển. Đặc biệt là chỗ này em tự viết thuật toán cho phần tìm kiếm này, nó sẽ tìm kiếm dựa trên độ dài của phần giống nhau giữa từ khoá tìm kiếm và các chức năng, nên người dùng không nhất thiết phải nhập chính xác từ khoá cần tìm. Ví dụ khi người dùng nhập "haoa ddno" thì hệ thống vẫn có thể đưa ra những chức năng liên quan đến "Hoá đơn"

<p align="center"> <img src="/demo/images/search-main.gif" alt="search-main" /> </p>

#### 2.4.2 Tin nhắn và thông báo

Biểu tượng thông báo vào bình luận cũng luôn ở góc trên phải, nhắm cho người dùng đễ quan sát và thao tác mọi lúc khi cần.

<p align="center"> <img src="/demo/images/notification.gif" alt="notification" /> </p>

#### 2.4.3 Quản lí tài khoản

Phần này cho phép người dùng thao tác với tài khoản đang đăng nhập, hoặc có thể đăng xuất khỏi hệ thống.

<p align="center"> <img src="/demo/images/account.gif" alt="account" /> </p>


## 3. Chi tiết hệ thống

### 3.1 Đăng nhập hệ thống

<p align="center"> <img src="/demo/images/login.png" alt="login" /> </p>

Người dùng cần đăng nhập hệ thống bằng **"Tên người dùng"** và **"mật khẩu"** được admin cấp. Quá trình đăng nhập này là một phần quan trọng trong việc bảo mật hệ thống và đảm bảo rằng chỉ những người được ủy quyền mới có thể truy cập thông tin và chức năng trong hệ thống. Mật khẩu của người dùng thường được mã hóa trước khi lưu trữ trong cơ sở dữ liệu để ngăn chặn truy cập trái phép.

# **Đang cập nhật thêm...**
