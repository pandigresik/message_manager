# Message manager

# Message manager
Application can generate message based template master, support send to whatsapp using wablas service

## Minimum Requirement

- [x] PHP versi 5.6 dan extension yang diperlukan selama instalasi menggunakan composer
- [x] Mysql Database minimal versi 8
- [x] Web Server (Apache, Nginx atau IIS)

**NOTE**:

- [x] Sistem ini dikembangkan menggunakan lingkungan pengembangan Linux, pengembang tidak menjamin jika sistem ini dapat berjalan dengan baik pada sistem operasi lain.
- [x] Walaupun dapat berjalan pada DB Engine lain selain MySQL, namun sistem ini hanya mensupport untuk database MySQL.

## Fitur
- [x] Backend Site
- [x] Master template
- [x] Generate message based on template ( upload csv file )
- [x] Send message via whatsapp using wablas service
- [x] Log Activity User untuk proses transaksi

## Cara Install (Manual)

- [x] Clone/Download repository `git clone https://github.com/pandigresik/message_manager.git` dan pindah ke folder `message_manager`
- [x] Jalankan [Composer](https://getcomposer.org/download) Install/Update `composer update`
- [x] Create folder **uploads/imageMessages** in **message_manager** folder and set permission to can writeable
- [x] set connection setting, rename **application/config/database.example.php** to **application/config/database.php**
- [x] set config setting, rename **application/config/config.example.php** to **application/config/config.php**
- [x] set your token from wablas provider or else, rename **application/config/serverws.example.php** to **application/config/serverws.php**
- [x] Setup your connection database setting in **config/database.php**
- [x] We must doing migration and seed to generate table and seed default data, open cmd / terminal on current directory then execute command **php index.php tools migrate** , if there is not error we must execute command **php index.php tools seed** for seeding data process
- [x] Execute command `php -S <HOST>:<PORT>` to activate web server built in ( development mode), we can skip this process if we use web server like apache , nginx or else.
- [x] Open in browser `<HOST>:<PORT>/`

## Kontributor

Proyek ini dikembangkan oleh [Ahmad Afandi](https://github.com/pandigresik) dan para [kontributor](https://github.com/pandigresik/message_manager/graphs/contributors).
