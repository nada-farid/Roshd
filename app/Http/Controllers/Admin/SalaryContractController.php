<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySalaryContractRequest;
use App\Http\Requests\StoreSalaryContractRequest;
use App\Http\Requests\UpdateSalaryContractRequest;
use App\Models\Allowance;
use App\Models\Doctor;
use App\Models\SalaryContract;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Alert;

class SalaryContractController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('salary_contract_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salaryContracts = SalaryContract::with(['doctor', 'allowances'])->get();

        return view('admin.salaryContracts.index', compact('salaryContracts'));
    }

    public function create($doctor_id)
    { 
    
        abort_if(Gate::denies('salary_contract_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      
           // $doctors = Doctor::with('user')->get()->pluck('user.email', 'id')->prepend(trans('global.pleaseSelect'), '');
     
            $doctor=Doctor::findOrfail($doctor_id);
            $doctor->load('user');

        $allowances = Allowance::all();

        return view('admin.salaryContracts.create', compact('doctor', 'allowances'));
    }

    public function store(StoreSalaryContractRequest $request)
    {
        $salaryContract = SalaryContract::create($request->all());
       // $salaryContract->allowances()->sync($request->input('allowances', []));
       $salaryContract->allowances()->sync($this->mapallowances($request['allowances']));
     
        Alert::success('تم بنجاح', 'تم  إضافة الراتب للأستشاري بنجاح ');
        return redirect()->route('admin.doctors.show',$request->doctor_id);
    }

    public function edit(SalaryContract $salaryContract)
    {
        abort_if(Gate::denies('salary_contract_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = Doctor::with('user')->get()->pluck('user.email', 'id')->prepend(trans('global.pleaseSelect'), '');

       // $allowances = Allowance::pluck('name', 'id');

        $allowances = Allowance::get()->map(function($allowance) use ($salaryContract) {
            $allowance->extra_salary = data_get($salaryContract->allowances->firstWhere('id', $salaryContract->id), 'pivot.extra_salary') ?? null;
            return $allowance;
        });

        $salaryContract->load('doctor', 'allowances');

      return view('admin.salaryContracts.edit', compact('doctors', 'allowances', 'salaryContract'));
    }

    public function update(UpdateSalaryContractRequest $request, SalaryContract $salaryContract)
    {
     
        $salaryContract->update($request->all());

        $salaryContract->allowances()->sync($this->mapallowances($request['allowances']));

        
        Alert::success('تم بنجاح', 'تم تعديل الراتب بنجاح ');
        return redirect()->route('admin.doctors.show',$request->doctor_id);

    }

    public function show(SalaryContract $salaryContract)
    {
        abort_if(Gate::denies('salary_contract_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salaryContract->load('doctor', 'allowances');

        return view('admin.salaryContracts.show', compact('salaryContract'));
    }

    public function destroy(SalaryContract $salaryContract)
    {
        abort_if(Gate::denies('salary_contract_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salaryContract->delete();

        Alert::success('تم بنجاح', 'تم حذف الراتب بنجاح ');

        return back();
    }

    public function massDestroy(MassDestroySalaryContractRequest $request)
    {
        SalaryContract::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function mapallowances($allowances)
{
    return collect($allowances)->map(function ($i) {
        return ['extra_salary' => $i];
    });
}
}
