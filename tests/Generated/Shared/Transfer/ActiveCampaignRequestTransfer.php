<?php

namespace Generated\Shared\Transfer;

class ActiveCampaignRequestTransfer
{
    /**
     * @var string $locale
     */
    protected $locale;

    /**
     * @var string $email
     */
    protected $email;

    /**
     * @param string $locale
     *
     * @return void
     */
    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $email
     *
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
