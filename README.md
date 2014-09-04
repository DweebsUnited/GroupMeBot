GroupMeBot
==========

This is a chatbot making use of the GroupMe Bot API

This depends on the Httpful library ( Just put the .phar in the same directory as the callback script )

To use: Point a GroupMe bot's callback at this file, and let 'er rip.

To add additional functionality: Expand the switch statment with any other : commands you want. You can also add keywords similar to the (.)(.) command for responses to character sequences anywhere in a message.

==========

The config.php file that needs to exist in the same directory as the callback needs to define the following:
```php
$bot_token = "bot token from GroupMe bot registration page"
```
