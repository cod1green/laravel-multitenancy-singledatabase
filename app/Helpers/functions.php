<?php

use Gloudemans\Shoppingcart\Facades\Cart;

/*if (!function_exists('setting')) {
    function setting($key)
    {
        $setting = Illuminate\Support\Facades\Cache::rememberForever(
            'setting',
            function () {
                return App\Models\Setting::first() ?? App\Models\Setting::factory()->make(
                        [
                            'site_name' => config('app.name', 'Laravel Admin'),
                            'site_title' => ucfirst(config('admin.prefix', 'admin')),
                            'site_email' => env('APP_ADMIN_EMAIL', 'mail@example.com'),
                            'footer_name' => config('app.name', 'Laravel Admin'),
                            'sidebar_collapse' => false,
                        ]
                    );
            }
        );

        if ($setting) {
            return $setting->{$key};
        }
    }
}*/

if (!function_exists('presentDate')) {
    function presentDate($date)
    {
        return \Illuminate\Support\Carbon::parse($date)->format('d M, Y');
    }
}

if (!function_exists('getStockLevel')) {
    /**
     * Função retorna uma string em html conforma a quantidade minima.
     *
     * @param  int  $quantity
     * @param  int  $minQuantity
     * @return string
     */
    function getStockLevel(int $quantity, int $minQuantity): string
    {
        if ($quantity > $minQuantity) {
            return '<div class="badge badge-success">Em estoque</div>';
        }

        if ($quantity <= $minQuantity && $quantity > 0) {
            return '<div class="badge badge-warning">Estoque baixo</div>';
        }

        return '<div class="badge badge-danger">Não disponível</div>';
    }
}

if (!function_exists('cartProductsToJson')) {
    /**
     * Retorna uma string em json com os produtos da carrinho na sessão
     *
     * @return string
     */
    function cartProductsToJson(): string
    {
        return Cart::instance('default')->content()->map(
            fn($item) => $item->model->slug . ', ' . $item->qty
        )->values()->toJson();
    }
}

if (!function_exists('cart')) {
    /**
     * Retorno uma collection com os novo valores e taxas do carrinho na sessão
     *
     * @return \Illuminate\Support\Collection
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function cart(): \Illuminate\Support\Collection
    {
        $tax = config('cart.tax') / 100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $code = session()->get('coupon')['name'] ?? null;
        $newSubtotal = (Cart::instance('default')->subtotal() - $discount);
        if ($newSubtotal < 0) {
            $newSubtotal = 0;
        }
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1 + $tax);

        $products = [];
        foreach (Cart::instance('default')->content() as $item) {
            $products [] = [
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
                'price' => $item->model->price,
            ];
        }

        return collect(
            [
                'tax' => $tax,
                'discount' => $discount,
                'code' => $code,
                'newSubtotal' => $newSubtotal,
                'newTax' => $newTax,
                'newTotal' => $newTotal,
                'products' => $products
            ]
        );
    }
}

if (!function_exists('setActiveCategory')) {
    /**
     * Retorna string class se a condição for verdadeira
     *
     * @param $category
     * @param  string  $output
     * @return string
     */
    function setActiveCategory($category, $output = 'active'): string
    {
        return request()->category === $category ? $output : '';
    }
}

if (!function_exists('formatPriceDb')) {
    function formatPriceDb($price)
    {
        return str_replace(array('.', ','), array('', '.'), $price);
    }
}

if (!function_exists('presentPrice')) {
    function presentPrice($price)
    {
        $price = str_replace(',', '', $price);
        return 'R$' . number_format($price, 2, ',', '.');
    }
}

if (!function_exists('localizedMarkdownPath')) {
    /**
     * Find the path to a localized Markdown resource.
     *
     * @param  string  $name
     * @return string|null
     */
    function localizedMarkdownPath(string $name): ?string
    {
        $localName = preg_replace('#(\.md)$#i', '.' . app()->getLocale() . '$1', $name);

        return Illuminate\Support\Arr::first(
            [
                resource_path('markdown/' . $localName),
                resource_path('markdown/' . $name),
            ],
            function ($path) {
                return file_exists($path);
            }
        );
    }
}

if (!function_exists('parseLocale')) {
    /**
     * Obtem a localização com base na URL
     *
     * @return String localização
     */
    function parseLocale()
    {
        $request = request()->segment(1);

        // Verifica se o $request passado tem '-'
        // Se sim, então muda o idioma Exe: pt-br para pt-BR
        if (($pos = strpos($request, '-')) !== false) {
            $array = explode('-', $request);
            $request = $array[0] . '-' . strtoupper($array[1]);
        }

        // Se não existir idioma na URL, define um padrão
        $locale = config('admin.default_locale');

        // Verifica se existe idioma na URL
        // Se sim, altera para o idioma da URL
        if (!empty($request) && in_array(($request), config('admin.locales'))) {
            $locale = $request;
        }

        // Seta idioma na aplicação
        App::setLocale($locale);

        // set timezone
        Config::set('app.timezone', config('admin.timezone.' . $locale));

        // set language in Carbon
        \Carbon\Carbon::setLocale(str_replace('-', '_', $locale));

        return strtolower($locale);
    }
}

if (!function_exists('formatDateTime')) {
    /**
     *
     * Retorna data Carbon como string no formato 'd/m/Y H:i:s'
     *
     * @param $data
     * @return $string
     *
     */
    function formatDateTime($value, $format = 'd/m/Y H:i:s')
    {
        return Carbon\Carbon::parse($value)->format($format);
    }
}

if (!function_exists('getlocation')) {
    /**
     * Obtem a localização pelo IP informado
     *
     * @param  string $ip
     * @return array $data
     */
    function getlocation($ip)
    {
        return @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));
    }
}

if (!function_exists('getIp')) {
    /**
     * Obtem o número ip do usuário.
     *
     * @return String
     * */
    function getIp()
    {
        return getenv("REMOTE_ADDR");
    }
}

if (!function_exists('getDateBr')) {
    /**
     * Obtem a data atual no formato dd/mm/yyyy.
     *
     * @return String
     * */
    function getDateBr()
    {
        return date("d/m/Y");
    }
}

if (!function_exists('getTime')) {
    /**
     * Obtem a hora atual no formato hh:mm:ss.
     *
     * @return String
     * */
    function getTime()
    {
        return date("H:i:s");
    }
}

if (!function_exists('getDateDb')) {
    /**
     * Obtem a data atual no formato yyyy-mm-dd.
     *
     * @return String
     * */
    function getDateDb()
    {
        return date("Y-m-d");
    }
}


if (!function_exists('getDateTimeDb')) {
    /**
     * Obtem a data e hora atual no formato yyyy-mm-dd hh:mm:ss.
     *
     * @return String
     * */
    function getDateTimeDb()
    {
        return date("Y-m-d H:i:s");
    }
}

if (!function_exists('getDateTimeBr')) {
    /**
     * Obtem a data e hora atual no formato dd-mm-yyyy hh:mm:ss.
     *
     * @return String
     * */
    function getDateTimeBr()
    {
        return date("d/m/Y H:i:s");
    }
}

if (!function_exists('cpfWithoutMask')) {
    /**
     * Tirando a mascara do cpf e completando com zero a esquerda
     *
     * @return String
     * */
    function cpfWithoutMask($cpf)
    {
        if (empty($cpf)) {
            return $cpf;
        }

        $novoCpf = str_replace([".", "-"], "", $cpf);
        while (strlen($novoCpf) < 11) {
            $novoCpf = "0" . $novoCpf;
        }

        return $novoCpf;
    }
}

if (!function_exists('cpfWithMask')) {
    /**
     * Colocando a mascara do cpf e completando com zero a esquerda
     *
     * @return String
     * */
    function cpfWithMask($cpf)
    {
        if (empty($cpf)) {
            return $cpf;
        }

        while (strlen($cpf) < 11) {
            $cpf = "0" . $cpf;
        }

        return substr($cpf, 0, 3) . "." . substr($cpf, 3, 3) . "." . substr($cpf, 6, 3) . "-" . substr($cpf, 9);
    }
}

if (!function_exists('validarCpf')) {
    /**
     * Verificar se é um CPF válido
     *
     * @return Boolean
     * */
    // function validarCpf($cpf) {
    //     return Respect\Validation\Validator::cpf()->validate($cpf);
    // }
}


if (!function_exists('phoneWithMask')) {
    /**
     * Colocando a mascara (00) 0000-0000 no telefone ou (00) 0000-00000 para celular
     *
     * @return String
     * */
    function phoneWithMask($telefone)
    {
        switch (strlen($telefone)) {
            case 8:
                $a = substr($telefone, 0, 4);
                $b = substr($telefone, 4);

                $telefone = '(11) ' . $a . '-' . $b;

                break;
            case 9:
                $a = substr($telefone, 0, 5);
                $b = substr($telefone, 4);

                $telefone = '(11) ' . $a . '-' . $b;

                break;
            case 0:
                $telefone = '(00) 0000-0000';

                break;
        }

        return $telefone;
    }
}

if (!function_exists('comparaDatas')) {
    /**
     * Comparando as datas Assumido que $dataEntrada e $dataSaida estao em string no formato DD/MM/YYYY.
     *
     * @param  String  $dataEntrada  Espeara a string no formato DD/MM/YYYY.
     * @param  String  $dataSaida  Espeara a string no formato DD/MM/YYYY.
     *
     * @return String
     * */
    function comparaDatas($dataEntrada, $dataSaida)
    {
        if (is_null($dataEntrada) and is_null($dataSaida)) {
            return 'igual';
        }

        $timeZone = new \DateTimeZone('UTC');

        /** Assumido que $dataEntrada e $dataSaida estao em formato dia/mes/ano */
        $data1 = \DateTime::createFromFormat('d/m/Y', $dataEntrada, $timeZone);
        $data2 = \DateTime::createFromFormat('d/m/Y', $dataSaida, $timeZone);

        /** Testa se sao validas */
        if (!($data1 instanceof \DateTime)) {
            return -1;
        }

        if (!($data2 instanceof \DateTime)) {
            return -1;
        }

        if ($data1 > $data2) {
            return 'maior';
        }

        if ($data1 == $data2) {
            return 'igual';
        }

        if ($data1 < $data2) {
            return 'menor';
        }
    }
}

if (!function_exists('stringTodate')) {
    /**
     * Converte uma string em Data assumido que a string esteja no formato DD/MM/YYYY.
     *
     * @param  String  $string  Espera a string no formato DD/MM/YYYY.
     *
     * @return DateTime
     * */
    function stringTodate($string)
    {
        $timeZone = new \DateTimeZone('UTC');

        $data = \DateTime::createFromFormat('d/m/Y', $string, $timeZone);

        return $data;
    }
}

if (!function_exists('stringToDateTime')) {
    /**
     * Converte uma string em DataTime assumido que a string esteja no formato DD/MM/YYYY 00:00:00.
     *
     * @param  String  $string  Espera a string no formato DD/MM/YYYY 00:00:00.
     *
     * @return DateTime
     * */
    function stringToDateTime($string)
    {
        $timeZone = new \DateTimeZone('UTC');

        $data = \DateTime::createFromFormat('d/m/Y H:i:s', $string, $timeZone);

        return $data;
    }
}

if (!function_exists('getDriversPDO')) {
    /**
     * Retorno os drivers PDO suportados
     *
     */
    function getDriversPDO()
    {
        return \PDO::getAvailableDrivers();
    }
}

if (!function_exists('generateToken')) {
    /**
     * Cria um identificador de 32 caracteres(a 128 bit hex number) que é extremamente dificil de prever.
     *
     * @return string 32 caracteres
     */
    function generateToken()
    {
        return md5(uniqid(mt_rand(), true));
    }
}

if (!function_exists('verifyEmail')) {
    /**
     * Verifica se é um E-mail válido
     *
     * @return boolean
     */
    function verifyEmail($email)
    {
        $email = strip_tags(trim($email));

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('arraySort')) {
    /**
     * Função simples para ordenar uma matriz[][] por uma chave específica. Mantém associação de índice.
     *
     * EXEMPLO de COMO USAR O a funcao arraySort()
     * --------------------------------------------
     * $people = array(
     *           12345 => array(
     *           'id' => 12345,
     *           'first_name' => 'Joe',
     *           'surname' => 'Bloggs',
     *           'age' => 23,
     *           'sex' => 'm'
     *      ),
     *      12346 => array(
     *          'id' => 12346,
     *          'first_name' => 'Adam',
     *          'surname' => 'Smith',
     *          'age' => 18,
     *          'sex' => 'm'
     *      ),
     *      12347 => array(
     *          'id' => 12347,
     *          'first_name' => 'Amy',
     *          'surname' => 'Jones',
     *          'age' => 21,
     *          'sex' => 'f'
     *      )
     * );
     *
     * print_r(arraySort($people, 'age', SORT_DESC)); // Sort by oldest first
     * print_r(arraySort($people, 'surname', SORT_ASC)); // Sort by surname
     *
     * @param  array  $array  para Ordenar
     * @param  string  $field  Campo para Ordenar
     * @param  int  $order  SORT_ASC ou SORT_DESC
     *
     * @return array
     */
    function arraySort(array $array, string $field, int $order = SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $field) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }
}

if (!function_exists('arrayUniqueMultidimensional')) {
    /**
     * Função que elimina as linhas duplicadas de um array[][] por uma chave específica.
     *
     * @param  array  $array
     * @param  string  $campo
     *
     * @return array
     */
    function arrayUniqueMultidimensional(array $array, string $campo)
    {
        $tempArr = array_unique(array_column($array, $campo));
        return array_intersect_key($array, $tempArr);
    }
}

/**
 * Formatar o numero conforme a necessidade
 *
 * EXEMPLO de COMO USAR O a função getFormattedNumber()
 * --------------------------------------------
 * echo getFormattedNumber(12345678.9);
 * echo '<br />';
 *
 * echo getFormattedNumber(
 *      value: 12345678.9,
 *      locale: 'pt_BR'
 * );
 * echo '<br />';
 *
 * echo getFormattedNumber(
 *      value: 12345678.9,
 *      locale: 'fr_FR'
 * );
 * echo '<br />';
 *
 * echo getFormattedNumber(
 *      value: 12345678.90,
 *      precision: 1
 * );
 *
 * echo '<br />';
 *      echo getFormattedNumber(
 *      value: 12345678.90,
 *      groupingUsed: false
 * );
 *
 * echo '<br />';
 * echo getFormattedNumber(
 *      value: 12345678.90,
 *      locale: 'fr_FR',
 *      style: NumberFormatter::CURRENCY,
 *      currencyCode: 'EUR',
 * );
 *
 * echo '<br />';
 * echo getFormattedNumber(
 *      value: 12345678,
 *      style: NumberFormatter::PADDING_POSITION,
 *      precision: 3
 * );
 * echo '<br />';
 *
 * echo getFormattedNumber(
 *      value: 12345678,
 *      style: NumberFormatter::SPELLOUT
 * );
 * echo '<br />';
 *
 * echo getFormattedNumber(
 *      value: 0.123,
 *      style: NumberFormatter::PERCENT,
 *      precision: 1
 * );
 *
 * @param $value
 * @param  string  $locale
 * @param  int  $style
 * @param  int  $precision
 * @param  bool  $groupingUsed
 * @param  string  $currencyCode
 * @return bool|string
 */
function getFormattedNumber(
    $value,
    string $locale = 'en_US',
    int $style = NumberFormatter::DECIMAL,
    int $precision = 2,
    bool $groupingUsed = true,
    string $currencyCode = 'USD'
) {
    $formatter = new NumberFormatter($locale, $style);
    $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $precision);
    $formatter->setAttribute(NumberFormatter::GROUPING_USED, $groupingUsed);
    if ($style === NumberFormatter::CURRENCY) {
        $formatter->setTextAttribute(NumberFormatter::CURRENCY_CODE, $currencyCode);
    }

    return $formatter->format($value);
}
