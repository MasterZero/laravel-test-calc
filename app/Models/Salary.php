<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    const DISABILITY_NONE = 0;
    const DISABILITY_GROUP1 = 1;
    const DISABILITY_GROUP2 = 2;
    const DISABILITY_GROUP3 = 3;
    const MZP = 60000;
    const MRP = 3063;


    public $table = 'salary';

    public $timestamps = false;

    public $fillable = [
        'amount',
        'should_work',
        'actually_work',
        'year',
        'month',
        'mzp',
        'pensioner',
        'disability',
    ];


    protected function make_total()
    {
        $this->total = $this->work_amount
        - $this->personal_fee
        - $this->pension_fee
        - $this->medicine_fee
        - $this->medicine_ensurance
        - $this->social_fee;

        return $this;
    }

    public function calculate()
    {
        $this->work_amount = $this->amount * $this->actually_work / $this->should_work;

        if ($this->pensioner) {

            $this->pension_fee = 0;
            $this->medicine_ensurance = 0;
            $this->medicine_fee = 0;
            $this->social_fee = 0;
            $this->tax_fee = $this->taxFee();
            $this->correction_fee = $this->correctionFee();
            $this->personal_fee = ($this->disability == static::DISABILITY_NONE) ? $this->personalFee() : 0;
            return $this->make_total();
        }

        if (in_array($this->disability, [static::DISABILITY_GROUP1, static::DISABILITY_GROUP2])) {
            $this->pension_fee = 0;
            $this->medicine_ensurance = 0;
            $this->medicine_fee = 0;
            $this->social_fee = $this->socialFee();
            $this->tax_fee = $this->taxFee();
            $this->correction_fee = $this->correctionFee();
            $this->personal_fee = ($this->work_amount > 883 * static::MRP) ? $this->personalFee() : 0;
            return $this->make_total();
        }

        if ($this->disability == static::DISABILITY_GROUP3) {
            $this->pension_fee = 0;
            $this->medicine_ensurance = 0;
            $this->medicine_fee = 0;
            $this->social_fee = $this->socialFee();
            $this->tax_fee = $this->taxFee();
            $this->correction_fee = $this->correctionFee();
            $this->personal_fee = $this->personalFee();
            return $this->make_total();
        }

        $this->pension_fee = $this->pensionFee();
        $this->medicine_ensurance = $this->medicineEnsurance();
        $this->medicine_fee = $this->medicineFee();
        $this->tax_fee = $this->taxFee();
        $this->social_fee = $this->socialFee();
        $this->correction_fee = $this->correctionFee();
        $this->personal_fee = $this->personalFee();

        return $this->make_total();
    }

    protected function pensionFee() : float
    {
        return $this->work_amount * 0.1;
    }

    protected function taxFee() : float
    {
        return $this->mzp ? static::MZP : 0;
    }


    protected function medicineEnsurance() : float
    {
        return $this->work_amount * 0.02;
    }

    protected function medicineFee() : float
    {
        return $this->work_amount * 0.02;
    }

    protected function socialFee() : float
    {
        return ($this->work_amount - $this->pensionFee()) * 0.035;
    }

    protected function correctionFee() : float
    {
        if ($this->work_amount >= static::MRP * 25) {
            return 0;
        }
        return ($this->pensionFee() + $this->taxFee() + $this->medicineFee()) * 0.9;
    }

    protected function personalFee() : float
    {
        $amount = $this->pensionFee() + $this->medicine_fee - $this->taxFee() - $this->correctionFee() * 0.1;
        return $amount < 0 ? 0 : $amount;
    }

}
