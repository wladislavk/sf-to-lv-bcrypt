This package was created with purpose of creating a BCrypt hasher that
could be used in both Laravel and non-Laravel projects. This package is
useful in the following cases:
1) A part of your code uses Laravel, and the other part does not, but
you need a common hasher,
2) You are using Laravel but intend to switch to another framework and
want to make the transition painless.

The `VKR\SymfonyLaravelBCryptBridge\BcryptHasher` class intends to
reproduce functionality of `Illuminate\Hashing\BcryptHasher` without
being dependent on Laravel. It was tested with Laravel versions 5.5 and
newer.

The original Laravel class implements an interface named 
`Illuminate\Contracts\Hashing\Hasher`. This means that 
`VKR\SymfonyLaravelBCryptBridge\BcryptHasher` will not work in a Laravel
project out of the box, and a decorator implementing the same
interface is needed. You can copy-paste `/examples/LaravelWrapper.php`
into your project, just add the relevant namespace. When using this
package with other frameworks, you can create other decorators that
would implement an interface defined in your framework.

This package depends on `symfony/security` 4.x, so it will not work with
any framework that insists on using a different version of 
`symfony/security`. 
