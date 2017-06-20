# Alexa PHP SDK

[![Build Status](https://api.travis-ci.org/awsmug/alexa-sdk.png?branch=master)](https://travis-ci.org/awsmug/alexa-sdk)
[![Code Climate](https://codeclimate.com/github/awsmug/alexa-sdk/badges/gpa.svg)](https://codeclimate.com/github/awsmug/alexa-sdk)

This is a free PHP software development kit for Amazon Echo.

## Using the SDK

To use the SDK, just include the *alexa-sdk.php* file to your Alexa project and add extend the Skill class with your own Skill.

## Composer

Add the Alexa PHP SDK by using composer. Just add a *composer.json* to your project with the following content.

```javascript
{
  "require": {
    "awsmug/alexa-php-sdk": "dev-master"
  }
}
```

After adding the *composer.json*, use *composer install* to install all packages. To use the SDK in your PHP Code,
just include the SDK like this:

```php
require_once dirname( __FILE__ ) . '/vendor/awsmug/alexa-php-sdk/src/alexa-sdk.php';
```

## A simple skill

This is the code for a very simple skill.

```php
use Alexa\Skill_Template;
use Alexa\Exception;

class Simple_Skill extends Skill_Template {

	public function intent_request() {
		/**
		 * Put in your answer stuff here!
		 */
		$this->output()->response()->output_speech()->set_text( 'You started the skill!' );
		$this->output()->response()->end_session();
	}
}

$simple_skill = new Simple_Skill( 'YOUR-SKILL-ID' );

try{
	$simple_skill->run();
} catch( Exception $exception) {
	$simple_skill->log( $exception->getMessage() );
	echo $exception->getMessage();
}
```

## Using Autocomplete

The SDK is programmed for autocompleting functions. If you use an IDE like *PHP Storm*, 
the functions will autocomplete by itself and you can discover the functions by the autocomplete
functionality of the IDE.