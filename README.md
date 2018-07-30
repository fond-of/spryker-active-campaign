# spryker-active-campaign

[![Build Status](https://travis-ci.org/fond-of/spryker-product-api.svg?branch=master)](https://travis-ci.org/fond-of/spryker-active-campaign)
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-spryker/active-campaign)

##### Attentition: This Package is only for use with SprykerSuite! If youre using the version based on the demoshop use version 1.x

## Installation

```
composer require fond-of-spryker/active-campaign
```

## Configuration

Register the new module in your YvesBootstrap.php

Add your personal active campaign configuration to config file. 

```
$config[ActiveCampaignConstants::ACTIVE_CAMPAIGN_API_KEY] = "ACTIVE_CAMPAIGN_API_KEY";
$config[ActiveCampaignConstants::ACTIVE_CAMPAIGN_URL] = "ACTIVE_CAMPAIGN_URL";
$config[ActiveCampaignConstants::ACTIVE_CAMPAIGN_SUBSCRIBE_URL] = 'newsletter/subscribe/';
$config[ActiveCampaignConstants::ACTIVE_CAMPAIGN_CONFIRMATION_URL] = 'newsletter/subscribe-confirmation/';
$config[ActiveCampaignConstants::ACTIVE_CAMPAIGN_LISTID . "de_DE"] = 100;
$config[ActiveCampaignConstants::ACTIVE_CAMPAIGN_FORMID . "de_DE"] = 200;
```

Feel free to change the routes for subscribe and confirmation in the plugin provider. Dont forget the locales for 
LISTID and FORMID! The default locale is set on "de_DE", if you want to change this extend or overwrite 
FondOfSpryker\Zed\ActiveCampaign\ActiveCampaignConfig.

## Templates

Sample submit form (@ActiveCampaign/index/form.twig)

```
{{ form_start(activeCampaignSubscriptionForm, { 'action': path('ROUTE_ACTIVECAMPAIGN_SUBMIT')}) }}
    {{ form_row(activeCampaignSubscriptionForm.email }}
    {{ form_row(activeCampaignSubscriptionForm.submit }}
{{ form_end(activeCampaignSubscriptionForm) }}
```

After creating the submit form you need two more templates for after subscription an confirmation:
- @ActiveCampaign/index/subscribe.twig
- @ActiveCampaign/index/subscribe-confirmation.twig

Both are just static templates, do whatever you want.
