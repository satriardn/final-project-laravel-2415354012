# ERP API - Laravel Web API

Sistem ERP sederhana berbasis Web API untuk mengelola layanan digital berbasis langganan.

## Tech Stack

- **Framework**: Laravel 11
- **Database**: MySQL
- **API Format**: JSON

## Base URL

```
http://127.0.0.1:8000/api
```

---

## Modul Service

Mengelola data layanan digital yang tersedia.

### 1. Get All Services

```
GET /api/services
```

**Response:**
```json
{
    "success": true,
    "message": "Services retrieved successfully",
    "data": [...]
}
```

---

### 2. Get All Services by Status

```
GET /api/services?status=active
GET /api/services?status=inactive
```

| Query Param | Value |
|---|---|
| `status` | `active` / `inactive` |

**Response:**
```json
{
    "success": true,
    "message": "Services retrieved successfully",
    "data": [...]
}
```

---

### 3. Get Service by ID

```
GET /api/services/{id}
```

**Response:**
```json
{
    "success": true,
    "message": "Service retrieved successfully",
    "data": {
        "id": 1,
        "name": "Shared Hosting Basic",
        "price": 50000,
        "description": "Paket hosting basic untuk website sederhana",
        "status": true,
        "created_at": "...",
        "updated_at": "..."
    }
}
```

---

### 4. Create Service

```
POST /api/services
```

**Request Body:**
```json
{
    "name": "Shared Hosting Basic",
    "price": 50000,
    "description": "Paket hosting basic untuk website sederhana",
    "status": true
}
```

| Field | Type | Required |
|---|---|---|
| `name` | string | ✅ |
| `price` | integer | ✅ |
| `description` | string | ❌ |
| `status` | boolean | ❌ (default: `true`) |

**Response:**
```json
{
    "success": true,
    "message": "Service created successfully",
    "data": {...}
}
```

---

### 5. Update Service

```
PUT /api/services/{id}
PATCH /api/services/{id}
```

**Request Body:**
```json
{
    "name": "Shared Hosting Pro",
    "price": 75000
}
```

**Response:**
```json
{
    "success": true,
    "message": "Service updated successfully",
    "data": {...}
}
```

---

### 6. Delete Service

```
DELETE /api/services/{id}
```

> ⚠️ Tidak dapat dihapus jika service masih memiliki subscription aktif.

**Response:**
```json
{
    "success": true,
    "message": "Service deleted successfully",
    "data": null
}
```

---

### 7. Change Status Service

**Activate:**
```
PATCH /api/services/{id}/activate
```

**Deactivate:**
```
PATCH /api/services/{id}/deactivate
```

**Response:**
```json
{
    "success": true,
    "message": "Service activated successfully",
    "data": {...}
}
```

---

## Modul Customer

Mengelola data pelanggan yang terdaftar di sistem.

### 1. Get All Customers

```
GET /api/customers
```

**Response:**
```json
{
    "success": true,
    "message": "Customers retrieved successfully",
    "data": [...]
}
```

---

### 2. Get All Customers by Status

```
GET /api/customers?status=active
GET /api/customers?status=inactive
```

| Query Param | Value |
|---|---|
| `status` | `active` / `inactive` |

---

### 3. Get Customer by ID

```
GET /api/customers/{id}
```

**Response:**
```json
{
    "success": true,
    "message": "Customer retrieved successfully",
    "data": {
        "id": 1,
        "customer_id": "CUST-001",
        "name": "Budi Santoso",
        "email": "budi@example.com",
        "phone": "081234567890",
        "address": "Jl. Sudirman No. 1, Jakarta",
        "status": true,
        "created_at": "...",
        "updated_at": "..."
    }
}
```

---

### 4. Create Customer

```
POST /api/customers
```

**Request Body:**
```json
{
    "customer_id": "CUST-001",
    "name": "Budi Santoso",
    "email": "budi@example.com",
    "phone": "081234567890",
    "address": "Jl. Sudirman No. 1, Jakarta",
    "status": true
}
```

| Field | Type | Required |
|---|---|---|
| `customer_id` | string, unique | ✅ |
| `name` | string | ✅ |
| `email` | string, unique | ❌ |
| `phone` | string | ❌ |
| `address` | string | ❌ |
| `status` | boolean | ❌ (default: `true`) |

**Response:**
```json
{
    "success": true,
    "message": "Customer created successfully",
    "data": {...}
}
```

---

### 5. Update Customer

```
PUT /api/customers/{id}
PATCH /api/customers/{id}
```

**Request Body:**
```json
{
    "name": "Budi Santoso Updated",
    "phone": "089999999999"
}
```

**Response:**
```json
{
    "success": true,
    "message": "Customer updated successfully",
    "data": {...}
}
```

---

### 6. Delete Customer

```
DELETE /api/customers/{id}
```

> ⚠️ Tidak dapat dihapus jika customer masih memiliki subscription.

**Response:**
```json
{
    "success": true,
    "message": "Customer deleted successfully",
    "data": null
}
```

---

### 7. Change Status Customer

**Activate:**
```
PATCH /api/customers/{id}/activate
```

**Deactivate:**
```
PATCH /api/customers/{id}/deactivate
```

**Response:**
```json
{
    "success": true,
    "message": "Customer activated successfully",
    "data": {...}
}
```

---

## Modul Subscription

Mengelola data langganan customer terhadap layanan.

### 1. Get All Subscriptions

```
GET /api/subscriptions
```

**Response:**
```json
{
    "success": true,
    "message": "Subscriptions retrieved successfully",
    "data": [...]
}
```

---

### 2. Get All Subscriptions by Status

```
GET /api/subscriptions?status=active
```

| Query Param | Value |
|---|---|
| `status` | `active` / `inactive` / `trial` / `isolir` / `dismantle` |

---

### 3. Get Subscription by ID

```
GET /api/subscriptions/{id}
```

**Response:**
```json
{
    "success": true,
    "message": "Subscription retrieved successfully",
    "data": {
        "id": 1,
        "customer_id": 1,
        "service_id": 1,
        "start_date": "2026-01-01",
        "end_date": "2027-01-01",
        "status": "active",
        "customer": {...},
        "service": {...},
        "created_at": "...",
        "updated_at": "..."
    }
}
```

---

### 4. Create Subscription

```
POST /api/subscriptions
```

**Request Body:**
```json
{
    "customer_id": 1,
    "service_id": 1,
    "start_date": "2026-05-22",
    "end_date": "2027-05-22",
    "status": "active"
}
```

| Field | Type | Required |
|---|---|---|
| `customer_id` | integer, exists | ✅ |
| `service_id` | integer, exists | ✅ |
| `start_date` | date | ❌ |
| `end_date` | date, after start_date | ❌ |
| `status` | enum | ❌ (default: `active`) |

**Status yang tersedia:** `active`, `inactive`, `trial`, `isolir`, `dismantle`

**Response:**
```json
{
    "success": true,
    "message": "Subscription created successfully",
    "data": {...}
}
```

---

### 5. Update Subscription

```
PUT /api/subscriptions/{id}
PATCH /api/subscriptions/{id}
```

**Request Body:**
```json
{
    "status": "isolir",
    "end_date": "2026-12-31"
}
```

**Response:**
```json
{
    "success": true,
    "message": "Subscription updated successfully",
    "data": {...}
}
```

---

## Ringkasan Endpoint

### Service

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | `/api/services` | Get all services |
| GET | `/api/services?status=active` | Get all services by status |
| GET | `/api/services/{id}` | Get service by ID |
| POST | `/api/services` | Create service |
| PUT/PATCH | `/api/services/{id}` | Update service |
| DELETE | `/api/services/{id}` | Delete service |
| PATCH | `/api/services/{id}/activate` | Activate service |
| PATCH | `/api/services/{id}/deactivate` | Deactivate service |

### Customer

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | `/api/customers` | Get all customers |
| GET | `/api/customers?status=active` | Get all customers by status |
| GET | `/api/customers/{id}` | Get customer by ID |
| POST | `/api/customers` | Create customer |
| PUT/PATCH | `/api/customers/{id}` | Update customer |
| DELETE | `/api/customers/{id}` | Delete customer |
| PATCH | `/api/customers/{id}/activate` | Activate customer |
| PATCH | `/api/customers/{id}/deactivate` | Deactivate customer |

### Subscription

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | `/api/subscriptions` | Get all subscriptions |
| GET | `/api/subscriptions?status=active` | Get all subscriptions by status |
| GET | `/api/subscriptions/{id}` | Get subscription by ID |
| POST | `/api/subscriptions` | Create subscription |
| PUT/PATCH | `/api/subscriptions/{id}` | Update subscription |

---

## HTTP Response Code

| Code | Keterangan |
|---|---|
| `200` | OK — Request berhasil |
| `201` | Created — Data berhasil dibuat |
| `404` | Not Found — Data tidak ditemukan |
| `422` | Unprocessable — Validasi gagal |

---

## Database Schema

```
customers
├── id (PK)
├── customer_id (unique)
├── name
├── email (unique)
├── phone
├── address
├── status (boolean)
└── timestamps

services
├── id (PK)
├── name
├── price (integer, Rupiah)
├── description
├── status (boolean)
└── timestamps

subscriptions
├── id (PK)
├── customer_id (FK → customers.id)
├── service_id (FK → services.id)
├── start_date
├── end_date
├── status (active|inactive|trial|isolir|dismantle)
└── timestamps
```