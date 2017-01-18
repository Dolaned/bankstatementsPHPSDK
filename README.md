# BankStatements API Wrapper

This project was created to wrap the json endpoint of bankstatements.com.au, it is intended to make interfacing with your bank accounts / statements easier.

## Installation

This project is available to install using composer

`$ composer require gl3nda85/bank-statements-wrapper`


## Basic Usage

###Log in and retrieve account information

To use this api, you must contact bankstatements.com.au and purchase an api key off them.
 
To create an instance of the bankstatement Api you must call it with the following function.
A boolean is the second argument for whether to connect to their live server or test server. below connects to the test server set it to false or nothing for the live server.

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
$accountBalance = $firstAccount->getBalance(); // $52.80
$accountBSB = $firstAccount->getBsb(); // 063-997
$accountNumber = $firstAccount->getAccountNumber(); // 1015 8077
$accountName = $firstAccount->getName(); // Main Account
$accountType = $firstAccount->getAccountType(); // Savings
```

To logout and end your session pass your userToken to a logout object, this function will return true if logged out successfully.
```
$bankStatement->logout(new Logout($userToken));
```


###Retrieving Statement Data

Once Logged in, you can retrieve statement data for each of your accounts in the following fashion.

First collecting the Id's of the accounts you would like to get the statement data for.
Second creating a new StatementDataRequest using the bank slug for the accounts.
Finally calling getStatementData passing in the userToken from the logged in user session and the statementRequest.
```
$accountIds = array($firstAccount->getId(), $secondAccount->getId);

$statementRequest = new StatementDataRequest($firstAccount->getSlug(), $accountIds);

$statements = $bank->getStatementData($userToken, $statementRequest);
```
The StatementDataRequest has Advanced Options that can be used, such as the amount of days for the statement and creating raw files.
```
$statementRequest->setRequestNumDays(90);
```
Read the full Api Docs for more information.


From calling the statement function from above you will get a collection of statement data from each account id that was entered.
To get the first accounts list of transactions use the following function

```
$transactions = $statements->first()->getTransactionCollection()->all();
```

To get your day end balance
```
$endofDayBalance = $statements->first()->getDayEndBalanceCollection()->all();
```

Bankstatements.com.au scan your bank statements and categorize your transactions into many collections

They have:
```
$incomeCollection;
$benefitCollection;
$dishonourColection;
$loanCollection;
$gamblingCollection;
$otherDebtsCollection;
```

To call any of these data sets use functions like these

```
$otherDebtsCollecton = $statements->first()->getOtherDebtsCollection()->all();
```
## Contributing

Dylan Aird


## History

16/01/2017 Ver 1.0

## Credits

Dylan Aird

## License

Bankstatements API is released under the MIT License. See the bundled LICENSE file for details.