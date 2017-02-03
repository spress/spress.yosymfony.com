---
layout: page-dev-2.0
title: Developers &#8250; IO API
description: "With the IO API your plugins can to interact with the user to show messages or to make questions"
header:
  title: IO API
  sub: Developers
menu:
  id: dev 2.0
  title: IO API
prettify: true
---
<span class="label label-success">Spress >= 1.1</span>

The IO API enables your plugins to interact with the user to show messages or to make questions:

* Write messages.
* Ask.
* Ask confirmation (for yes/no questions).
* Ask and hide answer (useful for get password answer).

IO API implements [IOInterface](https://github.com/spress/Spress/blob/master/src/Core/IO/IOInterface.php) defined
at Spress Core.

## How to use?

The first step is to get a IO API instance using `spress.start` [event](/docs/developers/events-list) and
`getIO` method. This method returns a [`Yosymfony\Spress\IO\ConsoleIO`](https://github.com/spress/Spress/blob/master/src/IO/ConsoleIO.php) instance.

```
class SpressIOExample extends Plugin
{
    private $io;

    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
    }

    public function onStart($event)
    {
        $this->io = $event->getIO();

        if($this->io->isInteractive())
        {
            $this->io->write('Welcome to Github plugin for Spress.', true);
            $answer = $this->io->askConfirmation(
                "Do you want to connect to your Github account? ",
                false);

            if($answer)
            {
                $this->io->ask('username: ');
                $this->io->askAndHideAnswer('password:');
            }
        }
    }
}
```

Before make a question to user is recommendable to know **if the interface is interactive using
`isInteractive` method**.

## IO API methods

* **write**: Write a message: `$io->write('message', true)`. The second argument
let you set a new line. <span class="label label-success">Spress >= 2.2.0</span> There is a third
argument for setting the verbosity level. `VERBOSITY_NORMAL` by default. e.g:
`$io->write('message', true, IOInterface::VERBOSITY_NORMAL)`

* **ask**: Ask a question: `$io->ask('question?', null)`. The second argument is the default answer if the user enters nothing.
* **askConfirmation**: yes/no question. `$io->askConfirmation('do you want?', true)`. The second argument is the default answer if the user enters nothing.
* **askAndValidate**: Ask a question with a *callback* function to validate the response.
* **askAndHideAnswer**: Ask a question and hide the answer. This method is useful to require password.
* **askHiddenResponseAndValidate**: This method is like before but using a *callback* function to validate the response.
* **isInteractive**: Is this input means interactive?: `$io->isInteractive()`.
* **isVerbose**: Is this output verbose? `$io->isVerbose()`.
* **isDebug**: Is the output in debug verbosity?: `$io->isDebug()`.

If you are using a *callback* function for validating an answer the validator receives the data to validate.
It must return the validated data when the data is valid and throw an exception otherwise.
