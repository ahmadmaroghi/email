<?php
include 'vendor/autoload.php';


$privatekey_local = "-----BEGIN RSA PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDThWIHE31brLoGyfO1zQ1MbQexCnkDnl2YQUHs10e+nYNzDG2AB/Tm2HxsVpMxr6pJbrTlVadtz2j6DF1moYb/J+HNOgobGCsuw6QiZpybtj47UZu93TG0K+8Rk0MpbHk0+a8fzPuolgEKZsQ5Ug4u9fp5i7a/rOg51PWslCQlBwYINh3CNVW0DGUwhxb5shOysozDL5m2e4qpmuZ4hYZRgzpNAwOrj35vXOu4zM6RKeR+2qxXj4YVbhnYXU89FMilHN0/jxZWOdUHtmeAZKlaJDf49NspQZRVKkgPSY08SvKt65BFFVxHwW6Ohrf/x/mhXIDAGtSYPYKksbC58/m1AgMBAAECggEBAK+5ihzy1hxJPSrSsEODHN83XUJ5vtuAv6Tz4f8PQq1bUo9L7dSFx7HYfFXM/vAyTjg/Xs2AAV67By1lBFt1Kh/kVDUZWLf1tjpdkoh50vWRy9WgENEFaHuUXEKvowZQ9clK/XBf7Vq7dBXeFnrAbsQY2oQLzEElNrCE+azsTbLrxLIGLXSqKGYP/QR8SHsxPDiTg6aCnEoN17XFyENYBRedt9jhQpRLe492lG1pslznkdQZFQJQAfh5UY5/iVID2chIvWHAfYQ7aj6zqZ3q0r3IGquLeu7DYVyAMDtF3EkTnho4ViZpYi7n0rF7dgIRdzoruyYBMYrzbZqHgy9ElQECgYEA/izssg6/UBek603TbwcOQznRfxkI6IdjHOb2l6RfDYs1PEjx6vdh/jFt98r+yKR1tLDofyo5k3/ouCRMIOmoj/pxmo5KhDgaixlMksQDyQnpPIS3EbIVxzkr5tdSSbJwcmJdxHO405ttKI6QLnK2YLJvc3teC8ZVb44xpdNt9OECgYEA1QoTeTXYwce8Mwtd/f7DQ3GvurQ/5mWjDSzx5gvPY/JnnFq+9OyluE/6ifKvTUv2/OwIrxpfdBm7ib7lKZ3eAilazZWfCfTameHI1hK7SAjcYx0rtenxczDOcfDt1XjLozi+g/zsD70f1vQYPjNUo/c3ND+hKuaqZHDDGj5sC1UCgYAB+V1ZQK4RtC1OuosC2L4unXtYDly4WZzWc6DEqr0mQMeIEVT3qzYyoDWncAcsjcJwRdN4cV6DG8I18+o3czkg7SQGvEYt4rWqEOc8WJNi81XBZ5J4a7aplnMV1uRHuEARU1xBE1kDI7jkUL8j7TYnaBtffTzMwJyXQjZ2gD7hYQKBgQCAkGocFfDPULg0ncGFTL+N7ge8xpZhdiimBN+ekrX/fQQmCWV/7Wg9CJcLtNcx8IwHKnI7KdE9AWJ5yCgHq2uVJlvUAV1O5uMdRnKrLfazjBVkAvCkAaBigau0e08sKo/J2q6ufG4BOYMDd59Bujx0DvbToyqh9z4RCzPSnKUbWQKBgEQLgjm7c5W0y1G5dUMI8X7/+OVbA96wSEblM7mSWkVB+KPmWYqA/5Or3rj9oZ2Tr+yVBWZx7uVIrNVFLeSLHQIEGSfP8BxAWsnk6EmdPPmKJhJiuPYFtWTQWlW9E7o2bI4bVEfAxJ2YnvK/FKMOt28pHZUjWPTROImwa56l+6Gm
-----END RSA PRIVATE KEY-----";

$publickey_local = "-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA04ViBxN9W6y6Bsnztc0NTG0HsQp5A55dmEFB7NdHvp2DcwxtgAf05th8bFaTMa+qSW605VWnbc9o+gxdZqGG/yfhzToKGxgrLsOkImacm7Y+O1Gbvd0xtCvvEZNDKWx5NPmvH8z7qJYBCmbEOVIOLvX6eYu2v6zoOdT1rJQkJQcGCDYdwjVVtAxlMIcW+bITsrKMwy+ZtnuKqZrmeIWGUYM6TQMDq49+b1zruMzOkSnkftqsV4+GFW4Z2F1PPRTIpRzdP48WVjnVB7ZngGSpWiQ3+PTbKUGUVSpID0mNPEryreuQRRVcR8Fujoa3/8f5oVyAwBrUmD2CpLGwufP5tQIDAQAB
-----END PUBLIC KEY-----";

 $rsa = new \phpseclib\Crypt\RSA();
 $key = extract($rsa->createKey());

 $plaintext = "samuel";


 $rsa->loadKey($privatekey_local);
 echo "------------CIPHERTEXT--------------"."<br>";
 $ciphertext = base64_encode($rsa->encrypt($plaintext));
 echo $ciphertext."<br>";
 $rsa->loadKey($publickey_local);
 echo "------------PLAINTEXT--------------"."<br>";
 echo $rsa->decrypt(base64_decode($ciphertext))."<br>";

// var_dump($privatekey);
// var_dump($publickey);

 $rsa = new \phpseclib\Crypt\RSA();
 extract($rsa->createKey());

 $plaintext = 'terrafrost';

 $rsa->loadKey($privatekey);
 $signature = $rsa->sign($plaintext);

 $rsa->loadKey($publickey);
 // echo $rsa->verify($plaintext, $signature) ? 'verified' : 'unverified';


?>