# BankStatements API Wrapper

This project was created to wrap the json endpoint of bankstatements.com.au, it is intended to make interfacing with your bank accounts / statements easier.

## Installation

This project is available to install using composer
`$ composer require gl3nda85/bank-statements-wrapper`


## Basic Usage

###Log in and retrieve account information.

To use this api, you must contact bankstatements.com.au and purchase an api key off them.
 
To create an instance of the bankstatement Api you must call it with the following function, there is a second argument for whether to connect to their live server or test server. below connects to the test server.

```
$bankStatement = new BankStatement('YOUR_API_KEY', true);
```

To login you must pass an instance of the login class to the above bankStatement object. this must contain the slug for the bank eg. Commonwealth Bank of Australia is cba, the client number / username, and the password.

```
$loginCreds = new Login('bank_of_statements', '12345678', 'TestMyMoney');
$loginResponse = $bankStatement->login($loginCreds);
```
The respose above contains two things an array of accounts and an access token, which you must store locally to further use this API.

```
$userToken = $loginResponse['userToken'];
$accountCollection = $loginResponse['accounts'];

```
The account collection is a collection of all your accounts to get the first account from the stack you can call:

```
$firstAccount = $accountCollection->first();
```

with this first account object you can perform numerous tasks such as getting the account number, bsb, current balance and account holder.

```
$accountBalance = $firstAccount-getBalance();

```



## Contributing



## History

16/01/2017 Ver 1.0

## Credits

Dylan Aird

## License

Bankstatements API is released under the MIT License. See the bundled LICENSE file for details.