<?php

namespace Kabischev\Collector\Storage;

use Kabischev\Collector\Source\SourceInterface;

interface StorageInterface
{
    /**
     * @param SourceInterface $source
     */
    public function store(SourceInterface $source);
}
