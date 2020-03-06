## JWT (JSON Web Tokens) Encoder/Decoder

#### Installation

`composer require papalapa/jwt`

#### PEM-key pare generate command

`openssl req -x509 -nodes -newkey rsa:2048 -keyout jwt-key.pem -out jwt-cert.pem -days 365`

#### Example with Secret String

```php
use papalapa\jwt\Encoder;
use papalapa\jwt\Decoder;
use papalapa\jwt\KeyStorage;
use papalapa\jwt\PayloadOptions;use papalapa\jwt\Signers\HS256;

$secretString = '00000000000000000000000000000000';
$keyStorage = new KeyStorage($secretString);

$myAudience = 'my-site';
$encoder = new Encoder($myAudience, $keyStorage);
$token = $encoder->encode(new HS256(), ['username' => 'John Doe']); // eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.lv1XJ5-AKeciLPbEr0vV5XMgfdZMrUnK2t0GKkZapjU

$decoder = new Decoder('my-site', $keyStorage);
$payload = $decoder->decode($token); // ['username' => 'John Doe']

// with key pair
$cert = '/home/user/cert/cert.pem';
$key = '/home/user/cert/key.pem';
$keyStorage = new KeyStorage($secretString, $cert, $key);

// activation-time check (nbf attribute)
$decoder->setActivationCheck(true); // true by default
$payload = ['username' => 'John Doe', 'nbf' => '2030-01-01T00:00:00'];

// expiration-time check (exp attribute)
$decoder->setExpirationCheck(true); // true by default
$payload = ['username' => 'John Doe', 'exp' => '2030-01-01T00:00:00'];

// audience check (aud attribute)
$decoder->setAudienceCheck(true); // true by default
$payload = ['username' => 'John Doe', 'aud' => ['my-site', 'his-site', 'our-site']];

// using another config with attribute names in payload
$payloadOptions = new PayloadOptions([
    'aud' => 'audienceName',
    'exp' => 'expiredAt',
    'iss' => 'issuer'
]);
// using setters
$payloadOptions->setNbfArgument('activatedAt');
$payloadOptions->setAlgArgument('hasher');
$decoder = new Decoder($myAudience, $keyStorage, $payloadOptions);
```

#### Tests

Runs tests using phpunit: `composer test`

#### Test coverage

Runs html-coverage tests using phpunit: `composer coverage`

#### Help

JWT online test: **https://jwt.io/**
