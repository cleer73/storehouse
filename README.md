Storehouse
==========

Model management, using rule based filters at the row and field levels. 
This code is __alpha__, and could change dramatically at any time.

## Class Overview

```php
\Storehouse\Collection(); # Undefined
\Storehouse\Exception($message); # Just a namespace

\Storehouse\Field($config);
\Storehouse\Field->__set($name, $value);
\Storehouse\Field->__get($name);
\Storehouse\Field->__toString();

\Storehouse\Field\Factory::simple($config);
\Storehouse\Field\Factory::string($config);
\Storehouse\Field\Factory::integer($config);

\Storehouse\Filter($config=[]);
\Storehouse\Filter->run($value);
\Storehouse\Filter->addRule($name, $callback);

\Storehouse\Filter\Factory::simple($config=[]);
\Storehouse\Filter\Factory::string($config=[]);
\Storehouse\Filter\Factory::integer($config=[]);

\Storehouse\Row($config);
\Storehouse\Row->addField($name, $config);
\Storehouse\Row->__get($name);
\Storehouse\Row->__set($name, $value);
\Storehouse\Row->__toString();

\Storehouse\Rule\Factory::string();
\Storehouse\Rule\Factory::integer();
\Storehouse\Rule\Factory::minLength($min);
\Storehouse\Rule\Factory::maxLength($max);
\Storehouse\Rule\Factory::minValue($min);
\Storehouse\Rule\Factory::maxValue($max);

\Storehouse\Storehouse::autoload(); # PSR-0 autoloader
\Storehouse\Storehouse::registerAutoloader(); # Register PSR-0 autoloader
```
