<?php

namespace PragmaRX\Tracker\Support;

class DeviceAttributes
{
    public const STRING_KEYS = ['kind', 'model', 'platform', 'platform_version'];

    /**
     * SQL Server nvarchar columns must be compared as strings.
     * Jenssegers/Agent can return int 0 / false for unknown model; a query
     * like WHERE model = 0 then tries to CAST existing values ('Bot') to int.
     */
    public static function normalize(array $data): array
    {
        foreach (self::STRING_KEYS as $key) {
            if (!array_key_exists($key, $data)) {
                continue;
            }

            $value = $data[$key];

            if ($value === null || $value === false) {
                $data[$key] = '';
            } else {
                $data[$key] = (string) $value;
            }
        }

        return $data;
    }
}
