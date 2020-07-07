<b>Transss...</b>

Transss is a virtual wallet system for where customers can preload their 
wallet as well as gift other customers virtual money to make 
purchases.

<b>Requirements</b>

- PHP >= 7.*
- MySQL >= 5.7
- Composer
- Internet connection

<b>Installation</b>

Open your terminal and run the following commands:

- `git clone https://github.com/J-hon/transss.git`
- `cd transss`
- `composer install`
- `php artisan vendor:publish --provider="KingFlamez\Rave\RaveServiceProvider"
`

<b>Steps</b>
1. Rename or copy `.env.example` file to `.env`.
2. Start your server.
3. Import the `transss.sql` file into your database (MySQL)
4. Run `php artisan migrate` to migrate tables.
5. Copy this link `http://localhost:8000/` and paste in your browser.

<b>For Transfer:</b>

Register two or more accounts to use the Transfer feature

<b>For Deposit:</b>

Bank card details 

`Card number:` 4242 4242 4242 4242 

`Pin:` 3310 `CVV:` 812 `Exp:` 01/21 `OTP:` 12345 
