---
layout: blog/post
title: New in Spress 1.1: IO API
description: With the IO API your plugins can to interact with users
categories: [news]
tags: ['1.1', 'io api']
---
The development of Spress 1.1 has started and the first improvement is the **new IO API
available for plugins**. With the IO API your plugins can to interact with the user to show
messages or to make questions:

* Write messages.
* Ask.
* Ask confirmation (for yes/no questions).
* Ask and hide answer.

This is a example of how to use the new IO API:

--more Read more--

```
class SpressIOExample extends Plugin
{
    private $io;
    
    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
    }
    
    public function onStart(EnviromentEvent $event)
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
At the before example, you can get access to IO API with **`getIO` method of `EnviromentEvent`**.
Before make a question to user is recommendable to know if the interface is interactive using
`isInteractive` method.

## IO API methods
* **write**: Write a message: `$io->write('message', true)`. The second argument let you set a new line.
* **ask**: Ask a question: `$io->ask('question?', 'default value')`.
* **askConfirmation**: yes/no question. `$io->askConfirmation('do you want?', false)`. The second argument is the default answer if the user enters nothing.
* **askAndValidate**: Ask a question with a *callback* function to validate the response.
* **askAndHideAnswer**: Ask a question and hide the answer. This method is useful to require password.
* **askHiddenResponseAndValidate**: This method is like before but using a *callback* function to validate the response.

If you want know more about IO API, check the [Spress IO interface at Github](https://github.com/yosymfony/Spress/blob/master/src/Yosymfony/Spress/IO/IOInterface.php).

The next improvement for Spress 1.1 is related with configuration files and the possibility of to define multiple enviroments.