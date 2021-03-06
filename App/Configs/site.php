<?php
// Dạ thầy đổi cổng ở đây ạ.
$defaultPort = "8080";

// config sidebar navigation option
$documentRoot =  "http://" . $_SERVER['SERVER_NAME'] . ":$defaultPort/Trung-BookStore";

return [
  'document root' => $documentRoot,
  'navigation' => [
    'admin' => [
      'book' => [
        'title' => 'Sách',
        'name'  => 'books',
        'icon'  => 'fas fa-book',
        'link'  => $documentRoot . '/admin/book/index',
        'subitems' => [
          [
            'title' => 'Quản lý sách',
            'name'  => 'book',
            'icon'  => 'fas fa-book-open',
            'link'  => $documentRoot . '/admin/book/index',
          ],
          [
            'title' => 'Loại sách',
            'name'  => 'bookkind',
            'icon'  => 'fas fa-swatchbook',
            'link'  => $documentRoot . '/admin/bookkind/index',
          ],
        ],
      ],
      'staff' => [
        'title' => 'Nhân viên',
        'name'  => 'staff',
        'icon'  => 'fas fa-user-tie',
        'link'  => $documentRoot . '/admin/staff/index',
      ],
      'customer' => [
        'title' => 'Khách hàng',
        'name'  => 'customer',
        'icon'  => 'fas fa-users',
        'link'  => $documentRoot . '/admin/customer/index',
      ],
      'order' => [
        'title' => 'Đơn hàng',
        'name'  => 'order',
        'icon'  => 'fas fa-file-invoice-dollar',
        'link'  => $documentRoot . '/admin/order/index',
      ],
    ],
  ],
];
