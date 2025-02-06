<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function index()
    {
        return response()->json(Company::all());
    }

    public function storeCompany(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'logo' => 'nullable|image',
            'address' => 'nullable|string',
        ]);

        $company = Company::create($validated);

        return response()->json($company);
    }

    public function storeEmployee(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'company_id' => 'required|exists:companies,id',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
        ]);

        $employee = Employee::create($validated);

        return response()->json($employee);
    }
}
