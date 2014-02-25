---
layout: blog/post
title: How to create a contact form in Spress?
description: We explain to you how to integrate a contact form in your static site
categories: [resources]
tags: [form]
---
It's probably that soon or later you need integrate a contact
form in your site. To do it, you can use [Get simple form](http://getsimpleform.com/)
service that allow you setup forms with any kind of data. To use this service only
requires a token that you will receive by email.

```
<form action="http://getsimpleform.com/messages?form_api_token=<form_api_token>" method="post">

    <!-- 
        the redirect_to is optional, the form will 
        redirect to the referrer on submission 
    -->
    <input type='hidden' name='redirect_to' 
        value='<e.g. http://yoursite.com/thank-you.html>' />
    
    <!-- all your input fields here.... -->
    <input type='text' name='test' />
    
    <input type='submit' value='Test form' />
</form>
```

The above code, show us how to setup a form. The hidden field **redirect_to** allow us
set a redirect URL for when the form is submitted. For each form submitted you receive a email.