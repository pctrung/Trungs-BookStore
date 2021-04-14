<?php

// config sidebar navigation option
$documentRoot = 'http://localhost:8080/BookStore-Website';

return [
  'document root' => $documentRoot,
  'navigation' => [
    'admin' => [
      'book' => [
        'title' => 'Sách',
        'name'  => 'book',
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
            'name'  => 'book-kind',
            'icon'  => 'fas fa-swatchbook',
            'link'  => $documentRoot . '/admin/book-kind/index',
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
