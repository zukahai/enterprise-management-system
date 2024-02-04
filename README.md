# Hệ thống quản lí

## Mục lục
* [1. Giới thiệu chung](#1-giới-thiệu-chung)
* [2. Cách trình bày giao diện](#2-cách-trình-bày-giao-diện)
  * [2.1 Chủ đề sáng tối](#21-chủ-đề-sáng-tối)
  * [2.2 Bảng Điều Khiển](#22-bảng-điều-khiển)
  * [2.3 Bảng Quản Lí](#23-bảng-quản-lí)
    * [2.3.1 Phân Trang](#231-phân-trang)
    * [2.3.2 Thao Tác Thêm Sửa Xoá](#232-thao-tác-thêm-sửa-xoá)
    * [2.3.3 Tìm Kiếm](#233-tìm-kiếm)
    * [2.3.4 Sắp Xếp](#234-sắp-xếp)
    * [2.3.5 Xuất Dữ Liệu](#235-xuất-dữ-liệu)
  * [2.4 Các Thành Phần Khác](#24-các-thành-phần-khác)
    * [2.4.1 Thanh Tìm Kiếm Hệ Thống](#241-thanh-tìm-kiếm-hệ-thống)
    * [2.4.2 Tin Nhắn và Thông Báo](#242-tin-nhắn-và-thông-báo)
    * [2.4.3 Quản Lí Tài Khoản](#243-quản-lí-tài-khoản)
  * [2.5 Giao diện mobile](#25-giao-diện-mobile)
* [3. Chi Tiết Hệ Thống](#3-chi-tiết-hệ-thống)
  * [3.1 Đăng Nhập Hệ Thống](#31-đăng-nhập-hệ-thống)
  * [3.2 Quản Lí Thông Tin Cơ Bản](#32-quản-lí-thông-tin-cơ-bản)
    * [3.2.1 Quản Lí Khách Hàng](#321-quản-lí-khách-hàng)
      * [3.2.1.1 Danh Sách Khách Hàng](#3211-danh-sách-khách-hàng)
      * [3.2.1.2 Thêm Khách Hàng](#3212-thêm-khách-hàng)
      * [3.2.1.3 Chỉnh Sửa Thông Tin Khách Hàng](#3213-chỉnh-sửa-thông-tin-khách-hàng)
      * [3.2.1.4 Xem Chi Tiết Khách Hàng](#3214-xem-chi-tiết-khách-hàng)
    * [3.2.2 Quản Lí Ngân Hàng](#322-quản-lí-ngân-hàng)
      * [3.2.2.1 Danh Sách Ngân Hàng](#3221-danh-sách-ngân-hàng)
      * [3.2.2.2 Thêm Ngân Hàng](#3222-thêm-ngân-hàng)
      * [3.2.2.3 Chỉnh Sửa Thông Tin Ngân Hàng](#3223-chỉnh-sửa-thông-tin-ngân-hàng)
    * [3.2.3 Quản Lí Nhà Cung Cấp](#323-quản-lí-nhà-cung-cấp)
      * [3.2.3.1 Danh Sách Nhà Cung Cấp](#3231-danh-sách-nhà-cung-cấp)
      * [3.2.3.2 Thêm Nhà Cung Cấp](#3232-thêm-nhà-cung-cấp)
      * [3.2.3.3 Chỉnh Sửa Nhà Cung Cấp](#3233-chỉnh-sửa-nhà-cung-cấp)
      * [3.2.3.4 Chi Tiết Nhà Cung Cấp](#3234-chi-tiết-nhà-cung-cấp)
    * [3.2.4 Quản Lí Nhân Viên](#324-quản-lí-nhân-viên)
      * [3.2.4.1 Danh Sách Nhân Viên](#3241-danh-sách-nhân-viên)
      * [3.2.4.2 Thêm Nhân Viên](#3242-thêm-nhân-viên)
      * [3.2.4.3 Chỉnh Sửa Thông Tin Nhân Viên](#3243-chỉnh-sửa-thông-tin-nhân-viên)
   * [3.3 Quản Lí Vật Liệu](#33-quản-lí-vật-liệu)
      * [3.3.1 Quản Lí Đơn Vị](#331-quản-lí-đơn-vị)
        * [3.3.1.1 Danh Sách Đơn Vị](#3311-danh-sách-đơn-vị)
        * [3.3.1.2 Thêm Đơn Vị](#3312-thêm-đơn-vị)
        * [3.3.1.3 Chỉnh Sửa Thông Tin Đơn Vị](#3313-chỉnh-sửa-thông-tin-đơn-vị)
      * [3.3.2 Quản Lí Nguyên Liệu](#332-quản-lí-nguyên-liệu)
        * [3.3.2.1 Danh Sách Nguyên Liệu](#3321-danh-sách-nguyên-liệu)
        * [3.3.2.2 Thêm Nguyên Liệu](#3322-thêm-nguyên-liệu)
        * [3.3.2.3 Chỉnh Sửa Thông Tin Nguyên Liệu](#3323-chỉnh-sửa-thông-tin-nguyên-liệu)
      * [3.3.3 Quản Lí Thành Phẩm](#333-quản-lí-thành-phẩm)
        * [3.3.3.1 Danh Sách Thành Phẩm](#3331-danh-sách-thành-phẩm)
        * [3.3.3.2 Thêm Thành Phẩm](#3332-thêm-thành-phẩm)
        * [3.3.3.3 Chỉnh Sửa Thông Tin Thành Phẩm](#3333-chỉnh-sửa-thông-tin-thành-phẩm)
    * [3.4 Quản Lí Đặt và Giao Hàng](#34-quản-lí-đặt-và-giao-hàng)
      * [3.4.1 Quản Lí Đơn Hàng Xuất](#341-quản-lí-đơn-hàng-xuất)
        * [3.4.1.1 Danh Sách Đơn Hàng Xuất](#3411-danh-sách-đơn-hàng-xuất)
        * [3.4.1.2 Thêm Đơn Hàng Xuất](#3412-thêm-đơn-hàng-xuất)
        * [3.4.1.3 Chỉnh Sửa Đơn Hàng Xuất](#3413-chỉnh-sửa-đơn-hàng-xuất)
      * [3.4.2 Quản Lí Đơn Hàng Nhập](#342-quản-lí-đơn-hàng-nhập)


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

#### 2.3.4 Sắp xếp

Người dùng có thể sắp xếp tăng / giảm dần dựa vào dữ liệu của từng cột.

<p align="center"> <img src="/demo/images/sort.gif" alt="sort" /> </p>

#### 2.3.5 Xuất dữ liệu
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

### 2.5 Giao diện mobile

Khi người dùng dùng ở giao diện màn hình mobile thì vẫn có thể sử dụng được đầy đủ tính năng của hệ thống. Phần giao diện cơ bản sẽ như sau:

<p align="center"> <img src="/demo/images/mobile.gif" alt="mobile" /> </p>

## 3. Chi tiết hệ thống

### 3.1 Đăng nhập hệ thống

<p align="center"> <img src="/demo/images/login.png" alt="login" /> </p>

Người dùng cần đăng nhập hệ thống bằng **"Tên người dùng"** và **"mật khẩu"** được admin cấp. Quá trình đăng nhập này là một phần quan trọng trong việc bảo mật hệ thống và đảm bảo rằng chỉ những người được ủy quyền mới có thể truy cập thông tin và chức năng trong hệ thống. Mật khẩu của người dùng thường được mã hóa trước khi lưu trữ trong cơ sở dữ liệu để ngăn chặn truy cập trái phép.

### 3.2 Quản lí thông tin cơ bản

#### 3.2.1 Quản lí khách hàng

##### 3.2.1.1 Danh sách khách hàng

<p align="center"> <img src="/demo/images/list-customer.png" alt="list-customer" /> </p>

##### 3.2.1.2 Thêm khách hàng

<p align="center"> <img src="/demo/images/add-customer.png" alt="add-customer" /> </p>

##### 3.2.1.3 Chỉnh sửa thông tin khách hàng

<p align="center"> <img src="/demo/images/edit-customer.png" alt="edit-customer" /> </p>

##### 3.2.1.4 Xem chi tiết khách hàng
Khi xem thông tin chỉ tiết khách hàng, hệ thống sẽ trả về thôn tin của khách hàng đó, người dùng có thể chỉnh sửa hoặc xoá khách hàng tại đây. Bên cạnh đó người dùng có thể xem được tất cả những đơn hàng mà khách hàng này đã đặt hàng (Đơn hàng xuất)

<p align="center"> <img src="/demo/images/detail-customer.gif" alt="detail-customer" /> </p>

#### 3.2.2 Quản lí ngân hàng

##### 3.2.2.1 Danh sách ngân hàng

Hệ thống được thêm sẵn 63 ngân hàng của Việt Nam, người dùng có thể chỉnh sửa hoặc xoá nếu không cần thiết.

<p align="center"> <img src="/demo/images/bank.gif" alt="bank" /> </p>

##### 3.2.2.2 Thêm ngân hàng

<p align="center"> <img src="/demo/images/add-bank.png" alt="add-bank" /> </p>

##### 3.2.2.3 Chỉnh sửa thông tin ngân hàng

<p align="center"> <img src="/demo/images/edit-bank.png" alt="edit-bank" /> </p>

#### 3.2.3 Quản lí nhà cung cấp

##### 3.2.3.1 Danh sách nhà cung cấp

<p align="center"> <img src="/demo/images/supplier.png" alt="supplier" /> </p>

##### 3.2.3.2 Thêm nhà cung cấp

Khi thêm nhà cung cấp, người dùng cần chọn ngân hàng của nhà cung cấp đó *(Được lấy bên bảng ngân hàng)*. Người dùng có thể **tìm kiếm thông tin ngân hàng** để lọc ra những ngần hàng theo từ khoá, dễ dàng chọn ngân hàng hơn

<p align="center"> <img src="/demo/images/add-supplier.gif" alt="add-supplier" /> </p>

##### 3.2.3.3 Chỉnh sửa nhà cung cấp

<p align="center"> <img src="/demo/images/edit-supplier.png" alt="edit-supplier" /> </p>

##### 3.2.3.4 Chi tiết nhà cung cấp

Khi xem thông tin nhà cung cấp, hệ thống sẽ trả về giao diện gồm các thông tin, người dùng có thể chỉnh sửa hoặc xoá tại đây. Bên cạnh đó thì hệ thông cũng tạo ra mà QR code từ thông tin ngân hàng của nhà cung cấp, giúp người dùng có thể thao tác thanh toán nhanh hơn.

<p align="center"> <img src="/demo/images/detail-supplier.gif" alt="detail-supplier" /> </p>

#### 3.2.4 Quản lí nhân viên

##### 3.2.4.1 Danh sách nhân viên

Chỉ tài khoản của admin mới có thể quản lí phần này, tài khoản của nhân viên không thể truy cập bất kì chức năng nào trong phần này.

<p align="center"> <img src="/demo/images/staff.png" alt="staff" /> </p>

##### 3.2.4.2 Thêm nhân viên

<p align="center"> <img src="/demo/images/add-staff.png" alt="add-staff" /> </p>

##### 3.2.4.3 Chỉnh sửa thông tin nhân viên

<p align="center"> <img src="/demo/images/edit-staff.png" alt="edit-staff" /> </p>

### 3.3 Quản lí vật liệu

#### 3.3.1 Quản lí đơn vị

##### 3.3.1.1 Danh sách đơn vị

<p align="center"> <img src="/demo/images/unit.png" alt="unit" /> </p>

##### 3.3.1.2 Thêm đơn vị

<p align="center"> <img src="/demo/images/add-unit.png" alt="add-unit" /> </p>

##### 3.3.1.3 Chỉnh sửa thông tin đơn vị

<p align="center"> <img src="/demo/images/edit-unit.png" alt="edit-unit" /> </p>

#### 3.3.2 Quản lí nguyên liệu

##### 3.3.2.1 Danh sách nguyên liệu

<p align="center"> <img src="/demo/images/ingredient.png" alt="ingredient" /> </p>

##### 3.3.2.2 Thêm nguyên liệu

<p align="center"> <img src="/demo/images/add-ingredient.png" alt="add-ingredient" /> </p>

##### 3.3.2.3 Chỉnh sửa thông tin nguyên liệu

<p align="center"> <img src="/demo/images/edit-ingredient.png" alt="edit-ingredient" /> </p>

#### 3.3.3 Quản lí thành phẩm

##### 3.3.3.1 Danh sách thành phẩm

<p align="center"> <img src="/demo/images/finished-product.png" alt="finished-product" /> </p>

##### 3.3.3.2 Thêm thành phẩm

<p align="center"> <img src="/demo/images/add-finished-product.png" alt="add-finished-product" /> </p>

##### 3.3.3.3 Chỉnh sửa thông tin thành phẩm

<p align="center"> <img src="/demo/images/edit-finished-product.png" alt="edit-finished-product" /> </p>

### 3.4 Quản lí đặt và giao hàng

#### 3.4.1 Quản lí đơn hàng xuất

##### 3.4.1.1 Danh sách đơn hàng xuất

<p align="center"> <img src="/demo/images/export-order.png" alt="export-order" /> </p>

Người dùng có thể truy cập đến khách hàng, thành phẩm hoặc đơn vị từ bảng này. (Bất cứ thông tin nào lấy từ bảng khác cũng có thể truy cập tại bảng hiện tại)

##### 3.4.1.2 Thêm đơn hàng xuất

<p align="center"> <img src="/demo/images/add-export-order.gif" alt="add-export-order" /> </p>

Để thêm 1 đơn hàng xuất, người dùng cần chọn khách hàng. Tiếp theo chọn các sản phẩm mà khách hàng đó đặt (Bấm vào biểu tưởng nút "+" để chọn thêm 1 sản phẩm)

Số phiếu va mã nội bộ sẽ được hệ thống tạo ra tự động

##### 3.4.1.3 Chỉnh sửa đơn hàng xuất

<p align="center"> <img src="/demo/images/eidt-export-order.png" alt="eidt-export-order" /> </p>

#### 3.4.2 Quản lí đơn hàng nhập

# Sẽ cập nhập thêm ....
