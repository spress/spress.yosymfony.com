---
layout: page-dev
title: Developers &#8250; IO API
description: "With the IO API your plugins can interact with the user to show messages or to ask questions"
header: { title: Developers, sub: IO API }
prettify: true
---
The IO API <sup><span class="label label-success">New in 1.1.0</span></sup> enables your plugins
to interact with the user to show messages or to make questions:

* Write messages
* Ask for input
* Ask for confirmation (for yes/no questions)
* Ask with hidden answer (useful for password input)

## How to use? {#howto}

The first step is to get a IO API instance using `spress.start` [event](/docs/developers/events-list):

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

Before asking a question to user is recommended to know **if the interface is interactive using
`isInteractive` method**.

## IO API methods {#ioapi-methods}

* **write**: Write a message: `$io->write('message', true)`. The second argument allows you to set a new line.
* **ask**: Ask a question: `$io->ask('question?', null)`. The second argument is the default answer if the user enters nothing.
* **askConfirmation**: yes/no question. `$io->askConfirmation('do you want?', true)`. The second argument is the default answer if the user enters nothing.
* **askAndValidate**: Ask a question with a *callback* function to validate the response.
* **askAndHideAnswer**: Ask a question and hide the answer. This method is useful for password questions.
* **askHiddenResponseAndValidate**: This method is like previous one but uses a *callback* function to validate the response.
* **isInteractive**: Is this input interactive?: `$io->isInteractive()`.
* **isVerbose**: Is this output verbose? `$io->isVerbose()`.
* **isDebug**: Is the output in debug verbosity?: `$io->isDebug()`.

If you are using a *callback* function for validating an answer the validator receives the data to validate. 
It must return the validated data when the data is valid and throw an exception otherwise.

More information about IO API: [Spress IO interface at Github](https://github.com/spress/Spress/blob/1.1/src/Yosymfony/Spress/Core/IO/IOInterface.php).

