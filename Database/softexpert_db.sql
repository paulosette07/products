/*
 Navicat Premium Data Transfer

 Source Server         : PostgresLocal
 Source Server Type    : PostgreSQL
 Source Server Version : 90400
 Source Host           : localhost:5432
 Source Catalog        : softexpert_db
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 90400
 File Encoding         : 65001

 Date: 20/09/2020 20:05:59
*/


-- ----------------------------
-- Sequence structure for client_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."client_id_seq";
CREATE SEQUENCE "public"."client_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for product_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."product_id_seq";
CREATE SEQUENCE "public"."product_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for product_type_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."product_type_id_seq";
CREATE SEQUENCE "public"."product_type_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for sale_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sale_id_seq";
CREATE SEQUENCE "public"."sale_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for sale_product_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sale_product_id_seq";
CREATE SEQUENCE "public"."sale_product_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for sys_user_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sys_user_id_seq";
CREATE SEQUENCE "public"."sys_user_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Table structure for client
-- ----------------------------
DROP TABLE IF EXISTS "public"."client";
CREATE TABLE "public"."client" (
  "id" int4 NOT NULL DEFAULT nextval('client_id_seq'::regclass),
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "cpf" varchar(45) COLLATE "pg_catalog"."default",
  "phone" varchar(45) COLLATE "pg_catalog"."default",
  "birthday" date,
  "insert_dt" timestamp(6),
  "update_dt" timestamp(6)
)
;

-- ----------------------------
-- Records of client
-- ----------------------------
INSERT INTO "public"."client" VALUES (13, 'John Doe', NULL, NULL, NULL, '2020-09-19 12:32:45', '2020-09-20 23:02:16');
INSERT INTO "public"."client" VALUES (1, 'Paulo', '77777777777', '47999999999', '1984-01-21', '2020-09-17 22:36:21', '2020-09-20 23:03:44');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS "public"."product";
CREATE TABLE "public"."product" (
  "id" int4 NOT NULL DEFAULT nextval('product_id_seq'::regclass),
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "note" text COLLATE "pg_catalog"."default",
  "price" numeric(10,2) NOT NULL,
  "product_type_id" int4 NOT NULL,
  "insert_dt" timestamp(6),
  "update_dt" timestamp(6)
)
;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO "public"."product" VALUES (1, 'Notebook I5', 'Notebook com I5, 4gb de memória, HD de 1TB', 2500.00, 2, '2020-09-19 12:19:52', NULL);
INSERT INTO "public"."product" VALUES (2, 'TV 40"', 'TV OLED', 3000.00, 1, '2020-09-19 12:21:33', '2020-09-19 12:22:17');
INSERT INTO "public"."product" VALUES (3, 'Tablet 7"', NULL, 1000.00, 2, '2020-09-19 12:22:42', NULL);
INSERT INTO "public"."product" VALUES (4, 'Mouse sem fio', NULL, 50.00, 2, '2020-09-19 12:22:57', NULL);
INSERT INTO "public"."product" VALUES (5, 'Mouse GAMER', NULL, 80.00, 2, '2020-09-19 12:23:14', NULL);
INSERT INTO "public"."product" VALUES (6, 'Pipoqueira Elétrica', NULL, 100.00, 1, '2020-09-19 12:23:34', NULL);
INSERT INTO "public"."product" VALUES (7, 'Soundbar', NULL, 200.00, 1, '2020-09-19 12:37:57', NULL);

-- ----------------------------
-- Table structure for product_type
-- ----------------------------
DROP TABLE IF EXISTS "public"."product_type";
CREATE TABLE "public"."product_type" (
  "id" int4 NOT NULL DEFAULT nextval('product_type_id_seq'::regclass),
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "note" text COLLATE "pg_catalog"."default",
  "tax" float4 NOT NULL,
  "insert_dt" timestamp(6),
  "update_dt" timestamp(6)
)
;

-- ----------------------------
-- Records of product_type
-- ----------------------------
INSERT INTO "public"."product_type" VALUES (2, 'Informática', 'Info', 15, '2020-09-18 23:08:28', NULL);
INSERT INTO "public"."product_type" VALUES (1, 'Eletrônico', 'Elet', 11, '2020-09-18 23:02:53', '2020-09-19 12:41:13');

-- ----------------------------
-- Table structure for sale
-- ----------------------------
DROP TABLE IF EXISTS "public"."sale";
CREATE TABLE "public"."sale" (
  "id" int4 NOT NULL DEFAULT nextval('sale_id_seq'::regclass),
  "date" date NOT NULL,
  "total_price" numeric(10,2) NOT NULL,
  "total_tax" numeric(10,2) NOT NULL,
  "note" text COLLATE "pg_catalog"."default",
  "status" int4 DEFAULT 1,
  "client_id" int4 NOT NULL,
  "insert_dt" timestamp(6),
  "update_dt" timestamp(6)
)
;

-- ----------------------------
-- Records of sale
-- ----------------------------
INSERT INTO "public"."sale" VALUES (17, '2020-09-20', 3200.00, 352.00, NULL, 2, 13, '2020-09-20 02:18:12', '2020-09-20 22:57:45');
INSERT INTO "public"."sale" VALUES (16, '2020-09-20', 3600.00, 540.00, NULL, 1, 1, '2020-09-20 00:07:08', '2020-09-20 23:04:08');

-- ----------------------------
-- Table structure for sale_product
-- ----------------------------
DROP TABLE IF EXISTS "public"."sale_product";
CREATE TABLE "public"."sale_product" (
  "id" int4 NOT NULL DEFAULT nextval('sale_product_id_seq'::regclass),
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "amount" int4 NOT NULL,
  "price" numeric(10,2) NOT NULL,
  "tax" numeric(10,2) NOT NULL,
  "product_id" int4 NOT NULL,
  "sale_id" int4 NOT NULL
)
;

-- ----------------------------
-- Records of sale_product
-- ----------------------------
INSERT INTO "public"."sale_product" VALUES (29, 'Pipoqueira Elétrica', 2, 100.00, 11.00, 6, 17);
INSERT INTO "public"."sale_product" VALUES (30, 'TV 40', 1, 3000.00, 11.00, 2, 17);
INSERT INTO "public"."sale_product" VALUES (31, 'Tablet 7', 1, 1000.00, 15.00, 3, 16);
INSERT INTO "public"."sale_product" VALUES (32, 'Notebook I5', 1, 2500.00, 15.00, 1, 16);
INSERT INTO "public"."sale_product" VALUES (33, 'Mouse sem fio', 2, 50.00, 15.00, 4, 16);

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
DROP TABLE IF EXISTS "public"."sys_user";
CREATE TABLE "public"."sys_user" (
  "id" int4 NOT NULL DEFAULT nextval('sys_user_id_seq'::regclass),
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "email" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "password" varchar(64) COLLATE "pg_catalog"."default" NOT NULL,
  "status" int4 DEFAULT 1,
  "insert_dt" timestamp(6),
  "update_dt" timestamp(6)
)
;

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO "public"."sys_user" VALUES (1, 'Administrator', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 1, NULL, NULL);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."client_id_seq"
OWNED BY "public"."client"."id";
SELECT setval('"public"."client_id_seq"', 14, true);
ALTER SEQUENCE "public"."product_id_seq"
OWNED BY "public"."product"."id";
SELECT setval('"public"."product_id_seq"', 8, true);
ALTER SEQUENCE "public"."product_type_id_seq"
OWNED BY "public"."product_type"."id";
SELECT setval('"public"."product_type_id_seq"', 5, true);
ALTER SEQUENCE "public"."sale_id_seq"
OWNED BY "public"."sale"."id";
SELECT setval('"public"."sale_id_seq"', 18, true);
ALTER SEQUENCE "public"."sale_product_id_seq"
OWNED BY "public"."sale_product"."id";
SELECT setval('"public"."sale_product_id_seq"', 34, true);
ALTER SEQUENCE "public"."sys_user_id_seq"
OWNED BY "public"."sys_user"."id";
SELECT setval('"public"."sys_user_id_seq"', 2, true);

-- ----------------------------
-- Primary Key structure for table client
-- ----------------------------
ALTER TABLE "public"."client" ADD CONSTRAINT "client_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table product
-- ----------------------------
ALTER TABLE "public"."product" ADD CONSTRAINT "product_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table product_type
-- ----------------------------
ALTER TABLE "public"."product_type" ADD CONSTRAINT "product_type_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sale
-- ----------------------------
ALTER TABLE "public"."sale" ADD CONSTRAINT "sale_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sale_product
-- ----------------------------
ALTER TABLE "public"."sale_product" ADD CONSTRAINT "sale_product_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sys_user
-- ----------------------------
ALTER TABLE "public"."sys_user" ADD CONSTRAINT "sys_user_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Foreign Keys structure for table product
-- ----------------------------
ALTER TABLE "public"."product" ADD CONSTRAINT "product_product_type_id_fkey" FOREIGN KEY ("product_type_id") REFERENCES "public"."product_type" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table sale
-- ----------------------------
ALTER TABLE "public"."sale" ADD CONSTRAINT "sale_client_id_fkey" FOREIGN KEY ("client_id") REFERENCES "public"."client" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table sale_product
-- ----------------------------
ALTER TABLE "public"."sale_product" ADD CONSTRAINT "sale_product_product_id_fkey" FOREIGN KEY ("product_id") REFERENCES "public"."product" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."sale_product" ADD CONSTRAINT "sale_product_sale_id_fkey" FOREIGN KEY ("sale_id") REFERENCES "public"."sale" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
