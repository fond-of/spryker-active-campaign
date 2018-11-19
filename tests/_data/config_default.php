<?php

use FondOfSpryker\Shared\ActiveCampaign\ActiveCampaignConstants;

$config[ActiveCampaignConstants::ACTIVE_CAMPAIGN_API_KEY] = 'TESTAPIKEY';
$config[ActiveCampaignConstants::ACTIVE_CAMPAIGN_URL] = 'API_URL';

// ---------- ActiveCampaign
$config[ActiveCampaignConstants::ACTIVE_CAMPAIGN_LOCALIZED_CONFIGS] = [
    'en_US' => [
        ActiveCampaignConstants::ACTIVE_CAMPAIGN_LIST_ID => 22,
        ActiveCampaignConstants::ACTIVE_CAMPAIGN_FORM_ID => 2222,
        ActiveCampaignConstants::ACTIVE_CAMPAIGN_SUBSCRIBE_PATH_PART => 'subscribe',
        ActiveCampaignConstants::ACTIVE_CAMPAIGN_CONFIRMATION_PATH_PART => 'subscribe-confirmation',
    ],
    'de_DE' => [
        ActiveCampaignConstants::ACTIVE_CAMPAIGN_LIST_ID => 11,
        ActiveCampaignConstants::ACTIVE_CAMPAIGN_FORM_ID => 1111,
        ActiveCampaignConstants::ACTIVE_CAMPAIGN_SUBSCRIBE_PATH_PART => 'anmeldebestaetigung',
        ActiveCampaignConstants::ACTIVE_CAMPAIGN_CONFIRMATION_PATH_PART => 'anmeldung',
    ],
];
