<?php

namespace App\Filter;

class LegalDocumentFilter extends BaseFilter
{
    public function __construct()
    {
        $this->type = null;
        $this->language = null;
        $this->version = null;
        $this->is_active = null;
    }

    protected ?string $type;
    protected ?string $language;
    protected ?string $version;
    protected ?bool $is_active;

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): void
    {
        $this->language = $language;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(?string $version): void
    {
        $this->version = $version;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(?bool $is_active): void
    {
        $this->is_active = $is_active;
    }
}
