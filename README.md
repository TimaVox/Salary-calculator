<h1>Калькулятор заработной платы<h1>
    
<h4>1. End Point GET: calculate/</h4>
<p>Не сохраняет данные в базу.<p>
<p>Возвращает Калькуляцию с налогами.<p>
    
<h4>2. End Point POST: calculate/</h4>
<p>Cохраняет данные в базу.<p>
<p>Возвращает Калькуляцию с налогами.<p>
    
<h4>Пример: Json данных для калькуляции:</h4>
<pre>
{
    "salary": 100000,
    "workDays": 22,
    "daysWorked": 11,
    "1mzp": 2917,
    "daysYear": 365,
    "daysMonth": 30,
    "isRetiree": true,
    "invalid": 1
}
</pre>
