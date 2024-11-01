=== Simple Email Queue ===
Contributors: dimadin
Donate link: https://milandinic.com/donate/
Tags: email, queue, email queue, emails limits, sending limits, sending restrictions
Requires at least: 4.9
Tested up to: 5.1
Requires PHP: 5.4
Stable tag: 1.3

Put email in queue and send it one by one, by limits.

== Description ==

[Plugin homepage](https://milandinic.com/wordpress/plugins/simple-email-queue/) | [Plugin author](https://milandinic.com/) | [Plus Version](https://shop.milandinic.com/downloads/simple-email-queue-plus/)

Simple Email Queue is a WordPress plugin that is used to pass restrictions set by your host on number of sent emails in given period.

This basic free version is only useful for developers that can extend it and use it in their code. If you want to use it in full capacity, consider getting [plus version](https://shop.milandinic.com/downloads/simple-email-queue-plus/).

## Usage

First, you need to set what is maximum number of emails that can be sent in a given period. By default, it sends 10 emails in 6 minutes. This means that if you want to send 15 emails in 6 minutes, only 10 emails are sent while rest 5 emails are put in queue and sent in the next period, after 6th minute has passed.

You can change this limits by using filters from you code. Filter `simple_email_queue_max` is used to set maximum number of emails that are sent in period. It expects positive integer to be passed.

To change period length, you can use filter `simple_email_queue_interval`. It also expects positive integer to be passed but please take care that this number is of seconds, not minutes (for example, if your period is 30 minutes, you would pass `1800`).

Different hosts use different limits. Please consult your host's documentation or support to find this out.

If you want user interface in your admin area, use [plus version](https://shop.milandinic.com/downloads/simple-email-queue-plus/).

To use this limits, you need to use function `simple_email_queue_add()` instead of built-in function `wp_mail()`. Both accept same parameters.
Emails that are sent using `wp_mail()` function are not sent using queue and are not counted for limits. If you want that all emails are sent using queue, even those sent using `wp_mail()` function, use [plus version](https://shop.milandinic.com/downloads/simple-email-queue-plus/).

And it's on [GitHub](https://github.com/dimadin/simple-email-queue).

== Changelog ==

= 1.3 =
* Released on 4th April 2019
* Use latest version of both `WP_Temporary` and `Backdrop` packages
* Increase required PHP version
* Improve README
* Minor code changes

= 1.2 =
* Released on 15th December 2015
* Sync `WP_Temporary` with WordPress 4.4

= 1.1 =
* Released on 2nd November 2015
* Don't use Composer files as of this version
* Various README improvements

= 1.0 =
* Released on 12th October 2015
* Initial release.
