<?php

namespace App\Helpers;

// CountryHelper provides a centralized source for country data
class CountryHelper
{
    // Retrieves a comprehensive list of supported countries
    public static function getAll(): array
    {
        return [
            // Asia & Oceania
            ['name' => 'Sri Lanka', 'code' => 'LK', 'dial_code' => '+94'],
            ['name' => 'India', 'code' => 'IN', 'dial_code' => '+91'],
            ['name' => 'Australia', 'code' => 'AU', 'dial_code' => '+61'],
            ['name' => 'Japan', 'code' => 'JP', 'dial_code' => '+81'],
            ['name' => 'China', 'code' => 'CN', 'dial_code' => '+86'],
            ['name' => 'Singapore', 'code' => 'SG', 'dial_code' => '+65'],
            ['name' => 'Malaysia', 'code' => 'MY', 'dial_code' => '+60'],
            ['name' => 'New Zealand', 'code' => 'NZ', 'dial_code' => '+64'],
            ['name' => 'Thailand', 'code' => 'TH', 'dial_code' => '+66'],
            ['name' => 'Vietnam', 'code' => 'VN', 'dial_code' => '+84'],
            ['name' => 'Indonesia', 'code' => 'ID', 'dial_code' => '+62'],
            ['name' => 'Pakistan', 'code' => 'PK', 'dial_code' => '+92'],
            ['name' => 'Bangladesh', 'code' => 'BD', 'dial_code' => '+880'],
            ['name' => 'Maldives', 'code' => 'MV', 'dial_code' => '+960'],

            // North America
            ['name' => 'United States', 'code' => 'US', 'dial_code' => '+1'],
            ['name' => 'Canada', 'code' => 'CA', 'dial_code' => '+1'],

            // Europe
            ['name' => 'United Kingdom', 'code' => 'GB', 'dial_code' => '+44'],
            ['name' => 'Germany', 'code' => 'DE', 'dial_code' => '+49'],
            ['name' => 'France', 'code' => 'FR', 'dial_code' => '+33'],
            ['name' => 'Italy', 'code' => 'IT', 'dial_code' => '+39'],
            ['name' => 'Spain', 'code' => 'ES', 'dial_code' => '+34'],
            ['name' => 'Netherlands', 'code' => 'NL', 'dial_code' => '+31'],
            ['name' => 'Switzerland', 'code' => 'CH', 'dial_code' => '+41'],
            ['name' => 'Sweden', 'code' => 'SE', 'dial_code' => '+46'],
            ['name' => 'Norway', 'code' => 'NO', 'dial_code' => '+47'],
            ['name' => 'Denmark', 'code' => 'DK', 'dial_code' => '+45'],
            ['name' => 'Belgium', 'code' => 'BE', 'dial_code' => '+32'],
            ['name' => 'Ireland', 'code' => 'IE', 'dial_code' => '+353'],
            ['name' => 'Portugal', 'code' => 'PT', 'dial_code' => '+351'],
            ['name' => 'Greece', 'code' => 'GR', 'dial_code' => '+30'],
            ['name' => 'Turkey', 'code' => 'TR', 'dial_code' => '+90'],
            ['name' => 'Russia', 'code' => 'RU', 'dial_code' => '+7'],

            // Middle East & Africa
            ['name' => 'United Arab Emirates', 'code' => 'AE', 'dial_code' => '+971'],
            ['name' => 'South Africa', 'code' => 'ZA', 'dial_code' => '+27'],

            // South America
            ['name' => 'Brazil', 'code' => 'BR', 'dial_code' => '+55'],
        ];
    }
}
