<?php


namespace App\Logic;


/**
 * Class ServiceCalculate
 * @package App\Logic
 */
class ServiceCalculate
{
    /**
     * @var array
     */
    protected $requestArray = [
        'salary' => 500000,
        'workDays' => 22,
        'daysWorked' => 9,
        '1mzp' => 2917,
        'daysYear' => 365,
        'daysMonth' => 30,
        'isRetiree' => false,
        'invalid' => 0,
    ];

    /**
     * @var array
     */
    protected $requestData = [];

    /**
     * @var float|int
     */
    protected $mrp = 2917;
    /**
     * @var float|int
     */
    protected $opvTax = 10;
    /**
     * @var float|int
     */
    protected $osmsTax = 2;
    /**
     * @var float|int
     */
    protected $vosmsTax = 2;
    /**
     * @var float|int
     */
    protected $soTax = 3.5;
    /**
     * @var float|int
     */
    protected $ipnTax = 10;

    /**
     * @var float|int
     */
    protected $salary = 0;
    /**
     * @var float|int
     */
    protected $salaryNew = 0;

    /**
     * @param array $request
     * @return $this
     */
    public function init(array $request)
    {
        $this->requestData = array_merge($this->requestArray, $request);
        $this->salary = $this->salary();
        return $this;
    }

    /**
     * Расчет зарплаты за отработанные дни
     * @return float|int
     */
    public function salary()
    {
        return (($this->requestData['salary']/$this->requestData['workDays']) * $this->requestData['daysWorked']);
    }

    /**
     * Налог: Обязательные пенсионные взносы (ОПВ)
     * @return float|int
     */
    public function opv()
    {
        return ($this->salary * ($this->opvTax / 100));
    }

    /**
     * Налог: Обязательное социальное медицинское страхование (ОСМС)
     * @return float|int
     */
    public function osms()
    {
        return ($this->salary * ($this->osmsTax / 100));
    }

    /**
     * Налог: Взносы на обязательное социальное медицинское
     * Страхование (ВОСМС)
     * @return float|int
     */
    public function vosms()
    {
        return ($this->salary * ($this->vosmsTax / 100));
    }

    /**
     * Налог: Социальные отчисления (СО)
     * @return float|int
     */
    public function so()
    {
        $so = ($this->salary - $this->opv());
        return ($so * ($this->soTax / 100));
    }

    /**
     * Налог: Индивидуальный подоходный налог (ИПН)
     * @return float|int
     */
    public function ipn()
    {
        $ipn = ($this->salary - $this->opv() - $this->requestData['1mzp'] - $this->vosms());
        if($this->salary < (25 * $this->mrp))
            return ($ipn * (90 / 100));
        return ($ipn * ($this->ipnTax / 100));
    }

    /**
     * Метод расчета зарплаты сотруднику
     * @return array
     */
    public function calculate()
    {
        if ($this->requestData['isRetiree'] && $this->requestData['invalid'] > 0) {
            $this->salaryNew += $this->salary;
        }
        if ($this->requestData['isRetiree'] && $this->requestData['invalid'] == 0) {
            $this->salaryNew += $this->salary - $this->ipn();
        }
        if (!$this->requestData['isRetiree'] && $this->requestData['invalid'] < 3) {
            $this->salaryNew += $this->salary - $this->so();
        }
        if (!$this->requestData['isRetiree'] && $this->requestData['invalid'] >= 3) {
            $this->salaryNew += $this->salary - $this->opv() - $this->so();
        }
        if (!$this->requestData['isRetiree'] && ($this->salary > (882 * $this->mrp))) {
            $this->salaryNew += $this->salary - $this->ipn();
        }

        return $this->toArray();
    }

    /**
     * Метод возврата данных в массиве
     * @return array
     */
    protected function toArray()
    {
        return [
            'ipn' => $this->ipn(),
            'opv' => $this->opv(),
            'osms' => $this->osms(),
            'vosms' => $this->osms(),
            'so' => $this->so(),
            'salary' => $this->numberFormat($this->salaryNew),
            'total' => $this->numberFormat($this->salaryNew)
        ];
    }

    /**
     * @param $number
     * @param int $decemal
     * @return float
     */
    protected function numberFormat($number, $decemal = 2)
    {
        return (float)number_format($number, 2, '.', '');
    }

}
