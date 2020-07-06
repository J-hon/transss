Transss...

Transss is a virtual wallet system for where customers can preload their 
wallet as well as gift other customers virtual money to make 
purchases.

Installation

- Open your terminal

Run the following commands in your terminal

- `git clone https://github.com/J-hon/transss.git`
- `git transss`
- `composer install`

1. Rename or copy `.env.example` file to `.env`.
2. Start your server.
3. Import the `transss.sql` file into your database (MySQL)
4. Run `php artisan migrate` and `php artisan db:seed`to migrate tables.
5. Copy this link `http://localhost:8000/` and paste in your browser.

Username: "test"

Password: "password" (without the quotes of course ;)

Test bank card details: 

`Card number:` 4242 4242 4242 4242 

`Pin:` 3310 `CVV:` 812 `Exp:` 01/21 `OTP:` 12345 

For transfer:

`Recipient phone number:` 09012345678

Thank you :)
