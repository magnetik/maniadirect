<?php

namespace Nadeo\Live\ManiaDirect\Plugin;

/**
 * Implement this if you create a plugin
 */
interface PluginInterface
{
    /**
     * A (short) alphanumeric identifier for this plugin. It will be used for:
     * - config
     * - events
     *
     * @return string
     */
    public function getPrefix();
}
