/*
    On update/On delete 操作：
      ON DELETE/UPDATE CASCADE: 级联，删除/更新父表的某条记录，子表中引用该值的记录会自动被删除/更新
      RESTRICT: 如果子表中有匹配的记录,则不允许对父表对应候选键进行update/delete操作
      NO ACTION: 如果子表中有匹配的记录,则不允许对父表对应候选键进行update/delete操作
      SET NULL: 在父表上update/delete记录时，将子表上匹配记录的列设为null 要注意子表的外键列不能为not null
 */
/*

 */
CREATE TABLE `customers`
(
  `id`       int(11)        NOT NULL AUTO_INCREMENT,
  `name`     varchar(100)   NOT NULL,
  `email`    varchar(100)   NOT NULL,
  `phone`    varchar(15)    NOT NULL,
  `address`  text           NOT NULL,
  `created`  datetime       NOT NULL,
  `modified` datetime       NOT NULL,
  `status`   enum ('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

CREATE TABLE `products`
(
  `id`          int(11)        NOT NULL AUTO_INCREMENT,
  `name`        varchar(200)   NOT NULL,
  `description` text           NOT NULL,
  `price`       float(10, 2)   NOT NULL,
  `created`     datetime       NOT NULL,
  `modified`    datetime       NOT NULL,
  `status`      enum ('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

CREATE TABLE `orders`
(
  `id`          int(11)        NOT NULL AUTO_INCREMENT,
  `customer_id` int(11)        NOT NULL,
  `total_price` float(10, 2)   NOT NULL,
  `created`     datetime       NOT NULL,
  `modified`    datetime       NOT NULL,
  `status`      enum ('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
)

Create table order_items
(
  `id`         int(11) NOT NULL AUTO_INCREMENT,
  `order_id`   int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity`   int(11) NOT NULL,
  PRIMARY KEY (`id`),
  Key `order_id` (`order_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
);