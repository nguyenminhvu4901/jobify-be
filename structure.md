```bash
Jobify/
├── app/                                  # Logic nghiệp vụ và kiến trúc ứng dụng chính
│   ├── Adapters                          # Lớp trung gian chuyển đổi dữ liệu giữa hệ thống ngoài và trong
│   ├── Commands/                         # Command CQRS, biểu diễn hành vi hệ thống
│   │   ├── Command.php                   # Lớp command định nghĩa hành vi (Giống DTO, tiền xử lý dữ liệu)
│   │   └── Handler.php                   # Lớp xử lý command (Thực hiện các logic nghiệp vụ chi tiết của từng công việc)
│   ├── Console/                          # Lệnh CLI dùng cho artisan
│   │   └── Commands                      # Các lệnh tùy chỉnh riêng
│   ├── Contracts                         # Interface quy định chuẩn cho service/repository 
│   ├── DataTransferObjects               # Các DTO truyền dữ liệu giữa tầng controller-service-model 
│   ├── Entities/                         # Các thực thể (domain entity), không phụ thuộc DB
│   │   └── Entity/
│   │       ├── Traits/                   # Chứa các trait mở rộng cho entity
│   │       │   ├── Scope                 # Scope truy vấn riêng
│   │       │   ├── Relationship          # Định nghĩa mối quan hệ giữa entity
│   │       │   └── Attribute             # Accessor và mutator
│   │       └── Model                     # Các thực thể dạng entity (không gắn với DB)
│   ├── Enums                             # Enum định nghĩa giá trị cố định (trạng thái, loại)
│   ├── Events                            # Các sự kiện phát sinh (event broadcasting, domain event)
│   ├── Helpers                           # Hàm hỗ trợ dùng chung toàn hệ thống
│   ├── Http/
│   │   ├── Controllers                   # Controller xử lý request và gọi service
│   │   ├── Middleware                    # Lớp trung gian xử lý trước/sau request
│   │   ├── Requests                      # Validate và authorize dữ liệu gửi lên
│   │   └── Resources                     # Định dạng dữ liệu trả về (API Resource)
│   ├── Jobs                              # Các job chạy bất đồng bộ (queue)
│   ├── Mail                              # Mẫu nội dung gửi email
│   ├── Models/
│   │   ├── BaseModel.php                 # Model cha chứa logic dùng chung
│   │   └── User.php                      # Model người dùng gắn với bảng `users`
│   ├── Notifications                     # Gửi thông báo qua mail, DB, Slack, v.v.
│   ├── Observers                         # Theo dõi sự kiện model (created, updated, deleted)
│   ├── Providers                         # Đăng ký service, route, event...
│   ├── Repositories/
│   │   └── BaseRepository.php           # Repository cơ bản với hàm chung: find, all, where
│   ├── Rules                             # Các rule validate custom
│   ├── Services                          # Logic nghiệp vụ chính, xử lý dữ liệu
│   ├── Swaggers                          # Cấu hình mô tả API (OpenAPI/Swagger)
│   └── Traits                            # Các trait tái sử dụng cho nhiều class
├── bootstrap/
│   ├── app.php                           # Khởi tạo Laravel app, gọi đầu tiên bởi index.php
│   └── providers.php                     # (Tùy chỉnh) Load các provider bổ sung
├── config                                # Các file cấu hình hệ thống: DB, mail, queue, v.v.
├── database/
│   ├── factories                         # Factory sinh dữ liệu mẫu khi test/seed
│   ├── migrations                        # File tạo/chỉnh sửa bảng DB
│   └── seeders                           # Dữ liệu mẫu chèn vào DB
├── filesqlProvinceDistrictWard/         # Dữ liệu SQL tỉnh/huyện/xã để import
│   ├── provinces.sql
│   ├── districts.sql
│   └── wards.sql
├── lang/                                 # Đa ngôn ngữ (i18n)
│   ├── vi                                # Giao diện tiếng Việt
│   └── en                                # Giao diện tiếng Anh
├── node_modules                          # Các thư viện frontend dùng qua npm (không commit Git)
├── public/
│   └── index.php                         # Entry-point của ứng dụng (web root)
├── resources/
│   ├── css                               # File CSS tự viết
│   ├── js                                # File JavaScript tự viết
│   └── views                             # Giao diện sử dụng Blade Template
├── routes/
│   ├── api.php                           # Route cho API (RESTful)
│   ├── channels.php                      # Channel cho Laravel Broadcast
│   ├── console.php                       # Route CLI cho artisan
│   └── web.php                           # Route cho giao diện web (view)
├── storage/
│   └── logs                              # File log hệ thống Laravel
├── tests/
│   ├── Browser                           # Test tự động trên trình duyệt (Laravel Dusk)
│   ├── Feature                           # Test chức năng lớn (API, response, permission...)
│   └── Unit                              # Test lớp riêng biệt (service, helper, DTO...)
├── .env.example                          # File mẫu cấu hình môi trường
├── .gitattributes                        # Quy định cách Git xử lý file (như dòng kết thúc)
├── .gitignore                            # Danh sách file/folder không đưa vào Git
├── artisan                               # CLI Laravel dùng để chạy command (migrate, make,...)
├── composer.json                         # Định nghĩa package PHP cần cài
├── composer.lock                         # Ghi version chính xác các package PHP
├── laravel-horizon.conf                  # Cấu hình giám sát queue bằng Horizon
├── laravel-reverb.conf                   # Cấu hình WebSocket với Laravel Reverb
├── laravel-schedule.conf                 # Cấu hình cron job cho scheduler Laravel
├── laravel-worker.conf                   # Cấu hình worker xử lý queue (Supervisor)
├── package.json                          # Định nghĩa package JavaScript cần cài (npm)
├── package-lock.json                     # Ghi version chính xác các package JS
└── vite.config.js                        # Cấu hình build asset frontend bằng Vite

```

