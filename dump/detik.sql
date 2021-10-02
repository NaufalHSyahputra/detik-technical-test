CREATE TABLE `transactions` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `invoice_id` varchar(255),
  `item_name` varchar(255),
  `amount` int,
  `payment_type` varchar(255),
  `nomor_va` varchar(255),
  `customer_name` varchar(255),
  `merchant_id` int,
  `status` varchar(255) DEFAULT 'pending',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO `transactions` (`invoice_id`,
`item_name`,
`amount`,
`payment_type`,
`nomor_va`,
`customer_name`,
`merchant_id`,
`status`) VALUES (
  '1',
  'Laptop',
  10000000,
  'virtual_account',
  '2141285433',
  'Andi',
  1,
  'pending'
);
-- INSERT INTO `transactions` VALUES (
--   null,
--   '2',
--   'Keyboard',
--   1000000,
--   'credit_card',
--   null,
--   'Budi',
--   1,
--   'paid'
-- );