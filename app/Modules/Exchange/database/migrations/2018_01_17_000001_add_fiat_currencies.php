<?php

use Database\Table;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Minix\Exchange\Models\Currency;

class AddFiatCurrencies extends Migration
{
    public function up()
    {
        $map = function ($currency) {
            return array_merge($currency, [
                'id' => (Currency::$fiatPrefix).$currency['id'],
            ]);
        };

        DB::table(Table::CURRENCIES)->insert(array_map($map, [
            [
                'id' => 'AED',
                'name' => 'United Arab Emirates Dirham',
                'symbol' => 'د.إ',
            ],
            [
                'id' => 'AFN',
                'name' => 'Afghan Afghani',
                'symbol' => '؋',
            ],
            [
                'id' => 'ALL',
                'name' => 'Albanian Lek',
                'symbol' => 'ALL',
            ],
            [
                'id' => 'AMD',
                'name' => 'Armenian Dram',
                'symbol' => '֏',
            ],
            [
                'id' => 'ANG',
                'name' => 'Netherlands Antillean Guilder',
                'symbol' => 'ƒ',
            ],
            [
                'id' => 'AOA',
                'name' => 'Angolan Kwanza',
                'symbol' => 'Kz',
            ],
            [
                'id' => 'ARS',
                'name' => 'Argentine Peso',
                'symbol' => '$',
            ],
            [
                'id' => 'AUD',
                'name' => 'Australian Dollar',
                'symbol' => '$',
            ],
            [
                'id' => 'AWG',
                'name' => 'Aruban Florin',
                'symbol' => 'Afl.',
            ],
            [
                'id' => 'AZN',
                'name' => 'Azerbaijani Manat',
                'symbol' => '₼',
            ],
            // B
            [
                'id' => 'BAM',
                'name' => 'Bosnia-Herzegovina Convertible Mark',
                'symbol' => 'KM',
            ],
            [
                'id' => 'BBD',
                'name' => 'Barbadian Dollar',
                'symbol' => '$',
            ],
            [
                'id' => 'BDT',
                'name' => 'Bangladeshi Taka',
                'symbol' => '‎৳',
            ],
            [
                'id' => 'BGN',
                'name' => 'Bulgarian Lev',
                'symbol' => 'лв',
            ],
            [
                'id' => 'BHD',
                'name' => 'Bahraini Dinar',
                'symbol' => 'د.ب',
            ],
            [
                'id' => 'BIF',
                'name' => 'Burundian Franc',
                'symbol' => 'FBu',
            ],
            [
                'id' => 'BMD',
                'name' => 'Bermudan Dollar',
                'symbol' => '$',
            ],
            [
                'id' => 'BND',
                'name' => 'Brunei Dollar',
                'symbol' => '$',
            ],
            [
                'id' => 'BOB',
                'name' => 'Bolivian Boliviano',
                'symbol' => '‎Bs.',
            ],
            [
                'id' => 'BRL',
                'name' => 'Brazilian Real',
                'symbol' => 'R$',
            ],
            [
                'id' => 'BSD',
                'name' => 'Bahamian Dollar',
                'symbol' => '$',
            ],
            [
                'id' => 'BTN',
                'name' => 'Bhutanese Ngultrum',
                'symbol' => 'Nu',
            ],
            [
                'id' => 'BWP',
                'name' => 'Botswanan Pula',
                'symbol' => 'P',
            ],
            [
                'id' => 'BYN',
                'name' => 'Belarusian Ruble',
                'symbol' => 'Br',
            ],
            [
                'id' => 'BZD',
                'name' => 'Belize Dollar',
                'symbol' => '$',
            ],
            // C
            [
                'id' => 'CAD',
                'name' => 'Canadian Dollar',
                'symbol' => '$',
            ],
            [
                'id' => 'CDF',
                'name' => 'Congolese Franc',
                'symbol' => 'FC',
            ],
            [
                'id' => 'CHF',
                'name' => 'Swiss Franc',
                'symbol' => 'CHF',
            ],
            [
                'id' => 'CLP',
                'name' => 'Chilean Peso',
                'symbol' => '$',
            ],
            [
                'id' => 'CNY',
                'name' => 'Chinese Yuan',
                'symbol' => '¥',
            ],
            [
                'id' => 'COP',
                'name' => 'Colombian Peso',
                'symbol' => '$',
            ],
            [
                'id' => 'CRC',
                'name' => 'Costa Rican Colón',
                'symbol' => '₡',
            ],
            [
                'id' => 'CUC',
                'name' => 'Cuban Convertible Peso',
                'symbol' => '$',
            ],
            [
                'id' => 'CUP',
                'name' => 'Cuban Peso',
                'symbol' => '₱',
            ],
            [
                'id' => 'CVE',
                'name' => 'Cape Verdean Escudo',
                'symbol' => '$',
            ],
            [
                'id' => 'CZK',
                'name' => 'Czech Koruna',
                'symbol' => 'Kč',
            ],
            // D
            [
                'id' => 'DJF',
                'name' => 'Djiboutian Franc',
                'symbol' => '‎Fdj',
            ],
            [
                'id' => 'DKK',
                'name' => 'Danish Krone',
                'symbol' => 'kr',
            ],
            [
                'id' => 'DOP',
                'name' => 'Dominican Peso',
                'symbol' => 'RD$',
            ],
            [
                'id' => 'DZD',
                'name' => 'Algerian Dinar',
                'symbol' => 'دج',
            ],
            // E
            [
                'id' => 'EGP',
                'name' => 'Egyptian Pound',
                'symbol' => '‎E£',
            ],
            [
                'id' => 'ERN',
                'name' => 'Eritrean Nakfa',
                'symbol' => '‎Nfk',
            ],
            [
                'id' => 'ETB',
                'name' => 'Ethiopian Birr',
                'symbol' => 'Br',
            ],
            [
                'id' => 'EUR',
                'name' => 'Euro',
                'symbol' => '€',
            ],
            // F
            [
                'id' => 'FJD',
                'name' => 'Fijian Dollar',
                'symbol' => '$',
            ],
            [
                'id' => 'FKP',
                'name' => 'Falkland Islands Pound',
                'symbol' => '$',
                'symbol' => '£',
            ],
            // G
            [
                'id' => 'GBP',
                'name' => 'British Pound',
                'symbol' => '£',
            ],
            [
                'id' => 'GEL',
                'name' => 'Georgian Lari',
                'symbol' => 'GEL',
            ],
            [
                'id' => 'GGP',
                'name' => 'Guernsey Pound',
                'symbol' => '£',
            ],
            [
                'id' => 'GHS',
                'name' => 'Ghanaian Cedi',
                'symbol' => 'GH₵',
            ],
            [
                'id' => 'GIP',
                'name' => 'Gibraltar Pound',
                'symbol' => '£',
            ],
            [
                'id' => 'GMD',
                'name' => 'Gambian Dalasi',
                'symbol' => 'D',
            ],
            [
                'id' => 'GNF',
                'name' => 'Guinean Franc',
                'symbol' => 'FG',
            ],
            [
                'id' => 'GTQ',
                'name' => 'Guatemalan Quetzal',
                'symbol' => 'Q',
            ],
            [
                'id' => 'GYD',
                'name' => 'Guyanaese Dollar',
                'symbol' => '$',
            ],
            // H
            [
                'id' => 'HKD',
                'name' => 'Hong Kong Dollar',
                'symbol' => '$',
            ],
            [
                'id' => 'HNL',
                'name' => 'Honduran Lempira',
                'symbol' => 'L',
            ],
            [
                'id' => 'HRK',
                'name' => 'Croatian Kuna',
                'symbol' => 'kn',
            ],
            [
                'id' => 'HTG',
                'name' => 'Haitian Gourde',
                'symbol' => 'G',
            ],
            [
                'id' => 'HUF',
                'name' => 'Hungarian Forint',
                'symbol' => 'Ft',
            ],
            // I
            [
                'id' => 'IDR',
                'name' => 'Indonesian Rupiah',
                'symbol' => 'Rp',
            ],
            [
                'id' => 'ILS',
                'name' => 'Israeli New Shekel',
                'symbol' => '₪',
            ],
            [
                'id' => 'IMP',
                'name' => 'Isle of Man Pound',
                'symbol' => '£',
            ],
            [
                'id' => 'INR',
                'name' => 'Indian Rupee',
                'symbol' => '₹',
            ],
            [
                'id' => 'IQD',
                'name' => 'Iraqi Dinar',
                'symbol' => 'د.ع',
            ],
            [
                'id' => 'IRR',
                'name' => 'Iranian Rial',
                'symbol' => '﷼',
            ],
            [
                'id' => 'ISK',
                'name' => 'Icelandic Króna',
                'symbol' => 'kr',
            ],
            // J
            [
                'id' => 'JEP',
                'name' => 'Jersey Pound',
                'symbol' => '£',
            ],
            [
                'id' => 'JMD',
                'name' => 'Jamaican Dollar',
                'symbol' => '$',
            ],
            [
                'id' => 'JOD',
                'name' => 'Jordanian Dinar',
                'symbol' => 'JD',
            ],
            [
                'id' => 'JPY',
                'name' => 'Japanese Yen',
                'symbol' => '¥',
            ],
            // K
            [
                'id' => 'KES',
                'name' => 'Kenyan Shilling',
                'symbol' => 'KSh',
            ],
            [
                'id' => 'KGS',
                'name' => 'Kyrgyzstani Som',
                'symbol' => 'C',
            ],
            [
                'id' => 'KHR',
                'name' => 'Cambodian Riel',
                'symbol' => '៛',
            ],
            [
                'id' => 'KMF',
                'name' => 'Comorian Franc',
                'symbol' => 'CF',
            ],
            [
                'id' => 'KPW',
                'name' => 'North Korean Won',
                'symbol' => '₩',
            ],
            [
                'id' => 'KRW',
                'name' => 'South Korean Won',
                'symbol' => '₩',
            ],
            [
                'id' => 'KWD',
                'name' => 'Kuwaiti Dinar',
                'symbol' => '‎د.ك',
            ],
            [
                'id' => 'KYD',
                'name' => 'Cayman Islands Dollar',
                'symbol' => '$',
            ],
            [
                'id' => 'KZT',
                'name' => 'Kazakhstani Tenge',
                'symbol' => '₸',
            ],
            // L
            [
                'id' => 'LAK',
                'name' => 'Laotian Kip',
                'symbol' => '₭',
            ],
            [
                'id' => 'LBP',
                'name' => 'Lebanese Pound',
                'symbol' => '£',
            ],
            [
                'id' => 'LKR',
                'name' => 'Sri Lankan Rupee',
                'symbol' => 'Rs',
            ],
            [
                'id' => 'LRD',
                'name' => 'Liberian Dollar',
                'symbol' => 'L$',
            ],
            [
                'id' => 'LSL',
                'name' => 'Lesotho Loti',
                'symbol' => 'L',
            ],
            [
                'id' => 'LYD',
                'name' => 'Libyan Dinar',
                'symbol' => 'LD',
            ],
            // M
            [
                'id' => 'MAD',
                'name' => 'Moroccan Dirham',
                'symbol' => 'DH',
            ],
            [
                'id' => 'MDL',
                'name' => 'Moldovan Leu',
                'symbol' => 'LEU',
            ],
            [
                'id' => 'MGA',
                'name' => 'Malagasy Ariary',
                'symbol' => 'Ar',
            ],
            [
                'id' => 'MKD',
                'name' => 'Macedonian Denar',
                'symbol' => 'ден',
            ],
            [
                'id' => 'MMK',
                'name' => 'Myanmar Kyat',
                'symbol' => 'K',
            ],
            [
                'id' => 'MNT',
                'name' => 'Mongolian Tugrik',
                'symbol' => '₮',
            ],
            [
                'id' => 'MOP',
                'name' => 'Macanese Pataca',
                'symbol' => 'MOP$',
            ],
            [
                'id' => 'MRU',
                'name' => 'Mauritanian Ouguiya',
                'symbol' => '₨',
            ],
            [
                'id' => 'MUR',
                'name' => 'Mauritian Rupee',
                'symbol' => '₨',
            ],
            [
                'id' => 'MVR',
                'name' => 'Maldivian Rufiyaa',
                'symbol' => 'Rf',
            ],
            [
                'id' => 'MWK',
                'name' => 'Malawian Kwacha',
                'symbol' => '‎MK',
            ],
            [
                'id' => 'MXN',
                'name' => 'Mexican Peso',
                'symbol' => '$',
            ],
            [
                'id' => 'MYR',
                'name' => 'Malaysian Ringgit',
                'symbol' => 'RM',
            ],
            [
                'id' => 'MZN',
                'name' => 'Mozambican Metical',
                'symbol' => 'MT',
            ],
            // N
            [
                'id' => 'NAD',
                'name' => 'Namibian Dollar',
                'symbol' => '$',
            ],
            [
                'id' => 'NGN',
                'name' => 'Nigerian Naira',
                'symbol' => '₦',
            ],
            [
                'id' => 'NIO',
                'name' => 'Nicaraguan Córdoba',
                'symbol' => 'C$',
            ],
            [
                'id' => 'NOK',
                'name' => 'Norwegian Krone',
                'symbol' => 'kr',
            ],
            [
                'id' => 'NPR',
                'name' => 'Nepalese Rupee',
                'symbol' => '₨',
            ],
            [
                'id' => 'NZD',
                'name' => 'New Zealand Dollar',
                'symbol' => '$',
            ],
            // O
            [
                'id' => 'OMR',
                'name' => 'Omani Rial',
                'symbol' => '﷼',
            ],
            // P
            [
                'id' => 'PAB',
                'name' => 'Panamanian Balboa',
                'symbol' => 'B/.',
            ],
            [
                'id' => 'PEN',
                'name' => 'Peruvian Sol',
                'symbol' => 'S/.',
            ],
            [
                'id' => 'PGK',
                'name' => 'Papua New Guinean Kina',
                'symbol' => 'K',
            ],
            [
                'id' => 'PHP',
                'name' => 'Philippine Piso',
                'symbol' => '₱',
            ],
            [
                'id' => 'PKR',
                'name' => 'Pakistani Rupee',
                'symbol' => '₨',
            ],
            [
                'id' => 'PLN',
                'name' => 'Polish Zloty',
                'symbol' => 'zł',
            ],
            [
                'id' => 'PYG',
                'name' => 'Paraguayan Guarani',
                'symbol' => 'Gs',
            ],
            // Q
            [
                'id' => 'QAR',
                'name' => 'Qatari Rial',
                'symbol' => 'ر.ق',
            ],
            // R
            [
                'id' => 'RON',
                'name' => 'Romanian Leu',
                'symbol' => 'lei',
            ],
            [
                'id' => 'RSD',
                'name' => 'Serbian Dinar',
                'symbol' => 'Дин.',
            ],
            [
                'id' => 'RUB',
                'name' => 'Russian Ruble',
                'symbol' => '₽',
            ],
            [
                'id' => 'RWF',
                'name' => 'Rwandan Franc',
                'symbol' => 'R₣',
            ],
            // S
            [
                'id' => 'SAR',
                'name' => 'Saudi Riyal',
                'symbol' => 'ر.س',
            ],
            [
                'id' => 'SBD',
                'name' => 'Solomon Islands Dollar',
                'symbol' => 'SI$',
            ],
            [
                'id' => 'SCR',
                'name' => 'Seychellois Rupee',
                'symbol' => '₨',
            ],
            [
                'id' => 'SDG',
                'name' => 'Sudanese Pound',
                'symbol' => 'SD',
            ],
            [
                'id' => 'SEK',
                'name' => 'Swedish Krona',
                'symbol' => 'kr',
            ],
            [
                'id' => 'SGD',
                'name' => 'Singapore Dollar',
                'symbol' => '$',
            ],
            [
                'id' => 'SHP',
                'name' => 'St. Helena Pound',
                'symbol' => '£',
            ],
            [
                'id' => 'SLL',
                'name' => 'Sierra Leonean Leone',
                'symbol' => 'Le',
            ],
            [
                'id' => 'SOS',
                'name' => 'Somali Shilling',
                'symbol' => 'Sh.So.',
            ],
            [
                'id' => 'SPL',
                'name' => 'Seborgan Luigino',
                'symbol' => 'SPL',
            ],
            [
                'id' => 'SRD',
                'name' => 'Surinamese Dollar',
                'symbol' => '$',
            ],
            [
                'id' => 'STN',
                'name' => 'São Tomé & Príncipe Dobra',
                'symbol' => 'Db',
            ],
            [
                'id' => 'SVC',
                'name' => 'Salvadoran Colón',
                'symbol' => '₡',
            ],
            [
                'id' => 'SYP',
                'name' => 'Syrian Pound',
                'symbol' => '£',
            ],
            [
                'id' => 'SZL',
                'name' => 'Swazi Lilangeni',
                'symbol' => '‎L',
            ],
            // T
            [
                'id' => 'THB',
                'name' => 'Thai Baht',
                'symbol' => '฿',
            ],
            [
                'id' => 'TJS',
                'name' => 'Tajikistani Somoni',
                'symbol' => 'TJS',
            ],
            [
                'id' => 'TMT',
                'name' => 'Turkmenistani Manat',
                'symbol' => 'T',
            ],
            [
                'id' => 'TND',
                'name' => 'Tunisian Dinar',
                'symbol' => 'د.ت',
            ],
            [
                'id' => 'TOP',
                'name' => 'Tongan Paʻanga',
                'symbol' => 'T$',
            ],
            [
                'id' => 'TRY',
                'name' => 'Turkish Lira',
                'symbol' => '₺',
            ],
            [
                'id' => 'TTD',
                'name' => 'Trinidad & Tobago Dollar',
                'symbol' => 'TT$',
            ],
            [
                'id' => 'TVD',
                'name' => 'Tuvaluan Dollar',
                'symbol' => '$',
            ],
            [
                'id' => 'TWD',
                'name' => 'New Taiwan Dollar',
                'symbol' => 'NT$',
            ],
            [
                'id' => 'TZS',
                'name' => 'Tanzanian Shilling',
                'symbol' => '‎TSh',
            ],
            // U
            [
                'id' => 'UAH',
                'name' => 'Ukrainian Hryvnia',
                'symbol' => '₴',
            ],
            [
                'id' => 'UGX',
                'name' => 'Ugandan Shilling',
                'symbol' => 'USh',
            ],
            [
                'id' => 'USD',
                'name' => 'United States Dollar',
                'symbol' => '$',
            ],
            [
                'id' => 'UYU',
                'name' => 'Uruguayan Peso',
                'symbol' => '$U',
            ],
            [
                'id' => 'UZS',
                'name' => 'Uzbekistani Som',
                'symbol' => 'soʻm',
            ],
            // V
            [
                'id' => 'VEF',
                'name' => 'Venezuelan Bolívar',
                'symbol' => 'Bs.',
            ],
            [
                'id' => 'VND',
                'name' => 'Vietnamese Dong',
                'symbol' => '₫',
            ],
            [
                'id' => 'VUV',
                'name' => 'Vanuatu Vatu',
                'symbol' => 'VT',
            ],
            // W
            [
                'id' => 'WST',
                'name' => 'Samoan Tala',
                'symbol' => 'WS$',
            ],
            // X
            [
                'id' => 'XAF',
                'name' => 'Central African CFA Franc',
                'symbol' => 'FCFA',
            ],
            [
                'id' => 'XCD',
                'name' => 'East Caribbean Dollar',
                'symbol' => '$',
            ],
            [
                'id' => 'XDR',
                'name' => 'Special Drawing Rights',
                'symbol' => 'SDR',
            ],
            [
                'id' => 'XOF',
                'name' => 'West African CFA Franc',
                'symbol' => 'CFA',
            ],
            [
                'id' => 'XPF',
                'name' => 'CFP Franc',
                'symbol' => 'CFP',
            ],
            // Y
            [
                'id' => 'YER',
                'name' => 'Yemeni Rial',
                'symbol' => '﷼',
            ],
            // Z
            [
                'id' => 'ZAR',
                'name' => 'South African Rand',
                'symbol' => 'R',
            ],
            [
                'id' => 'ZMW',
                'name' => 'Zambian Kwacha',
                'symbol' => 'ZK',
            ],
            [
                'id' => 'ZWD',
                'name' => 'Zimbabwean Dollar',
                'symbol' => '$',
            ],
        ]));
    }

    public function down()
    {
        // no-op
    }
}
