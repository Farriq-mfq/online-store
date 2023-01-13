# Book Ecommerce with codeigniter 4

<p>
     Book Ecommerce with codeigniter 4 integration with midtrans payment and raja ongkir for shipping service
</p>

## how to use

- Clone this repository

```
   git clone https://github.com/Farriq-mfq/online-store.git
```

- Make sure run composer install
- Run

```
 php spark migrate
```

- or import from folder backup_db/..(.sql)
- Default admin path `DEV_ADMIN`
- You can modify `admin path` for admin login in Config/Constants.php `define("ADMIN_PATH","HERE YOUR CUSTOM ADMIN PATH")`
- Copy `.env.example` to `.env`
- Make sure to fill out

```
USER_TOKEN_NAME = "FOR_ENCRYPT_SESSION_USER"
ADMIN_TOKEN_NAME = "FOR_ENCRYPT_SESSION_ADMIN"
API_RAJA_ONGKIR = "FOR_API_KEY_RAJA_ONGKIR"
SERVER_KEY_MIDTRANS = "FOR_API_KEY_MIDTRANDS_SERVER"
```

- Running ci server

```
php spark serve
```

