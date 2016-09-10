[![Build Status](https://travis-ci.org/bkrukowski/gordianus.svg?branch=master)](https://travis-ci.org/bkrukowski/gordianus)
[![Coverage Status](https://coveralls.io/repos/github/bkrukowski/gordianus/badge.svg?branch=master)](https://coveralls.io/github/bkrukowski/gordianus?branch=master)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/b057fa037a3b4f318f75af27b0b01d47)](https://www.codacy.com/app/bartlomiej-krukowski/gordianus?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=bkrukowski/gordianus&amp;utm_campaign=Badge_Grade)

# Gordianus

Gordianus clears aliases from email address. Email John.Doe+alias@gmail.com will be transformed to johndoe@gmail.com.

## Supported mailboxes

* [gmail](https://gmail.com)
* [tlen.pl](http://tlen.pl)
* [33mail.com](https://www.33mail.com)

## Usage

```php
$gordianus = new \bkrukowski\Gordianus\Gordianus();
$transformedEmail = $gordianus->getPrimaryEmail('John.Doe+alias@gmail.com');
```