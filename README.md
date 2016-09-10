[![Build Status](https://travis-ci.org/bkrukowski/gordianus.svg?branch=master)](https://travis-ci.org/bkrukowski/gordianus)
[![Coverage Status](https://coveralls.io/repos/github/bkrukowski/gordianus/badge.svg?branch=master)](https://coveralls.io/github/bkrukowski/gordianus?branch=master)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/b057fa037a3b4f318f75af27b0b01d47)](https://www.codacy.com/app/bartlomiej-krukowski/gordianus?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=bkrukowski/gordianus&amp;utm_campaign=Badge_Grade)

# Gordianus

Gordianus clears aliases from email address. Email `John.Doe+alias@gmail.com` will be transformed to `johndoe@gmail.com`.

## Why?

To detect multi-accounts in your website.

## Supported mailboxes

* [gmail.com](https://gmail.com)
* [tlen.pl](http://tlen.pl)
* [33mail.com](https://www.33mail.com)
* [outlook.com](http://outlook.com)
* [yahoo.com](http://mail.yahoo.com)

## Usage

```php
$gordianus = new \bkrukowski\Gordianus\Gordianus();
$transformedEmail = $gordianus->getPrimaryEmail('John.Doe+alias@gmail.com');
```

## Yahoo.com

Aliases work different on Yahoo than on Gmail. On Gmail part after plus is skipped.
For example message sent to `jane.doe+alias@gmail.com` will be redirected to `jane.doe@gmail.com`.

Yahoo uses the following pattern[*](https://help.yahoo.com/kb/SLN16026.html):

*baseName*-*keyword*@yahoo.com

* *baseName* - value defined by the user, different than email login;
* *keyword* - one from a list of keywords defined by the user.

Therefore we do not know what is the real email, so in this case result will be:

*baseName*-alias@yahoo.com.