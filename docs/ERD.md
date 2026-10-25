# ERD InvenTrack

## Entity Relationship Diagram

```mermaid
erDiagram
    USERS {
        bigint id PK
        string name
        string email UK
        string password
        string role
    }

    CATEGORIES {
        bigint id PK
        string name UK
    }

    PRODUCTS {
        bigint id PK
        bigint category_id FK
        string sku UK
        string name
        decimal purchase_price
        decimal selling_price
        int stock
        int minimum_stock
    }

    SUPPLIERS {
        bigint id PK
        string name
        string phone
        string email
    }

    PURCHASES {
        bigint id PK
        bigint supplier_id FK
        bigint user_id FK
        string purchase_number UK
        decimal total
        string status
        datetime purchased_at
    }

    PURCHASE_ITEMS {
        bigint id PK
        bigint purchase_id FK
        bigint product_id FK
        int quantity
        decimal unit_cost
        decimal subtotal
    }

    SALES {
        bigint id PK
        bigint user_id FK
        string sale_number UK
        decimal total
        string status
        datetime sold_at
    }

    SALE_ITEMS {
        bigint id PK
        bigint sale_id FK
        bigint product_id FK
        int quantity
        decimal unit_price
        decimal subtotal
    }

    CATEGORIES ||--o{ PRODUCTS : memiliki
    SUPPLIERS ||--o{ PURCHASES : memasok
    USERS ||--o{ PURCHASES : mencatat
    PURCHASES ||--|{ PURCHASE_ITEMS : memiliki
    PRODUCTS ||--o{ PURCHASE_ITEMS : dibeli
    USERS ||--o{ SALES : melayani
    SALES ||--|{ SALE_ITEMS : memiliki
    PRODUCTS ||--o{ SALE_ITEMS : dijual
```

## Penjelasan Relasi

1. **Categories – Products:** satu kategori dapat memiliki banyak produk.
2. **Suppliers – Purchases:** satu supplier dapat memiliki banyak transaksi pembelian.
3. **Users – Purchases:** satu pengguna dapat mencatat banyak transaksi pembelian.
4. **Purchases – Purchase Items:** satu transaksi pembelian memiliki satu atau lebih detail barang.
5. **Products – Purchase Items:** satu produk dapat tercatat dalam banyak detail pembelian.
6. **Users – Sales:** satu pengguna dapat mencatat banyak transaksi penjualan.
7. **Sales – Sale Items:** satu transaksi penjualan memiliki satu atau lebih detail barang.
8. **Products – Sale Items:** satu produk dapat tercatat dalam banyak detail penjualan.

**Keterangan:** PK = Primary Key, FK = Foreign Key, UK = Unique Key.
