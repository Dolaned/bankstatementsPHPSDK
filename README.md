# BankStatements API Wrapper

This project was created to wrap the json endpoint of bankstatements.com.au, it is intended to make interfacing with your bank accounts / statements easier.

## Installation

This project is available to install using composer
`$ composer require gl3nda85/bank-statements-wrapper`


## Usage
To use this api, you must contact bankstatements.com.au and purchase an api key off them.
 
To create an instance of the bankstatement Api you must call it with the following function, there is a second argument for whether to connect to their live server or test server. below connects to the test server.

```
$bankStatement = new BankStatement('YOUR_API_KEY', true);
```

To login you must pass an instance of the login class to the above bankStatement object.

```
$loginCreds = new Login('bank_of_statements', '12345678', 'TestMyMoney');
$loginResponse = $bankStatement->login($loginCreds);
```
The respose above contains two things an array of accounts and an access token, which you must store locally to further use this API.

```
$userToken = $loginResponse['userToken'];
$accountCollection = $loginResponse['accounts'];

```


## Contributing



## History

16/01/2017 Ver 1.0

## Credits

Dylan Aird

## License

Bankstatements API is released under the MIT License. See the bundled LICENSE file for details.