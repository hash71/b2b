<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Debug\Dumper;
use Illuminate\Contracts\Support\Htmlable;


if (!function_exists('country_list')) {
    /**
     * Assign high numeric IDs to a config item to force appending.
     *
     * @param  array $array
     * @return array
     */
    function country_list()
    {
        return [

            'AD' => "Andorra",
            'AE' => "United Arab Emirates",
            'AF' => "Afghanistan",
            'AG' => "Antigua and Barbuda",
            'AI' => "Anguilla",
            'AL' => "Albania",
            'AM' => "Armenia",
            'AN' => "Netherlands Antilles",
            'AO' => "Angola",
            'AQ' => "Antarctica",
            'AR' => "Argentina",
            'AS' => "American Samoa",
            'AT' => "Austria",
            'AU' => "Australia",
            'AW' => "Aruba",
            'AX' => "Åland Islands",
            'AZ' => "Azerbaijan",
            'BA' => "Bosnia and Herzegovina",
            'BB' => "Barbados",
            'BD' => "Bangladesh",
            'BE' => "Belgium",
            'BF' => "Burkina Faso",
            'BG' => "Bulgaria",
            'BH' => "Bahrain",
            'BI' => "Burundi",
            'BJ' => "Benin",
            'BL' => "Saint Barthélemy",
            'BM' => "Bermuda",
            'BN' => "Brunei",
            'BO' => "Bolivia",
            'BQ' => "British Antarctic Territory",
            'BR' => "Brazil",
            'BS' => "Bahamas",
            'BT' => "Bhutan",
            'BV' => "Bouvet Island",
            'BW' => "Botswana",
            'BY' => "Belarus",
            'BZ' => "Belize",
            'CA' => "Canada",
            'CC' => "Cocos [Keeling] Islands",
            'CD' => "Congo - Kinshasa",
            'CF' => "Central African Republic",
            'CG' => "Congo - Brazzaville",
            'CH' => "Switzerland",
            'CI' => "Côte d’Ivoire",
            'CK' => "Cook Islands",
            'CL' => "Chile",
            'CM' => "Cameroon",
            'CN' => "China",
            'CO' => "Colombia",
            'CR' => "Costa Rica",
            'CS' => "Serbia and Montenegro",
            'CT' => "Canton and Enderbury Islands",
            'CU' => "Cuba",
            'CV' => "Cape Verde",
            'CX' => "Christmas Island",
            'CY' => "Cyprus",
            'CZ' => "Czech Republic",
            'DD' => "East Germany",
            'DE' => "Germany",
            'DJ' => "Djibouti",
            'DK' => "Denmark",
            'DM' => "Dominica",
            'DO' => "Dominican Republic",
            'DZ' => "Algeria",
            'EC' => "Ecuador",
            'EE' => "Estonia",
            'EG' => "Egypt",
            'EH' => "Western Sahara",
            'ER' => "Eritrea",
            'ES' => "Spain",
            'ET' => "Ethiopia",
            'FI' => "Finland",
            'FJ' => "Fiji",
            'FK' => "Falkland Islands",
            'FM' => "Micronesia",
            'FO' => "Faroe Islands",
            'FQ' => "French Southern and Antarctic Territories",
            'FR' => "France",
            'FX' => "Metropolitan France",
            'GA' => "Gabon",
            'GB' => "United Kingdom",
            'GD' => "Grenada",
            'GE' => "Georgia",
            'GF' => "French Guiana",
            'GG' => "Guernsey",
            'GH' => "Ghana",
            'GI' => "Gibraltar",
            'GL' => "Greenland",
            'GM' => "Gambia",
            'GN' => "Guinea",
            'GP' => "Guadeloupe",
            'GQ' => "Equatorial Guinea",
            'GR' => "Greece",
            'GS' => "South Georgia and the South Sandwich Islands",
            'GT' => "Guatemala",
            'GU' => "Guam",
            'GW' => "Guinea-Bissau",
            'GY' => "Guyana",
            'HK' => "Hong Kong SAR China",
            'HM' => "Heard Island and McDonald Islands",
            'HN' => "Honduras",
            'HR' => "Croatia",
            'HT' => "Haiti",
            'HU' => "Hungary",
            'ID' => "Indonesia",
            'IE' => "Ireland",
            'IL' => "Israel",
            'IM' => "Isle of Man",
            'IN' => "India",
            'IO' => "British Indian Ocean Territory",
            'IQ' => "Iraq",
            'IR' => "Iran",
            'IS' => "Iceland",
            'IT' => "Italy",
            'JE' => "Jersey",
            'JM' => "Jamaica",
            'JO' => "Jordan",
            'JP' => "Japan",
            'JT' => "Johnston Island",
            'KE' => "Kenya",
            'KG' => "Kyrgyzstan",
            'KH' => "Cambodia",
            'KI' => "Kiribati",
            'KM' => "Comoros",
            'KN' => "Saint Kitts and Nevis",
            'KP' => "North Korea",
            'KR' => "South Korea",
            'KW' => "Kuwait",
            'KY' => "Cayman Islands",
            'KZ' => "Kazakhstan",
            'LA' => "Laos",
            'LB' => "Lebanon",
            'LC' => "Saint Lucia",
            'LI' => "Liechtenstein",
            'LK' => "Sri Lanka",
            'LR' => "Liberia",
            'LS' => "Lesotho",
            'LT' => "Lithuania",
            'LU' => "Luxembourg",
            'LV' => "Latvia",
            'LY' => "Libya",
            'MA' => "Morocco",
            'MC' => "Monaco",
            'MD' => "Moldova",
            'ME' => "Montenegro",
            'MF' => "Saint Martin",
            'MG' => "Madagascar",
            'MH' => "Marshall Islands",
            'MI' => "Midway Islands",
            'MK' => "Macedonia",
            'ML' => "Mali",
            'MM' => "Myanmar [Burma]",
            'MN' => "Mongolia",
            'MO' => "Macau SAR China",
            'MP' => "Northern Mariana Islands",
            'MQ' => "Martinique",
            'MR' => "Mauritania",
            'MS' => "Montserrat",
            'MT' => "Malta",
            'MU' => "Mauritius",
            'MV' => "Maldives",
            'MW' => "Malawi",
            'MX' => "Mexico",
            'MY' => "Malaysia",
            'MZ' => "Mozambique",
            'NA' => "Namibia",
            'NC' => "New Caledonia",
            'NE' => "Niger",
            'NF' => "Norfolk Island",
            'NG' => "Nigeria",
            'NI' => "Nicaragua",
            'NL' => "Netherlands",
            'NO' => "Norway",
            'NP' => "Nepal",
            'NQ' => "Dronning Maud Land",
            'NR' => "Nauru",
            'NT' => "Neutral Zone",
            'NU' => "Niue",
            'NZ' => "New Zealand",
            'OM' => "Oman",
            'PA' => "Panama",
            'PC' => "Pacific Islands Trust Territory",
            'PE' => "Peru",
            'PF' => "French Polynesia",
            'PG' => "Papua New Guinea",
            'PH' => "Philippines",
            'PK' => "Pakistan",
            'PL' => "Poland",
            'PM' => "Saint Pierre and Miquelon",
            'PN' => "Pitcairn Islands",
            'PR' => "Puerto Rico",
            'PS' => "Palestinian Territories",
            'PT' => "Portugal",
            'PU' => "U.S. Miscellaneous Pacific Islands",
            'PW' => "Palau",
            'PY' => "Paraguay",
            'PZ' => "Panama Canal Zone",
            'QA' => "Qatar",
            'RE' => "Réunion",
            'RO' => "Romania",
            'RS' => "Serbia",
            'RU' => "Russia",
            'RW' => "Rwanda",
            'SA' => "Saudi Arabia",
            'SB' => "Solomon Islands",
            'SC' => "Seychelles",
            'SD' => "Sudan",
            'SE' => "Sweden",
            'SG' => "Singapore",
            'SH' => "Saint Helena",
            'SI' => "Slovenia",
            'SJ' => "Svalbard and Jan Mayen",
            'SK' => "Slovakia",
            'SL' => "Sierra Leone",
            'SM' => "San Marino",
            'SN' => "Senegal",
            'SO' => "Somalia",
            'SR' => "Suriname",
            'ST' => "São Tomé and Príncipe",
            'SU' => "Union of Soviet Socialist Republics",
            'SV' => "El Salvador",
            'SY' => "Syria",
            'SZ' => "Swaziland",
            'TC' => "Turks and Caicos Islands",
            'TD' => "Chad",
            'TF' => "French Southern Territories",
            'TG' => "Togo",
            'TH' => "Thailand",
            'TJ' => "Tajikistan",
            'TK' => "Tokelau",
            'TL' => "Timor-Leste",
            'TM' => "Turkmenistan",
            'TN' => "Tunisia",
            'TO' => "Tonga",
            'TR' => "Turkey",
            'TT' => "Trinidad and Tobago",
            'TV' => "Tuvalu",
            'TW' => "Taiwan",
            'TZ' => "Tanzania",
            'UA' => "Ukraine",
            'UG' => "Uganda",
            'UM' => "U.S. Minor Outlying Islands",
            'US' => "United States",
            'UY' => "Uruguay",
            'UZ' => "Uzbekistan",
            'VA' => "Vatican City",
            'VC' => "Saint Vincent and the Grenadines",
            'VD' => "North Vietnam",
            'VE' => "Venezuela",
            'VG' => "British Virgin Islands",
            'VI' => "U.S. Virgin Islands",
            'VN' => "Vietnam",
            'VU' => "Vanuatu",
            'WF' => "Wallis and Futuna",
            'WK' => "Wake Island",
            'WS' => "Samoa",
            'YD' => "People's Democratic Republic of Yemen",
            'YE' => "Yemen",
            'YT' => "Mayotte",
            'ZA' => "South Africa",
            'ZM' => "Zambia",
            'ZW' => "Zimbabwe",
            'ZZ' => "Unknown or Invalid Region"
        ];
    }
}


if (!function_exists('append_config')) {
    /**
     * Assign high numeric IDs to a config item to force appending.
     *
     * @param  array $array
     * @return array
     */
    function append_config(array $array)
    {
        $start = 9999;

        foreach ($array as $key => $value) {
            if (is_numeric($key)) {
                $start++;

                $array[$start] = Arr::pull($array, $key);
            }
        }

        return $array;
    }
}

if (!function_exists('first_image')) {
    /**
     * Assign high numeric IDs to a config item to force appending.
     *
     * @param  array $array
     * @return array
     */
    function first_image($images)
    {
        $images = json_decode($images);

        if(sizeof($images)<=0)
        {
            $result = URL::asset(\App\Http\Controllers\SettingsController::COMMON_PLACEHOLDER_IMAGE);
        }
        else
        {
            $result = $images[0];
        }
        return asset($result);
    }
}

if (!function_exists('array_add')) {
    /**
     * Add an element to an array using "dot" notation if it doesn't exist.
     *
     * @param  array $array
     * @param  string $key
     * @param  mixed $value
     * @return array
     */
    function array_add($array, $key, $value)
    {
        return Arr::add($array, $key, $value);
    }
}

if (!function_exists('array_build')) {
    /**
     * Build a new array using a callback.
     *
     * @param  array $array
     * @param  callable $callback
     * @return array
     */
    function array_build($array, callable $callback)
    {
        return Arr::build($array, $callback);
    }
}

if (!function_exists('array_collapse')) {
    /**
     * Collapse an array of arrays into a single array.
     *
     * @param  \ArrayAccess|array $array
     * @return array
     */
    function array_collapse($array)
    {
        return Arr::collapse($array);
    }
}

if (!function_exists('array_divide')) {
    /**
     * Divide an array into two arrays. One with keys and the other with values.
     *
     * @param  array $array
     * @return array
     */
    function array_divide($array)
    {
        return Arr::divide($array);
    }
}

if (!function_exists('array_dot')) {
    /**
     * Flatten a multi-dimensional associative array with dots.
     *
     * @param  array $array
     * @param  string $prepend
     * @return array
     */
    function array_dot($array, $prepend = '')
    {
        return Arr::dot($array, $prepend);
    }
}

if (!function_exists('array_except')) {
    /**
     * Get all of the given array except for a specified array of items.
     *
     * @param  array $array
     * @param  array|string $keys
     * @return array
     */
    function array_except($array, $keys)
    {
        return Arr::except($array, $keys);
    }
}

if (!function_exists('array_fetch')) {
    /**
     * Fetch a flattened array of a nested array element.
     *
     * @param  array $array
     * @param  string $key
     * @return array
     *
     * @deprecated since version 5.1. Use array_pluck instead.
     */
    function array_fetch($array, $key)
    {
        return Arr::fetch($array, $key);
    }
}

if (!function_exists('array_first')) {
    /**
     * Return the first element in an array passing a given truth test.
     *
     * @param  array $array
     * @param  callable $callback
     * @param  mixed $default
     * @return mixed
     */
    function array_first($array, callable $callback, $default = null)
    {
        return Arr::first($array, $callback, $default);
    }
}

if (!function_exists('array_flatten')) {
    /**
     * Flatten a multi-dimensional array into a single level.
     *
     * @param  array $array
     * @return array
     */
    function array_flatten($array)
    {
        return Arr::flatten($array);
    }
}

if (!function_exists('array_forget')) {
    /**
     * Remove one or many array items from a given array using "dot" notation.
     *
     * @param  array $array
     * @param  array|string $keys
     * @return void
     */
    function array_forget(&$array, $keys)
    {
        return Arr::forget($array, $keys);
    }
}

if (!function_exists('array_get')) {
    /**
     * Get an item from an array using "dot" notation.
     *
     * @param  array $array
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    function array_get($array, $key, $default = null)
    {
        return Arr::get($array, $key, $default);
    }
}

if (!function_exists('array_has')) {
    /**
     * Check if an item exists in an array using "dot" notation.
     *
     * @param  array $array
     * @param  string $key
     * @return bool
     */
    function array_has($array, $key)
    {
        return Arr::has($array, $key);
    }
}

if (!function_exists('array_last')) {
    /**
     * Return the last element in an array passing a given truth test.
     *
     * @param  array $array
     * @param  callable $callback
     * @param  mixed $default
     * @return mixed
     */
    function array_last($array, $callback, $default = null)
    {
        return Arr::last($array, $callback, $default);
    }
}

if (!function_exists('array_only')) {
    /**
     * Get a subset of the items from the given array.
     *
     * @param  array $array
     * @param  array|string $keys
     * @return array
     */
    function array_only($array, $keys)
    {
        return Arr::only($array, $keys);
    }
}

if (!function_exists('array_pluck')) {
    /**
     * Pluck an array of values from an array.
     *
     * @param  array $array
     * @param  string|array $value
     * @param  string|array|null $key
     * @return array
     */
    function array_pluck($array, $value, $key = null)
    {
        return Arr::pluck($array, $value, $key);
    }
}

if (!function_exists('array_prepend')) {
    /**
     * Push an item onto the beginning of an array.
     *
     * @param  array $array
     * @param  mixed $value
     * @param  mixed $key
     * @return array
     */
    function array_prepend($array, $value, $key = null)
    {
        return Arr::prepend($array, $value, $key);
    }
}

if (!function_exists('array_pull')) {
    /**
     * Get a value from the array, and remove it.
     *
     * @param  array $array
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    function array_pull(&$array, $key, $default = null)
    {
        return Arr::pull($array, $key, $default);
    }
}

if (!function_exists('array_set')) {
    /**
     * Set an array item to a given value using "dot" notation.
     *
     * If no key is given to the method, the entire array will be replaced.
     *
     * @param  array $array
     * @param  string $key
     * @param  mixed $value
     * @return array
     */
    function array_set(&$array, $key, $value)
    {
        return Arr::set($array, $key, $value);
    }
}

if (!function_exists('array_sort')) {
    /**
     * Sort the array using the given callback.
     *
     * @param  array $array
     * @param  callable $callback
     * @return array
     */
    function array_sort($array, callable $callback)
    {
        return Arr::sort($array, $callback);
    }
}

if (!function_exists('array_sort_recursive')) {
    /**
     * Recursively sort an array by keys and values.
     *
     * @param  array $array
     * @return array
     */
    function array_sort_recursive($array)
    {
        return Arr::sortRecursive($array);
    }
}

if (!function_exists('array_where')) {
    /**
     * Filter the array using the given callback.
     *
     * @param  array $array
     * @param  callable $callback
     * @return array
     */
    function array_where($array, callable $callback)
    {
        return Arr::where($array, $callback);
    }
}

if (!function_exists('camel_case')) {
    /**
     * Convert a value to camel case.
     *
     * @param  string $value
     * @return string
     */
    function camel_case($value)
    {
        return Str::camel($value);
    }
}

if (!function_exists('class_basename')) {
    /**
     * Get the class "basename" of the given object / class.
     *
     * @param  string|object $class
     * @return string
     */
    function class_basename($class)
    {
        $class = is_object($class) ? get_class($class) : $class;

        return basename(str_replace('\\', '/', $class));
    }
}

if (!function_exists('class_uses_recursive')) {
    /**
     * Returns all traits used by a class, its subclasses and trait of their traits.
     *
     * @param  string $class
     * @return array
     */
    function class_uses_recursive($class)
    {
        $results = [];

        foreach (array_merge([$class => $class], class_parents($class)) as $class) {
            $results += trait_uses_recursive($class);
        }

        return array_unique($results);
    }
}

if (!function_exists('collect')) {
    /**
     * Create a collection from the given value.
     *
     * @param  mixed $value
     * @return \Illuminate\Support\Collection
     */
    function collect($value = null)
    {
        return new Collection($value);
    }
}

if (!function_exists('data_get')) {
    /**
     * Get an item from an array or object using "dot" notation.
     *
     * @param  mixed $target
     * @param  string|array $key
     * @param  mixed $default
     * @return mixed
     */
    function data_get($target, $key, $default = null)
    {
        if (is_null($key)) {
            return $target;
        }

        $key = is_array($key) ? $key : explode('.', $key);

        foreach ($key as $segment) {
            if (is_array($target)) {
                if (!array_key_exists($segment, $target)) {
                    return value($default);
                }

                $target = $target[$segment];
            } elseif ($target instanceof ArrayAccess) {
                if (!isset($target[$segment])) {
                    return value($default);
                }

                $target = $target[$segment];
            } elseif (is_object($target)) {
                if (!isset($target->{$segment})) {
                    return value($default);
                }

                $target = $target->{$segment};
            } else {
                return value($default);
            }
        }

        return $target;
    }
}

if (!function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function dd()
    {
        array_map(function ($x) {
            (new Dumper)->dump($x);
        }, func_get_args());

        die(1);
    }
}

if (!function_exists('e')) {
    /**
     * Escape HTML entities in a string.
     *
     * @param  \Illuminate\Contracts\Support\Htmlable|string $value
     * @return string
     */
    function e($value)
    {
        if ($value instanceof Htmlable) {
            return $value->toHtml();
        }

        return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
    }
}

if (!function_exists('ends_with')) {
    /**
     * Determine if a given string ends with a given substring.
     *
     * @param  string $haystack
     * @param  string|array $needles
     * @return bool
     */
    function ends_with($haystack, $needles)
    {
        return Str::endsWith($haystack, $needles);
    }
}

if (!function_exists('head')) {
    /**
     * Get the first element of an array. Useful for method chaining.
     *
     * @param  array $array
     * @return mixed
     */
    function head($array)
    {
        return reset($array);
    }
}

if (!function_exists('last')) {
    /**
     * Get the last element from an array.
     *
     * @param  array $array
     * @return mixed
     */
    function last($array)
    {
        return end($array);
    }
}

if (!function_exists('object_get')) {
    /**
     * Get an item from an object using "dot" notation.
     *
     * @param  object $object
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    function object_get($object, $key, $default = null)
    {
        if (is_null($key) || trim($key) == '') {
            return $object;
        }

        foreach (explode('.', $key) as $segment) {
            if (!is_object($object) || !isset($object->{$segment})) {
                return value($default);
            }

            $object = $object->{$segment};
        }

        return $object;
    }
}

if (!function_exists('preg_replace_sub')) {
    /**
     * Replace a given pattern with each value in the array in sequentially.
     *
     * @param  string $pattern
     * @param  array $replacements
     * @param  string $subject
     * @return string
     */
    function preg_replace_sub($pattern, &$replacements, $subject)
    {
        return preg_replace_callback($pattern, function ($match) use (&$replacements) {
            foreach ($replacements as $key => $value) {
                return array_shift($replacements);
            }

        }, $subject);
    }
}

if (!function_exists('snake_case')) {
    /**
     * Convert a string to snake case.
     *
     * @param  string $value
     * @param  string $delimiter
     * @return string
     */
    function snake_case($value, $delimiter = '_')
    {
        return Str::snake($value, $delimiter);
    }
}

if (!function_exists('starts_with')) {
    /**
     * Determine if a given string starts with a given substring.
     *
     * @param  string $haystack
     * @param  string|array $needles
     * @return bool
     */
    function starts_with($haystack, $needles)
    {
        return Str::startsWith($haystack, $needles);
    }
}

if (!function_exists('str_contains')) {
    /**
     * Determine if a given string contains a given substring.
     *
     * @param  string $haystack
     * @param  string|array $needles
     * @return bool
     */
    function str_contains($haystack, $needles)
    {
        return Str::contains($haystack, $needles);
    }
}

if (!function_exists('str_finish')) {
    /**
     * Cap a string with a single instance of a given value.
     *
     * @param  string $value
     * @param  string $cap
     * @return string
     */
    function str_finish($value, $cap)
    {
        return Str::finish($value, $cap);
    }
}

if (!function_exists('str_is')) {
    /**
     * Determine if a given string matches a given pattern.
     *
     * @param  string $pattern
     * @param  string $value
     * @return bool
     */
    function str_is($pattern, $value)
    {
        return Str::is($pattern, $value);
    }
}

if (!function_exists('str_limit')) {
    /**
     * Limit the number of characters in a string.
     *
     * @param  string $value
     * @param  int $limit
     * @param  string $end
     * @return string
     */
    function str_limit($value, $limit = 100, $end = '...')
    {
        return Str::limit($value, $limit, $end);
    }
}

if (!function_exists('str_plural')) {
    /**
     * Get the plural form of an English word.
     *
     * @param  string $value
     * @param  int $count
     * @return string
     */
    function str_plural($value, $count = 2)
    {
        return Str::plural($value, $count);
    }
}

if (!function_exists('str_random')) {
    /**
     * Generate a more truly "random" alpha-numeric string.
     *
     * @param  int $length
     * @return string
     *
     * @throws \RuntimeException
     */
    function str_random($length = 16)
    {
        return Str::random($length);
    }
}

if (!function_exists('str_replace_array')) {
    /**
     * Replace a given value in the string sequentially with an array.
     *
     * @param  string $search
     * @param  array $replace
     * @param  string $subject
     * @return string
     */
    function str_replace_array($search, array $replace, $subject)
    {
        foreach ($replace as $value) {
            $subject = preg_replace('/' . $search . '/', $value, $subject, 1);
        }

        return $subject;
    }
}

if (!function_exists('str_singular')) {
    /**
     * Get the singular form of an English word.
     *
     * @param  string $value
     * @return string
     */
    function str_singular($value)
    {
        return Str::singular($value);
    }
}

if (!function_exists('str_slug')) {
    /**
     * Generate a URL friendly "slug" from a given string.
     *
     * @param  string $title
     * @param  string $separator
     * @return string
     */
    function str_slug($title, $separator = '-')
    {
        return Str::slug($title, $separator);
    }
}

if (!function_exists('studly_case')) {
    /**
     * Convert a value to studly caps case.
     *
     * @param  string $value
     * @return string
     */
    function studly_case($value)
    {
        return Str::studly($value);
    }
}

if (!function_exists('title_case')) {
    /**
     * Convert a value to title case.
     *
     * @param  string $value
     * @return string
     */
    function title_case($value)
    {
        return Str::title($value);
    }
}

if (!function_exists('trait_uses_recursive')) {
    /**
     * Returns all traits used by a trait and its traits.
     *
     * @param  string $trait
     * @return array
     */
    function trait_uses_recursive($trait)
    {
        $traits = class_uses($trait);

        foreach ($traits as $trait) {
            $traits += trait_uses_recursive($trait);
        }

        return $traits;
    }
}

if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('with')) {
    /**
     * Return the given object. Useful for chaining.
     *
     * @param  mixed $object
     * @return mixed
     */
    function with($object)
    {
        return $object;
    }
}

if (!function_exists('ttruncate')) {
    function ttruncat($text, $numb)
    {
        if (strlen($text) > $numb) {
            $text = substr($text, 0, $numb);
            $text = substr($text, 0, strrpos($text, " "));
            $etc = " ...";
            $text = $text . $etc;
        }
        return $text;
    }

}
