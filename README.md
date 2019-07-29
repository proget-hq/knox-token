# Knox Token

Support library for signing Samsung Knox API access tokens

## Install

```
composer require proget-hq/knox-token
```

## Usage

More info at [Knox Cloud API Integration Guide](https://docs.samsungknox.com/cloud-authentication/api-reference/Default.htm#section/Generate-your-access-token)

### Sign your Client Identifier

```php
use Proget\Samsung\KnoxToken\KnoxToken;

$clientIdentifierJwt = KnoxToken::signClientIdentifier('your-client-identifier', 'keys.json');
```

### Sign your Access Token

```php
use Proget\Samsung\KnoxToken\KnoxToken;

$accessTokenJwt = KnoxToken::signAccessToken('access-token', 'keys.json');
```

### Load certificate

```php
use Proget\Samsung\KnoxToken\Certificate;

$certificate = Certificate::fromPath('keys.json');

$certificate->publicKey();
$certificate->privateKeyPem();
````

## License

MIT
